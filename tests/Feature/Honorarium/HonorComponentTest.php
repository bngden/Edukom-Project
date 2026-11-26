<?php

use App\Domain\Honorarium\HonorRates;
use App\Enums\Role;
use App\Models\AuditLog;
use App\Models\HonorComponent;
use App\Models\HonorComponentRate;
use App\Models\PayrollPeriod;
use Database\Seeders\HonorComponentSeeder;
use Illuminate\Support\Carbon;

beforeEach(function () {
    $this->travelTo('2026-11-25 10:00:00');
    $this->withHeaders(spaHeaders());
    (new HonorComponentSeeder)->run();
});

function component(string $code): HonorComponent
{
    return HonorComponent::query()->where('code', $code)->firstOrFail();
}

function newComponent(array $overrides = [])
{
    return test()->postJson('/api/v1/honor-components', [
        'name' => 'Uang Makan',
        'description' => 'Tunjangan makan',
        'basis' => 'per_school_visit',
        'amount' => 15000,
        'effective_from' => '2026-12-01',
        ...$overrides,
    ]);
}

it('seeder membuat 4 komponen bawaan dengan dasar dan nominal benar, idempoten', function () {
    component('attendance')->update(['name' => 'Kehadiran (diubah Owner)']);
    (new HonorComponentSeeder)->run();

    actingAsRole(Role::Admin);
    $items = collect($this->getJson('/api/v1/honor-components')->assertOk()->json('data'))->keyBy('code');

    expect($items->keys()->all())->toBe(['attendance', 'teaching', 'transport', 'completeness_bonus'])
        ->and(HonorComponentRate::query()->count())->toBe(3)
        ->and($items['attendance'])->toMatchArray(['name' => 'Kehadiran (diubah Owner)', 'basis' => 'per_valid_session', 'basis_label' => 'Per sesi sah', 'current_amount' => 10000, 'current_effective_from' => '2026-01-01', 'is_system' => true, 'status' => 'active', 'status_label' => 'Aktif'])
        ->and($items['teaching'])->toMatchArray(['basis' => 'per_valid_session', 'current_amount' => 10000])
        ->and($items['transport'])->toMatchArray(['basis' => 'per_school_visit', 'rate_type' => 'distance_tiers', 'current_amount' => null])
        ->and($items['completeness_bonus'])->toMatchArray(['basis' => 'per_school_per_period', 'current_amount' => 20000])
        ->and($items['completeness_bonus']['description'])->toContain('kelengkapan administrasi');
});

it('owner menambah komponen baru bertarif flat dan tercatat di audit', function () {
    $owner = actingAsRole(Role::Owner);

    newComponent(['reason' => 'Kebijakan baru'])
        ->assertCreated()
        ->assertJsonPath('data.code', 'uang_makan')
        ->assertJsonPath('data.rate_type', 'flat')
        ->assertJsonPath('data.is_system', false)
        ->assertJsonPath('data.sort_order', 5)
        ->assertJsonPath('data.current_amount', null)
        ->assertJsonPath('data.scheduled_rate.amount', 15000)
        ->assertJsonPath('data.rates.0.created_by_name', $owner->name);

    expect(HonorRates::flatAmountFor('uang_makan', Carbon::parse('2026-12-01')))->toBe(15000)
        ->and(AuditLog::query()->where('action', 'honor_component.created')->sole()->subject_label)->toBe('Uang Makan')
        ->and(AuditLog::query()->where('action', 'honor_component.version_created')->where('actor_id', $owner->id)->exists())->toBeTrue();
});

it('menolak komponen tidak valid', function (array $overrides, string $field) {
    actingAsRole(Role::Owner);

    newComponent($overrides)->assertUnprocessable()->assertJsonValidationErrors([$field]);
})->with([
    'nama duplikat beda huruf' => [['name' => 'uang KEHADIRAN'], 'name'],
    'dasar di luar enum' => [['basis' => 'per_jam'], 'basis'],
    'nominal negatif' => [['amount' => -1], 'amount'],
    'nominal bukan angka bulat' => [['amount' => '15000'], 'amount'],
]);

