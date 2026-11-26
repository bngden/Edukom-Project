<?php

use App\Domain\Honorarium\HonorRates;
use App\Enums\Role;
use App\Models\AuditLog;
use App\Models\HonorComponent;
use App\Models\PayrollPeriod;
use App\Models\TransportTierSet;
use Database\Seeders\HonorComponentSeeder;
use Illuminate\Support\Carbon;

beforeEach(function () {
    $this->travelTo('2026-11-25 10:00:00');
    $this->withHeaders(spaHeaders());
    (new HonorComponentSeeder)->run();
});

function transportId(): int
{
    return HonorComponent::query()->where('code', HonorComponent::TRANSPORT)->value('id');
}

function postTierSet(array $tiers, array $overrides = [], ?int $componentId = null)
{
    return test()->postJson('/api/v1/honor-components/'.($componentId ?? transportId()).'/tier-sets', [
        'tiers' => $tiers,
        'effective_from' => '2026-12-01',
        ...$overrides,
    ]);
}

it('seeder membuat set awal ≤ 10 km Rp10.000 dan > 10 km Rp15.000, idempoten', function () {
    (new HonorComponentSeeder)->run();

    expect(TransportTierSet::query()->count())->toBe(1)
        ->and(HonorRates::transportSummary(Carbon::parse('2026-11-25')))->toBe('≤ 10 km: Rp10.000 · > 10 km: Rp15.000');

    actingAsRole(Role::Admin);
    $this->getJson('/api/v1/honor-components')
        ->assertOk()
        ->assertJsonPath('data.2.current_tier_set.summary', '≤ 10 km: Rp10.000 · > 10 km: Rp15.000')
        ->assertJsonPath('data.2.current_tier_set.tiers.0.max_km', '10.0')
        ->assertJsonPath('data.2.scheduled_tier_set', null)
        ->assertJsonMissingPath('data.0.current_tier_set');
});

it('transportAmountFor membulatkan jarak ke 1 desimal (half up) lalu memilih tingkatan', function (float|string $km, int $expected) {
    expect(HonorRates::transportAmountFor($km, Carbon::parse('2026-11-25')))->toBe($expected);
})->with([
    '0 km' => [0, 10000],
    '9,96 km → 10,0' => [9.96, 10000],
    '10,0 km' => ['10.0', 10000],
    '10,04 km → 10,0' => [10.04, 10000],
    '10,05 km → 10,1' => [10.05, 15000],
    '10,05 km (string) → 10,1' => ['10.05', 15000],
    '37 km' => [37, 15000],
]);

it('menolak set tingkatan tidak valid', function (array $tiers, string $field) {
    actingAsRole(Role::Owner);

    postTierSet($tiers)->assertUnprocessable()->assertJsonValidationErrors([$field]);
})->with([
    'max_km tidak naik' => [[['max_km' => 10, 'amount' => 1], ['max_km' => 10, 'amount' => 2], ['max_km' => null, 'amount' => 3]], 'tiers.1.max_km'],
    'null di tengah' => [[['max_km' => 5, 'amount' => 1], ['max_km' => null, 'amount' => 2], ['max_km' => 20, 'amount' => 3], ['max_km' => null, 'amount' => 4]], 'tiers.1.max_km'],
    'null tidak di akhir' => [[['max_km' => 5, 'amount' => 1], ['max_km' => 20, 'amount' => 3]], 'tiers.1.max_km'],
    'desimal lebih dari 1 digit' => [[['max_km' => 10.25, 'amount' => 1], ['max_km' => null, 'amount' => 2]], 'tiers.0.max_km'],
    'nominal negatif' => [[['max_km' => 10, 'amount' => -1], ['max_km' => null, 'amount' => 2]], 'tiers.0.amount'],
    'daftar kosong' => [[], 'tiers'],
]);

