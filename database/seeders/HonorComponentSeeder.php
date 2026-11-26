<?php

namespace Database\Seeders;

use App\Domain\Honorarium\TransportTierSets;
use App\Domain\Versioning\VersionTimeline;
use App\Enums\HonorBasis;
use App\Enums\RateType;
use App\Models\HonorComponent;
use App\Models\HonorComponentRate;
use Illuminate\Database\Seeder;

/**
 * Empat komponen bawaan (idempoten; nama yang sudah diubah Owner tidak ditimpa). Semua environment.
 */
class HonorComponentSeeder extends Seeder
{
    private const SYSTEM = [
        'attendance' => ['Uang Kehadiran', HonorBasis::PerValidSession, RateType::Flat, 10_000],
        'teaching' => ['Honor Mengajar', HonorBasis::PerValidSession, RateType::Flat, 10_000],
        HonorComponent::TRANSPORT => ['Uang Transportasi', HonorBasis::PerSchoolVisit, RateType::DistanceTiers, null],
        'completeness_bonus' => ['Uang Bonus Kelengkapan Administrasi', HonorBasis::PerSchoolPerPeriod, RateType::Flat, 20_000,
            'Diberikan per sekolah bila status kelengkapan administrasi tentor pada sekolah tersebut Lengkap.'],
    ];

    private const TRANSPORT_TIERS = [
        ['max_km' => '10.0', 'amount' => 10_000],
        ['max_km' => null, 'amount' => 15_000],
    ];

    public function run(): void
    {
        $order = 0;

        foreach (self::SYSTEM as $code => [$name, $basis, $rateType, $amount]) {
            $component = HonorComponent::query()->firstOrCreate(['code' => $code], [
                'name' => $name,
                'description' => self::SYSTEM[$code][4] ?? null,
                'basis' => $basis,
                'rate_type' => $rateType,
                'is_system' => true,
                'sort_order' => ++$order,
            ]);

            if ($rateType === RateType::DistanceTiers) {
                if (! $component->tierSets()->exists()) {
                    TransportTierSets::add($component, self::TRANSPORT_TIERS, config('edukom.policy_base_date'), 'Nilai awal');
                }

                continue;
            }

            if ($component->rates()->exists()) {
                continue;
            }

            VersionTimeline::add((new HonorComponentRate([
                'honor_component_id' => $component->id,
                'amount' => $amount,
                'effective_from' => config('edukom.policy_base_date'),
            ]))->setRelation('component', $component), 'Nilai awal');
        }
    }
}