it('revisi tarif menutup versi lama H-1 dan flatAmountFor mengikuti tanggal', function () {
    $owner = actingAsRole(Role::Owner);
    $id = component('attendance')->id;

    $this->postJson("/api/v1/honor-components/{$id}/rates", ['amount' => 12000, 'effective_from' => '2026-12-01'])
        ->assertCreated()
        ->assertJsonPath('data.status', 'scheduled');

    expect(HonorRates::flatAmountFor('attendance', Carbon::parse('2026-11-30')))->toBe(10000)
        ->and(HonorRates::flatAmountFor('attendance', Carbon::parse('2026-12-01')))->toBe(12000)
        ->and(HonorComponentRate::query()->where('amount', 10000)->where('honor_component_id', $id)->value('effective_to'))->toBe('2026-11-30');

    $this->getJson('/api/v1/honor-components?date=2026-12-01')
        ->assertJsonPath('data.0.current_amount', 12000)
        ->assertJsonPath('data.0.current_effective_from', '2026-12-01');

    // Waktu dibekukan, jadi occurred_at sama dengan audit seeder; saring per pelaku.
    $log = AuditLog::query()->where('action', 'honor_component.version_created')->where('actor_id', $owner->id)->sole();
    expect($log->before)->toMatchArray(['amount' => 10000])->and($log->after)->toMatchArray(['amount' => 12000]);
});

it('menolak tarif di periode tertutup (423), tanggal ≤ versi terakhir (409), dan tarif flat untuk transport (422)', function () {
    actingAsRole(Role::Owner);
    PayrollPeriod::factory()->month(2026, 12)->closed()->create();
    $id = component('attendance')->id;

    $this->postJson("/api/v1/honor-components/{$id}/rates", ['amount' => 12000, 'effective_from' => '2026-12-05'])
        ->assertStatus(423)->assertJsonPath('code', 'LOCKED_PERIOD');
    $this->postJson("/api/v1/honor-components/{$id}/rates", ['amount' => 12000, 'effective_from' => '2026-01-01'])
        ->assertConflict();
    $this->postJson('/api/v1/honor-components/'.component('transport')->id.'/rates', ['amount' => 12000, 'effective_from' => '2027-01-01'])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['amount']);
});

it('membatalkan tarif terjadwal', function () {
    actingAsRole(Role::Owner);
    $id = component('teaching')->id;
    $rateId = $this->postJson("/api/v1/honor-components/{$id}/rates", ['amount' => 11000, 'effective_from' => '2026-12-01'])->json('data.id');

    $this->postJson("/api/v1/honor-components/{$id}/rates/{$rateId}/cancel", ['reason' => 'Batal'])->assertNoContent();
    $this->postJson('/api/v1/honor-components/'.component('attendance')->id."/rates/{$rateId}/cancel", ['reason' => 'x'])->assertNotFound();

    expect(HonorRates::flatAmountFor('teaching', Carbon::parse('2026-12-05')))->toBe(10000);
});

it('menonaktifkan komponen dan membatalkan penonaktifan terjadwal', function () {
    actingAsRole(Role::Owner);
    $id = newComponent()->json('data.id');
    $codes = fn (string $date) => HonorRates::activeComponentsOn(Carbon::parse($date))->pluck('code')->all();

    $this->postJson("/api/v1/honor-components/{$id}/deactivate", ['deactivated_from' => '2027-01-01'])
        ->assertUnprocessable()->assertJsonValidationErrors(['reason']);
    $this->postJson("/api/v1/honor-components/{$id}/deactivate", ['deactivated_from' => '2027-01-01', 'reason' => 'Tidak dipakai'])
        ->assertNoContent();

    expect($codes('2026-12-31'))->toContain('uang_makan')
        ->and($codes('2027-01-01'))->not->toContain('uang_makan')
        ->and(HonorRates::flatAmountFor('uang_makan', Carbon::parse('2027-01-01')))->toBeNull();

    $this->getJson("/api/v1/honor-components/{$id}")->assertJsonPath('data.status', 'scheduled_inactive')->assertJsonPath('data.status_label', 'Akan Nonaktif');
    $this->getJson("/api/v1/honor-components/{$id}?date=2027-01-01")->assertJsonPath('data.status', 'inactive');
    $this->postJson("/api/v1/honor-components/{$id}/rates", ['amount' => 1, 'effective_from' => '2027-02-01'])
        ->assertConflict()->assertJsonPath('message', 'Komponen nonaktif sejak 1 Januari 2027.');
    $this->postJson("/api/v1/honor-components/{$id}/deactivate", ['deactivated_from' => '2027-02-01', 'reason' => 'x'])->assertConflict();

    $this->postJson("/api/v1/honor-components/{$id}/cancel-deactivation", ['reason' => 'Masih dipakai'])->assertNoContent();

    expect($codes('2027-01-01'))->toContain('uang_makan')
        ->and(AuditLog::query()->where('action', 'honor_component.deactivated')->exists())->toBeTrue()
        ->and(AuditLog::query()->where('action', 'honor_component.deactivation_cancelled')->sole()->reason)->toBe('Masih dipakai');
});