it('set baru menggantikan set lama pada tanggal berlaku dan tercatat di audit', function () {
    $owner = actingAsRole(Role::Owner);

    postTierSet([['max_km' => 5, 'amount' => 8000], ['max_km' => 12.5, 'amount' => 12000], ['max_km' => null, 'amount' => 20000]], ['reason' => 'Kenaikan BBM'])
        ->assertCreated()
        ->assertJsonPath('data.status', 'scheduled')
        ->assertJsonPath('data.summary', '≤ 5 km: Rp8.000 · > 5–12,5 km: Rp12.000 · > 12,5 km: Rp20.000')
        ->assertJsonPath('data.tiers.1.min_km_exclusive', '5.0');

    expect(HonorRates::transportAmountFor(12, Carbon::parse('2026-11-30')))->toBe(15000)
        ->and(HonorRates::transportAmountFor(12, Carbon::parse('2026-12-01')))->toBe(12000)
        ->and(TransportTierSet::query()->oldest('id')->first()->effective_to->toDateString())->toBe('2026-11-30');

    $this->getJson('/api/v1/honor-components/'.transportId())
        ->assertJsonPath('data.current_tier_set.summary', '≤ 10 km: Rp10.000 · > 10 km: Rp15.000')
        ->assertJsonPath('data.scheduled_tier_set.effective_from', '2026-12-01');

    $this->getJson('/api/v1/honor-components/'.transportId().'/tier-sets')
        ->assertOk()
        ->assertJsonCount(2, 'data')
        ->assertJsonPath('data.0.created_by_name', $owner->name);

    $log = AuditLog::query()->where('action', 'transport_tier_set.version_created')->where('actor_id', $owner->id)->sole();
    expect($log->subject_label)->toBe('Uang Transportasi')
        ->and($log->reason)->toBe('Kenaikan BBM')
        ->and($log->before['tiers'])->toBe([['max_km' => '10.0', 'amount' => 10000], ['max_km' => null, 'amount' => 15000]])
        ->and($log->after['tiers'])->toHaveCount(3);
});

it('menolak tanggal di periode tertutup (423), tanggal ≤ versi terakhir (409), dan komponen non-tingkatan (422)', function () {
    actingAsRole(Role::Owner);
    PayrollPeriod::factory()->month(2026, 12)->closed()->create();
    $tiers = [['max_km' => 10, 'amount' => 1], ['max_km' => null, 'amount' => 2]];

    postTierSet($tiers, ['effective_from' => '2026-12-05'])->assertStatus(423)->assertJsonPath('code', 'LOCKED_PERIOD');
    postTierSet($tiers, ['effective_from' => '2026-01-01'])->assertConflict();

    $attendance = HonorComponent::query()->where('code', 'attendance')->value('id');
    postTierSet($tiers, ['effective_from' => '2027-01-01'], $attendance)->assertUnprocessable()->assertJsonValidationErrors(['tiers']);
});

it('membatalkan set terjadwal sehingga set lama berlaku lagi', function () {
    actingAsRole(Role::Owner);
    $id = postTierSet([['max_km' => null, 'amount' => 9000]])->json('data.id');

    $this->postJson('/api/v1/honor-components/'.transportId()."/tier-sets/{$id}/cancel", ['reason' => 'Batal'])->assertNoContent();

    expect(HonorRates::transportAmountFor(3, Carbon::parse('2026-12-05')))->toBe(10000)
        ->and(AuditLog::query()->where('action', 'transport_tier_set.version_cancelled')->exists())->toBeTrue();
});

it('transport nonaktif mengembalikan null', function () {
    actingAsRole(Role::Owner);

    $this->postJson('/api/v1/honor-components/'.transportId().'/deactivate', ['deactivated_from' => '2027-01-01', 'reason' => 'Tidak dipakai'])
        ->assertNoContent();

    expect(HonorRates::transportAmountFor(5, Carbon::parse('2026-12-31')))->toBe(10000)
        ->and(HonorRates::transportAmountFor(5, Carbon::parse('2027-01-01')))->toBeNull()
        ->and(HonorRates::transportSummary(Carbon::parse('2027-01-01')))->toBeNull();

    postTierSet([['max_km' => null, 'amount' => 1]], ['effective_from' => '2027-02-01'])->assertConflict();
});

it('owner dan admin boleh melihat riwayat set tingkatan', function (Role $role) {
    actingAsRole($role);

    $this->getJson('/api/v1/honor-components/'.transportId().'/tier-sets')->assertOk()->assertJsonCount(1, 'data');
})->with([Role::Owner, Role::Admin]);

it('tentor, kurir, dan teknisi tidak boleh melihat riwayat set tingkatan', function (Role $role) {
    actingAsRole($role);

    $this->getJson('/api/v1/honor-components/'.transportId().'/tier-sets')->assertForbidden();
})->with('all_roles_except_owner_admin');

it('hanya owner yang boleh mengubah atau membatalkan set tingkatan', function (Role $role) {
    actingAsRole($role);
    $id = TransportTierSet::query()->value('id');

    postTierSet([['max_km' => null, 'amount' => 1]])->assertForbidden();
    $this->postJson('/api/v1/honor-components/'.transportId()."/tier-sets/{$id}/cancel", ['reason' => 'x'])->assertForbidden();
})->with('all_roles_except_owner');

it('menolak akses tanpa login', function () {
    $this->getJson('/api/v1/honor-components/'.transportId().'/tier-sets')->assertUnauthorized();
    postTierSet([['max_km' => null, 'amount' => 1]])->assertUnauthorized();
});
