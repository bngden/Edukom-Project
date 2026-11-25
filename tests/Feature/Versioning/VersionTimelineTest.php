<?php

use App\Domain\Payroll\PeriodGuard;
use App\Domain\Versioning\VersionTimeline;
use App\Enums\PayrollPeriodStatus;
use App\Enums\Role;
use App\Enums\VersionStatus;
use App\Exceptions\ApiException;
use App\Models\AuditLog;
use App\Models\PayrollPeriod;
use Illuminate\Support\Carbon;
use Tests\Fixtures\TestVersion;

beforeEach(fn () => $this->travelTo('2026-11-25 10:00:00'));

function addVersion(string $from, int $value = 1, string $series = 'tarif'): TestVersion
{
    return VersionTimeline::add(new TestVersion(['series' => $series, 'value' => $value, 'effective_from' => $from]), 'Penyesuaian');
}

function apiError(callable $fn): ApiException
{
    try {
        $fn();
    } catch (ApiException $e) {
        return $e;
    }

    throw new RuntimeException('ApiException tidak dilempar.');
}

function activeValueOn(string $date, string $series = 'tarif'): ?int
{
    return TestVersion::query()->where('series', $series)->activeOn(Carbon::parse($date))->value('value');
}

it('menutup versi lama H-1 dan menentukan versi aktif per tanggal', function () {
    $owner = actingAsRole(Role::Owner);
    $v1 = addVersion('2026-01-01', 10);
    $v2 = addVersion('2026-12-01', 20);
    addVersion('2026-06-01', 99, 'lain');

    expect($v1->fresh()->effective_to->toDateString())->toBe('2026-11-30')
        ->and($v2->effective_to)->toBeNull()
        ->and($v2->created_by)->toBe($owner->id)
        ->and($v2->reason)->toBe('Penyesuaian')
        ->and(activeValueOn('2025-12-31'))->toBeNull()
        ->and(activeValueOn('2026-11-30'))->toBe(10)
        ->and(activeValueOn('2026-12-01'))->toBe(20)
        ->and(activeValueOn('2030-01-01'))->toBe(20)
        ->and(activeValueOn('2026-12-01', 'lain'))->toBe(99);

    $log = AuditLog::query()->where('action', 'test_version.version_created')->where('subject_id', $v2->id)->sole();
    expect($log->actor_id)->toBe($owner->id)
        ->and($log->after['value'])->toBe(20)
        ->and($log->reason)->toBe('Penyesuaian');
});

it('menolak tanggal yang sama atau lebih awal dari versi terakhir dengan 409', function (string $from) {
    addVersion('2026-01-01');
    addVersion('2026-12-01');

    $e = apiError(fn () => addVersion($from));

    expect($e->status)->toBe(409)
        ->and($e->errorCode)->toBe('CONFLICT')
        ->and($e->getMessage())->toBe('Tanggal berlaku harus setelah 1 Desember 2026 (tanggal berlaku versi terakhir).')
        ->and(TestVersion::query()->count())->toBe(2);
})->with(['2026-12-01', '2026-11-15']);

it('menolak tanggal di periode yang terkunci dengan 423', function (string $state) {
    PayrollPeriod::factory()->month(2026, 12)->{$state}()->create();

    $e = apiError(fn () => addVersion('2026-12-05'));

    expect($e->status)->toBe(423)
        ->and($e->errorCode)->toBe('LOCKED_PERIOD')
        ->and($e->getMessage())->toBe('Tanggal berlaku jatuh pada periode penggajian Desember 2026 yang sudah ditutup.')
        ->and($e->errors)->toHaveKey('effective_from');
})->with(['closed', 'approved']);

it('menerima tanggal di periode terbuka atau bulan tanpa periode', function () {
    PayrollPeriod::factory()->month(2026, 12)->create();

    addVersion('2026-12-05');
    addVersion('2027-02-01');

    expect(TestVersion::query()->count())->toBe(2);
});

