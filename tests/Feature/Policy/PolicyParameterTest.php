<?php

use App\Domain\Policy\ParameterCatalog;
use App\Domain\Policy\ParameterNotConfigured;
use App\Domain\Policy\PolicyParameters;
use App\Enums\Role;
use App\Models\AuditLog;
use App\Models\PayrollPeriod;
use App\Models\PolicyParameter;
use App\Models\PolicyParameterVersion;
use Database\Seeders\PolicyParameterSeeder;
use Illuminate\Support\Carbon;

beforeEach(function () {
    $this->travelTo('2026-11-25 10:00:00');
    $this->withHeaders(spaHeaders());
});

/**
 * Seed hanya key tertentu agar test cepat (DB remote).
 */
function seedParameters(string ...$keys): void
{
    (new PolicyParameterSeeder)->run($keys);
}

function postVersion(string $key, mixed $value, string $from = '2026-12-01', array $extra = [])
{
    return test()->postJson("/api/v1/policy-parameters/{$key}/versions", ['value' => $value, 'effective_from' => $from, ...$extra]);
}

it('seeder idempoten, sesuai katalog, dan parameter tanpa nilai awal Belum Dikonfigurasi', function () {
    (new PolicyParameterSeeder)->run();
    (new PolicyParameterSeeder)->run();

    $empty = array_keys(array_filter(ParameterCatalog::all(), fn (array $e) => $e['default'] === null));

    expect(PolicyParameter::query()->count())->toBe(36)
        ->and(PolicyParameterVersion::query()->count())->toBe(36 - count($empty))
        ->and(PolicyParameterVersion::query()->whereNotNull('created_by')->exists())->toBeFalse();

    actingAsRole(Role::Owner);
    $items = collect($this->getJson('/api/v1/policy-parameters')->assertOk()->json('data'))->keyBy('key');

    expect($items)->toHaveCount(36)
        ->and($items->where('status', 'not_configured')->keys()->sort()->values()->all())->toBe(collect($empty)->sort()->values()->all())
        ->and($items['admin_service_hours']['status_label'])->toBe('Belum Dikonfigurasi')
        ->and($items['late_tolerance_minutes'])->toMatchArray([
            'group' => 'attendance',
            'group_label' => 'Presensi',
            'label' => 'Toleransi keterlambatan',
            'unit' => 'menit',
            'value_type' => 'integer',
            'status' => 'configured',
            'current_value' => 30,
            'current_effective_from' => '2026-01-01',
            'display_value' => '30 menit',
            'scheduled_version' => null,
        ]);

    $this->getJson('/api/v1/policy-parameters?group=leave')->assertOk()->assertJsonCount(7, 'data');
    $this->getJson('/api/v1/policy-parameters?group=lain')->assertUnprocessable();
});

it('get() mengembalikan nilai sesuai tanggal dan melempar bila belum dikonfigurasi', function () {
    seedParameters('late_tolerance_minutes', 'admin_service_hours');
    actingAsRole(Role::Owner);
    postVersion('late_tolerance_minutes', 45)->assertCreated();

    $params = app(PolicyParameters::class);

    expect($params->get('late_tolerance_minutes'))->toBe(30)
        ->and($params->get('late_tolerance_minutes', Carbon::parse('2026-11-30')))->toBe(30)
        ->and($params->get('late_tolerance_minutes', Carbon::parse('2026-12-01')))->toBe(45)
        ->and($params->getOrNull('admin_service_hours'))->toBeNull()
        ->and($params->isConfigured('admin_service_hours'))->toBeFalse()
        ->and(fn () => $params->get('admin_service_hours'))->toThrow(ParameterNotConfigured::class, 'Parameter "Jam layanan Admin" belum dikonfigurasi.')
        ->and(fn () => $params->get('tidak_ada'))->toThrow(InvalidArgumentException::class);
});

