<?php

use App\Domain\Audit\Audit;
use App\Enums\Role;
use App\Models\AuditLog;
use App\Models\RetentionRun;
use Database\Seeders\PolicyParameterSeeder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\Fixtures\TestEvidenceFile;

beforeEach(function () {
    $this->travelTo('2026-11-25 10:00:00');
    $this->withHeaders(spaHeaders());
    (new PolicyParameterSeeder)->run();
    Storage::fake();
});

function registerEvidenceTarget(string $table = 'test_evidence_files'): void
{
    $model = $table === 'test_evidence_files' ? TestEvidenceFile::class : (new class extends TestEvidenceFile
    {
        protected $table = 'tabel_tidak_ada';
    })::class;

    config(['edukom.retention_targets' => ['attendance_evidence' => [$model, 'captured_at', 'file_path']]]);
}

function evidence(string $capturedAt, string $path): TestEvidenceFile
{
    Storage::put($path, 'isi');

    return TestEvidenceFile::query()->create(['captured_at' => $capturedAt, 'file_path' => $path]);
}

function summaryOf(RetentionRun|array $run, string $type): array
{
    $summary = $run instanceof RetentionRun ? $run->summary : $run['summary'];

    return collect($summary)->firstWhere('type', $type);
}

it('menampilkan 5 jenis bernilai awal 6 bulan dan perubahan masa simpan berversi', function () {
    actingAsRole(Role::Owner);

    $types = collect($this->getJson('/api/v1/retention')->assertOk()->json('data.types'))->keyBy('type');
    expect($types->keys()->all())->toBe(['attendance_evidence', 'leave_attachment', 'handover_photo', 'honorarium_slip', 'audit_log'])
        ->and($types->pluck('months')->unique()->all())->toBe([6])
        ->and($types['honorarium_slip'])->toMatchArray(['label' => 'Slip honorarium', 'parameter_key' => 'retention_honorarium_slip_months', 'scheduled' => null]);

    $versionId = $this->postJson('/api/v1/policy-parameters/retention_honorarium_slip_months/versions', [
        'value' => 24, 'effective_from' => '2027-01-01', 'reason' => 'Kebijakan arsip',
    ])->assertCreated()->json('data.id');

    $this->getJson('/api/v1/retention')
        ->assertJsonPath('data.types.3.months', 6)
        ->assertJsonPath('data.types.3.scheduled.months', 24)
        ->assertJsonPath('data.types.3.scheduled.effective_from', '2027-01-01');

    $this->postJson('/api/v1/policy-parameters/retention_honorarium_slip_months/versions', ['value' => 121, 'effective_from' => '2027-02-01'])
        ->assertUnprocessable();

    $this->postJson("/api/v1/policy-parameters/retention_honorarium_slip_months/versions/{$versionId}/cancel", ['reason' => 'Batal'])
        ->assertNoContent();
    $this->getJson('/api/v1/retention')->assertJsonPath('data.types.3.scheduled', null);
});

it('membersihkan berkas yang melewati masa simpan tanpa menghapus baris, dan uji tidak menghapus apa pun', function () {
    registerEvidenceTarget();
    $old = evidence('2026-05-24 23:00:00', 'bukti/lama.jpg');
    $new = evidence('2026-05-25 00:00:00', 'bukti/baru.jpg');
    DB::table('test_reason_usages')->insert(['reason_id' => 1]);

    $this->artisan('edukom:purge-retention', ['--dry-run' => true])->assertSuccessful();

    $dry = RetentionRun::query()->sole();
    expect($dry->dry_run)->toBeTrue()
        ->and(summaryOf($dry, 'attendance_evidence'))->toMatchArray(['months' => 6, 'cutoff' => '2026-05-25', 'count' => 1, 'status' => 'success'])
        ->and(Storage::exists('bukti/lama.jpg'))->toBeTrue()
        ->and($old->fresh()->file_path)->toBe('bukti/lama.jpg')
        ->and(AuditLog::query()->where('action', 'retention.purged')->exists())->toBeFalse();

    $this->artisan('edukom:purge-retention')->assertSuccessful();

    expect(Storage::exists('bukti/lama.jpg'))->toBeFalse()
        ->and($old->fresh())->not->toBeNull()
        ->and($old->fresh()->file_path)->toBeNull()
        ->and(Storage::exists('bukti/baru.jpg'))->toBeTrue()
        ->and($new->fresh()->file_path)->toBe('bukti/baru.jpg')
        ->and(DB::table('test_reason_usages')->count())->toBe(1)
        ->and(summaryOf(RetentionRun::query()->latest('id')->first(), 'leave_attachment'))->toMatchArray(['count' => 0, 'status' => 'skipped']);
});