it('membatalkan versi terjadwal dan membuka kembali versi sebelumnya', function () {
    $owner = actingAsRole(Role::Owner);
    $v1 = addVersion('2026-01-01', 10);
    $v2 = addVersion('2026-12-01', 20);

    VersionTimeline::cancel($v2, 'Salah input tarif');

    $v2->refresh();
    expect($v2->cancelled_at)->not->toBeNull()
        ->and($v2->cancelled_by)->toBe($owner->id)
        ->and($v2->cancel_reason)->toBe('Salah input tarif')
        ->and($v1->fresh()->effective_to)->toBeNull()
        ->and(activeValueOn('2026-12-05'))->toBe(10)
        ->and(AuditLog::query()->where('action', 'test_version.version_cancelled')->sole()->reason)->toBe('Salah input tarif');

    // Versi batal tidak lagi menghalangi tanggal yang sama.
    expect(addVersion('2026-12-01', 30)->value)->toBe(30)
        ->and($v1->fresh()->effective_to->toDateString())->toBe('2026-11-30');
});

it('menolak pembatalan yang tidak sah', function () {
    $active = addVersion('2026-01-01');
    $middle = addVersion('2026-12-01');
    $last = addVersion('2027-01-01');

    expect(apiError(fn () => VersionTimeline::cancel($active, 'x'))->getMessage())->toBe('Versi yang sudah berlaku tidak dapat dibatalkan.')
        ->and(apiError(fn () => VersionTimeline::cancel($middle, 'x'))->getMessage())->toBe('Hanya versi terakhir yang dapat dibatalkan.')
        ->and(apiError(fn () => VersionTimeline::cancel($last, '  '))->status)->toBe(422);

    VersionTimeline::cancel($last, 'Batal');

    expect(apiError(fn () => VersionTimeline::cancel($last, 'lagi'))->getMessage())->toBe('Versi ini sudah dibatalkan.');
});

it('menurunkan status versi: Berakhir, Berlaku, Terjadwal, Dibatalkan', function () {
    $ended = addVersion('2026-01-01');
    $active = addVersion('2026-11-01');
    $scheduled = addVersion('2026-12-01');
    $cancelled = addVersion('2027-01-01');
    VersionTimeline::cancel($cancelled, 'Batal');

    expect($ended->fresh()->versionStatus())->toBe(VersionStatus::Ended)
        ->and($active->fresh()->versionStatus())->toBe(VersionStatus::Active)
        ->and($scheduled->fresh()->versionStatus())->toBe(VersionStatus::Scheduled)
        ->and($cancelled->fresh()->versionStatus())->toBe(VersionStatus::Cancelled)
        ->and(array_map(fn (VersionStatus $s) => $s->label(), VersionStatus::cases()))->toBe(['Terjadwal', 'Berlaku', 'Berakhir', 'Dibatalkan']);
});

it('PeriodGuard hanya mengunci periode berstatus selain Terbuka', function () {
    PayrollPeriod::factory()->month(2026, 10)->approved()->create();
    $open = PayrollPeriod::factory()->month(2026, 11)->create();

    expect(PeriodGuard::isLocked(Carbon::parse('2026-10-31')))->toBeTrue()
        ->and(PeriodGuard::isLocked(Carbon::parse('2026-11-01')))->toBeFalse()
        ->and(PeriodGuard::isLocked(Carbon::parse('2027-03-01')))->toBeFalse()
        ->and($open->starts_on->toDateString())->toBe('2026-11-01')
        ->and($open->ends_on->toDateString())->toBe('2026-11-30')
        ->and(array_map(fn (PayrollPeriodStatus $s) => $s->label(), PayrollPeriodStatus::cases()))
        ->toBe(['Terbuka', 'Ditutup', 'Menunggu Persetujuan', 'Disetujui Sebagian', 'Disetujui', 'Ditolak']);
});