it('menyimpan versi valid untuk setiap tipe nilai dengan display_value yang benar', function (string $key, mixed $value, string $display) {
    seedParameters($key);
    actingAsRole(Role::Owner);

    postVersion($key, $value, extra: ['reason' => 'Kebijakan baru'])
        ->assertCreated()
        ->assertJsonPath('data.value', $value)
        ->assertJsonPath('data.display_value', $display)
        ->assertJsonPath('data.status', 'scheduled')
        ->assertJsonPath('data.effective_from', '2026-12-01');

    $this->getJson("/api/v1/policy-parameters/{$key}")
        ->assertOk()
        ->assertJsonPath('data.scheduled_version.display_value', $display)
        ->assertJsonPath('data.versions.0.reason', 'Kebijakan baru');
})->with([
    'integer' => ['late_tolerance_minutes', 45, '45 menit'],
    'time' => ['checkout_reminder_time', '21:30', '21.30 WIB'],
    'relative_deadline' => ['planned_leave_deadline', ['days_before' => 2, 'time' => '18:00'], 'H-2 pukul 18.00 WIB'],
    'by_leave_type' => ['substitute_response_hours', ['planned' => 12, 'urgent' => 2], 'Terencana 12 jam · Mendesak 2 jam'],
    'escalation' => ['escalation_deadline', ['planned' => ['days_before' => 1, 'time' => '20:00'], 'urgent_hours_before' => 4], 'Terencana H-1 pukul 20.00 WIB · Mendesak 4 jam sebelum mulai'],
    'service_hours' => ['admin_service_hours', ['days' => [1, 2, 3, 4, 5], 'start' => '08:00', 'end' => '16:00'], 'Senin–Jumat 08.00–16.00'],
    'service_hours tidak berurutan' => ['admin_service_hours', ['days' => [5, 1, 3], 'start' => '08:00', 'end' => '12:00'], 'Senin, Rabu, Jumat 08.00–12.00'],
    'reupload_limit' => ['correction_reupload_limit', ['max_times' => 2, 'within_days' => 5], 'Maks 2 kali dalam 5 hari'],
    'file_rule' => ['evidence_file_rule', ['extensions' => ['jpg', 'png', 'pdf'], 'max_size_mb' => 5, 'max_files' => 5], 'jpg, png, pdf · maks 5 MB · 5 berkas'],
]);

it('menolak nilai tidak valid per tipe dengan pesan Indonesia', function (string $key, mixed $value, string $field, ?string $message = null) {
    seedParameters($key);
    actingAsRole(Role::Owner);

    postVersion($key, $value)
        ->assertUnprocessable()
        ->assertJsonPath('code', 'VALIDATION_ERROR')
        ->assertJsonValidationErrors($message === null ? [$field] : [$field => $message]);

    expect(PolicyParameterVersion::query()->where('effective_from', '2026-12-01')->exists())->toBeFalse();
})->with([
    'integer < 1' => ['late_tolerance_minutes', 0, 'value', 'Nilai harus bernilai 1 sampai 1440.'],
    'integer berupa teks' => ['late_tolerance_minutes', '45', 'value', 'Nilai harus berupa bilangan bulat.'],
    'integer melebihi batas key' => ['session_duration_minutes', 601, 'value'],
    'time' => ['checkout_reminder_time', '25:00', 'value', 'Nilai harus sesuai format H:i.'],
    'relative_deadline' => ['planned_leave_deadline', ['days_before' => -1, 'time' => '23:59'], 'value.days_before'],
    'by_leave_type' => ['substitute_response_hours', ['planned' => 0, 'urgent' => 1], 'value.planned'],
    'escalation' => ['escalation_deadline', ['planned' => ['days_before' => 1, 'time' => '9:00'], 'urgent_hours_before' => 3], 'value.planned.time'],
    'service_hours hari ganda' => ['admin_service_hours', ['days' => [1, 1], 'start' => '08:00', 'end' => '16:00'], 'value.days.1'],
    'service_hours jam terbalik' => ['admin_service_hours', ['days' => [1], 'start' => '16:00', 'end' => '08:00'], 'value.end', 'Jam selesai harus setelah jam mulai.'],
    'reupload_limit' => ['correction_reupload_limit', ['max_times' => 0, 'within_days' => 3], 'value.max_times'],
    'file_rule ekstensi' => ['evidence_file_rule', ['extensions' => ['exe'], 'max_size_mb' => 5, 'max_files' => 5], 'value.extensions.0'],
    'file_rule ukuran' => ['evidence_file_rule', ['extensions' => ['pdf'], 'max_size_mb' => 21, 'max_files' => 5], 'value.max_size_mb'],
    'key tak dikenal di objek' => ['substitute_response_hours', ['planned' => 1, 'urgent' => 1, 'lain' => 1], 'value'],
]);