it('menghapus riwayat perubahan lama lewat command, mencatat retention.purged oleh Sistem, dan memberi tahu Owner', function () {
    $owner = actingAsRole(Role::Owner);
    $this->travelTo('2026-05-01 08:00:00');
    Audit::record('contoh.lama', ['type' => 'contoh', 'label' => 'Lama']);
    $this->travelTo('2026-11-25 10:00:00');
    Audit::record('contoh.baru', ['type' => 'contoh', 'label' => 'Baru']);
    auth()->forgetGuards();

    $this->artisan('edukom:purge-retention')->assertSuccessful();

    $log = AuditLog::query()->where('action', 'retention.purged')->sole();
    expect(AuditLog::query()->where('action', 'contoh.lama')->exists())->toBeFalse()
        ->and(AuditLog::query()->where('action', 'contoh.baru')->exists())->toBeTrue()
        ->and($log->actor_type)->toBe('system')
        ->and($log->after['counts'])->toMatchArray(['audit_log' => 1, 'attendance_evidence' => 0]);

    $notification = $owner->notifications()->sole();
    expect($notification->type)->toBe('retention.purged')
        ->and($notification->data['message'])->toBe('Data dibersihkan: Riwayat perubahan 1.');

    expect(fn () => AuditLog::query()->where('action', 'contoh.baru')->delete())->toThrow(Exception::class);
});

it('galat pada satu jenis tidak menghentikan jenis lain (status sebagian gagal)', function () {
    registerEvidenceTarget('tabel_tidak_ada');

    $this->artisan('edukom:purge-retention')->assertSuccessful();

    $run = RetentionRun::query()->sole();
    expect($run->status)->toBe(RetentionRun::PARTIAL)
        ->and(summaryOf($run, 'attendance_evidence'))->toMatchArray(['status' => 'failed', 'count' => 0])
        ->and(summaryOf($run, 'audit_log')['status'])->toBe('success');
});

it('menjadwalkan pembersihan harian pukul 02.00 WIB', function () {
    // schedule:list memuat routes/console.php lewat kernel console.
    $this->artisan('schedule:list')->expectsOutputToContain('edukom:purge-retention')->assertSuccessful();

    $event = collect(app(Schedule::class)->events())->first(fn ($e) => str_contains((string) $e->command, 'edukom:purge-retention'));

    expect($event)->not->toBeNull()
        ->and($event->expression)->toBe('0 2 * * *')
        ->and($event->timezone)->toBe('Asia/Jakarta')
        ->and($event->withoutOverlapping)->toBeTrue();
});

it('owner menjalankan uji tanpa menghapus dan melihat riwayat pembersihan', function () {
    $owner = actingAsRole(Role::Owner);
    registerEvidenceTarget();
    evidence('2026-01-01 08:00:00', 'bukti/lama.jpg');

    $this->postJson('/api/v1/retention-runs/dry-run')
        ->assertCreated()
        ->assertJsonPath('data.dry_run', true)
        ->assertJsonPath('data.status', 'success')
        ->assertJsonPath('data.triggered_by_name', $owner->name)
        ->assertJsonPath('data.summary.0.count', 1);

    expect(Storage::exists('bukti/lama.jpg'))->toBeTrue();

    $this->getJson('/api/v1/retention-runs')->assertOk()->assertJsonCount(1, 'data')->assertJsonPath('meta.per_page', 25);
    $this->getJson('/api/v1/retention')->assertJsonPath('data.last_run', null);
});

it('selain owner tidak dapat membuka masa simpan', function (Role $role) {
    actingAsRole($role);

    $this->getJson('/api/v1/retention')->assertForbidden();
    $this->getJson('/api/v1/retention-runs')->assertForbidden();
    $this->postJson('/api/v1/retention-runs/dry-run')->assertForbidden();
    expect(RetentionRun::query()->exists())->toBeFalse();
})->with('all_roles_except_owner');

it('menolak akses tanpa login', function () {
    $this->getJson('/api/v1/retention')->assertUnauthorized();
    $this->postJson('/api/v1/retention-runs/dry-run')->assertUnauthorized();
});
