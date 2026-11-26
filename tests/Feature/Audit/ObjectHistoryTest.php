<?php

use App\Enums\Role;
use App\Models\HonorComponent;
use App\Models\PolicyParameter;
use Database\Seeders\HonorComponentSeeder;
use Database\Seeders\PolicyParameterSeeder;

beforeEach(function () {
    $this->travelTo('2026-11-25 10:00:00');
    $this->withHeaders(spaHeaders());
    (new PolicyParameterSeeder)->run();
    (new HonorComponentSeeder)->run();
    actingAsRole(Role::Owner);
});

function historyActions(string $type, int $id): array
{
    return collect(test()->getJson("/api/v1/audit-logs?subject_type={$type}&subject_id={$id}")->assertOk()->json('data'))
        ->pluck('action')
        ->sort()
        ->values()
        ->all();
}

it('riwayat satu komponen honor memuat perubahan info, tarif, dan penonaktifan', function () {
    $id = HonorComponent::query()->where('code', 'attendance')->value('id');

    $this->patchJson("/api/v1/honor-components/{$id}", ['description' => 'Per sesi sah'])->assertOk();
    $this->postJson("/api/v1/honor-components/{$id}/rates", ['amount' => 12000, 'effective_from' => '2026-12-01'])->assertCreated();
    $this->postJson("/api/v1/honor-components/{$id}/deactivate", ['deactivated_from' => '2027-06-01', 'reason' => 'Uji'])->assertNoContent();

    // version_created pertama berasal dari seeder (nilai awal).
    expect(historyActions('honor_component', $id))->toBe([
        'honor_component.deactivated', 'honor_component.updated', 'honor_component.version_created', 'honor_component.version_created',
    ]);
});

it('riwayat komponen transport memuat perubahan set tingkatan jarak', function () {
    $id = HonorComponent::query()->where('code', HonorComponent::TRANSPORT)->value('id');

    $setId = $this->postJson("/api/v1/honor-components/{$id}/tier-sets", [
        'tiers' => [['max_km' => null, 'amount' => 9000]], 'effective_from' => '2026-12-01',
    ])->assertCreated()->json('data.id');
    $this->postJson("/api/v1/honor-components/{$id}/tier-sets/{$setId}/cancel", ['reason' => 'Batal'])->assertNoContent();

    expect(historyActions('honor_component', $id))->toBe([
        'transport_tier_set.version_cancelled', 'transport_tier_set.version_created', 'transport_tier_set.version_created',
    ]);
});

it('riwayat satu parameter memuat versi nilainya dengan alias subject_type pendek', function () {
    $parameter = PolicyParameter::query()->where('key', 'late_tolerance_minutes')->firstOrFail();

    $this->postJson('/api/v1/policy-parameters/late_tolerance_minutes/versions', ['value' => 20, 'effective_from' => '2026-12-01'])->assertCreated();

    expect(historyActions('policy_parameter', $parameter->id))->toBe(['policy_parameter.version_created', 'policy_parameter.version_created'])
        ->and($this->getJson("/api/v1/audit-logs?subject_type=policy_parameter&subject_id={$parameter->id}")->json('data.0.subject'))
        ->toMatchArray(['type' => 'policy_parameter', 'id' => (string) $parameter->id, 'label' => $parameter->label]);
});
