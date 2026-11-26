<?php

namespace App\Domain\Honorarium;

use App\Domain\Versioning\VersionTimeline;
use App\Enums\RateType;
use App\Exceptions\ApiException;
use App\Models\HonorComponent;
use App\Models\TransportTier;
use App\Models\TransportTierSet;
use App\Support\Format;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Set tingkatan jarak uang transportasi. Satu set = satu versi; dibatalkan lewat VersionTimeline::cancel.
 */
class TransportTierSets
{
    /**
     * @param  list<array{max_km: string|int|float|null, amount: int}>  $tiers  urut naik; baris terakhir max_km null
     */
    public static function add(HonorComponent $component, array $tiers, string $effectiveFrom, ?string $reason = null): TransportTierSet
    {
        if ($component->rate_type !== RateType::DistanceTiers) {
            $message = 'Komponen ini memakai nominal tetap, bukan tingkatan jarak.';

            throw ApiException::validation($message, ['tiers' => [$message]]);
        }

        $set = (new TransportTierSet([
            'honor_component_id' => $component->id,
            'effective_from' => $effectiveFrom,
        ]))->setRelation('component', $component);

        if (! $component->isActiveOn($set->effective_from)) {
            throw ApiException::conflict('Komponen nonaktif sejak '.Format::date($component->deactivated_from).'.');
        }

        $set->setRelation('tiers', new Collection(self::makeTiers($tiers)));

        return DB::transaction(function () use ($set, $reason) {
            VersionTimeline::add($set, $reason);
            $set->tiers()->saveMany($set->tiers);

            return $set;
        });
    }

    /**
     * @param  list<array{max_km: string|int|float|null, amount: int}>  $tiers
     * @return list<TransportTier>
     */
    private static function makeTiers(array $tiers): array
    {
        $models = [];
        $min = '0.0';

        foreach (array_values($tiers) as $i => $tier) {
            $max = $tier['max_km'] === null ? null : HonorRates::roundKm($tier['max_km']);
            $models[] = new TransportTier([
                'position' => $i + 1,
                'min_km_exclusive' => $min,
                'max_km_inclusive' => $max,
                'amount' => $tier['amount'],
            ]);
            $min = $max;
        }

        return $models;
    }
}