it('menolak tanggal di periode tertutup (423) dan tanggal ≤ versi terakhir (409)', function () {
    seedParameters('late_tolerance_minutes');
    actingAsRole(Role::Owner);
    PayrollPeriod::factory()->month(2026, 12)->closed()->create();

    postVersion('late_tolerance_minutes', 45, '2026-12-05')
        ->assertStatus(423)
        ->assertJsonPath('code', 'LOCKED_PERIOD')
        ->assertJsonPath('message', 'Tanggal berlaku jatuh pada periode penggajian Desember 2026 yang sudah ditutup.');

    postVersion('late_tolerance_minutes', 45, '2026-01-01')
        ->assertConflict()
        ->assertJsonPath('code', 'CONFLICT')
        ->assertJsonValidationErrors(['effective_from']);

    $this->postJson('/api/v1/policy-parameters/tidak_ada/versions', ['value' => 1])->assertNotFound();
});

it('membatalkan versi terjadwal dan menolak membatalkan versi yang sudah berlaku', function () {
    seedParameters('late_tolerance_minutes', 'session_duration_minutes');
    actingAsRole(Role::Owner);
    $scheduledId = postVersion('late_tolerance_minutes', 45)->json('data.id');
    $activeId = PolicyParameterVersion::query()->whereRelation('parameter', 'key', 'late_tolerance_minutes')->where('effective_from', '2026-01-01')->value('id');
    $otherId = PolicyParameterVersion::query()->whereRelation('parameter', 'key', 'session_duration_minutes')->value('id');
    $cancel = fn ($id, array $body = ['reason' => 'Salah input']) => $this->postJson("/api/v1/policy-parameters/late_tolerance_minutes/versions/{$id}/cancel", $body);

    $cancel($scheduledId, [])->assertUnprocessable()->assertJsonValidationErrors(['reason']);
    $cancel($otherId)->assertNotFound();
    $cancel($activeId)->assertConflict()->assertJsonPath('message', 'Versi yang sudah berlaku tidak dapat dibatalkan.');
    $cancel($scheduledId)->assertNoContent();

    $this->getJson('/api/v1/policy-parameters/late_tolerance_minutes')
        ->assertOk()
        ->assertJsonPath('data.scheduled_version', null)
        ->assertJsonPath('data.versions.0.status', 'cancelled')
        ->assertJsonPath('data.versions.0.cancel_reason', 'Salah input')
        ->assertJsonPath('data.versions.0.cancelled_by_name', auth()->user()->name)
        ->assertJsonPath('data.versions.1.status', 'active')
        ->assertJsonPath('data.versions.1.effective_to', null)
        ->assertJsonPath('data.versions.1.created_by_name', 'Sistem');
});

it('mencatat audit dengan nilai lama dan baru', function () {
    seedParameters('late_tolerance_minutes');
    $owner = actingAsRole(Role::Owner);

    postVersion('late_tolerance_minutes', 45, extra: ['reason' => 'Evaluasi'])->assertCreated();

    $log = AuditLog::query()->where('action', 'policy_parameter.version_created')->where('actor_id', $owner->id)->sole();

    expect($log->subject_label)->toBe('Toleransi keterlambatan')
        ->and($log->before)->toBe(['value' => 30, 'effective_from' => '2026-01-01'])
        ->and($log->after)->toBe(['value' => 45, 'effective_from' => '2026-12-01'])
        ->and($log->reason)->toBe('Evaluasi');
});

it('owner dan admin boleh melihat', function (Role $role) {
    seedParameters('late_tolerance_minutes');
    actingAsRole($role);

    $this->getJson('/api/v1/policy-parameters')->assertOk();
    $this->getJson('/api/v1/policy-parameters/late_tolerance_minutes')->assertOk();
})->with('owner_admin');

it('hanya owner yang boleh mengubah', function (Role $role) {
    seedParameters('late_tolerance_minutes');
    $id = PolicyParameterVersion::query()->value('id');
    actingAsRole($role);

    postVersion('late_tolerance_minutes', 45)->assertForbidden();
    $this->postJson("/api/v1/policy-parameters/late_tolerance_minutes/versions/{$id}/cancel", ['reason' => 'x'])->assertForbidden();
})->with('all_roles_except_owner');

it('tentor, kurir, dan teknisi tidak boleh melihat', function (Role $role) {
    seedParameters('late_tolerance_minutes');
    actingAsRole($role);

    $this->getJson('/api/v1/policy-parameters')->assertForbidden();
    $this->getJson('/api/v1/policy-parameters/late_tolerance_minutes')->assertForbidden();
})->with('all_roles_except_owner_admin');