it('menolak penonaktifan di periode tertutup dan pembatalan penonaktifan yang sudah berlaku', function () {
    actingAsRole(Role::Owner);
    PayrollPeriod::factory()->month(2026, 10)->approved()->create();
    $id = component('teaching')->id;

    $this->postJson("/api/v1/honor-components/{$id}/deactivate", ['deactivated_from' => '2026-10-15', 'reason' => 'x'])
        ->assertStatus(423)->assertJsonValidationErrors(['deactivated_from']);

    $this->postJson("/api/v1/honor-components/{$id}/deactivate", ['deactivated_from' => '2026-11-20', 'reason' => 'x'])->assertNoContent();
    $this->postJson("/api/v1/honor-components/{$id}/cancel-deactivation", ['reason' => 'x'])
        ->assertConflict()->assertJsonPath('message', 'Komponen yang sudah nonaktif tidak dapat diaktifkan kembali.');
});

it('PATCH mengubah nama dan menolak perubahan dasar perhitungan', function () {
    actingAsRole(Role::Owner);
    $id = component('attendance')->id;

    $this->patchJson("/api/v1/honor-components/{$id}", ['basis' => 'fixed_per_period'])
        ->assertUnprocessable()->assertJsonValidationErrors(['basis' => 'Dasar perhitungan tidak dapat diubah.']);
    $this->patchJson("/api/v1/honor-components/{$id}", ['name' => 'Honor Mengajar'])
        ->assertUnprocessable()->assertJsonValidationErrors(['name']);
    $this->patchJson("/api/v1/honor-components/{$id}", ['name' => 'Uang Hadir'])
        ->assertOk()->assertJsonPath('data.name', 'Uang Hadir')->assertJsonPath('data.basis', 'per_valid_session');

    $log = AuditLog::query()->where('action', 'honor_component.updated')->sole();
    expect($log->before)->toBe(['name' => 'Uang Kehadiran'])->and($log->after)->toBe(['name' => 'Uang Hadir']);
});

it('owner dan admin boleh melihat', function (Role $role) {
    actingAsRole($role);
    $id = component('attendance')->id;

    $this->getJson('/api/v1/honor-components')->assertOk()->assertJsonCount(4, 'data');
    $this->getJson("/api/v1/honor-components/{$id}")->assertOk()->assertJsonPath('data.rates.0.created_by_name', 'Sistem');
})->with('owner_admin');

it('hanya owner yang boleh mengubah', function (Role $role) {
    actingAsRole($role);
    $id = component('attendance')->id;
    $rateId = HonorComponentRate::query()->value('id');

    newComponent()->assertForbidden();
    $this->patchJson("/api/v1/honor-components/{$id}", ['name' => 'X'])->assertForbidden();
    $this->postJson("/api/v1/honor-components/{$id}/rates", ['amount' => 1, 'effective_from' => '2027-01-01'])->assertForbidden();
    $this->postJson("/api/v1/honor-components/{$id}/rates/{$rateId}/cancel", ['reason' => 'x'])->assertForbidden();
    $this->postJson("/api/v1/honor-components/{$id}/deactivate", ['deactivated_from' => '2027-01-01', 'reason' => 'x'])->assertForbidden();
    $this->postJson("/api/v1/honor-components/{$id}/cancel-deactivation", ['reason' => 'x'])->assertForbidden();
})->with('all_roles_except_owner');

it('tentor, kurir, dan teknisi tidak boleh melihat', function (Role $role) {
    actingAsRole($role);

    $this->getJson('/api/v1/honor-components')->assertForbidden();
    $this->getJson('/api/v1/honor-components/'.component('attendance')->id)->assertForbidden();
})->with('all_roles_except_owner_admin');
