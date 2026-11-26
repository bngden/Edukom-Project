<?php

namespace App\Domain\Honorarium;

use App\Models\HonorComponent;
use App\Models\HonorComponentRate;
use App\Models\TransportTier;
use App\Models\TransportTierSet;
use App\Support\Format;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use InvalidArgumentException;

/**
 * Membaca tarif honorarium pada tanggal kejadian (dipakai modul penggajian).
 */
class HonorRates
{
    /**
     * @return Collection<int, HonorComponent>
     */
    public static function activeComponentsOn(CarbonInterface $date): Collection
    {
        return HonorComponent::query()
            ->activeOn($date)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Nominal tarif flat yang berlaku; null bila belum ada tarif atau komponen nonaktif pada tanggal itu.
     */
    public static function flatAmountFor(HonorComponent|string $component, CarbonInterface $date): ?int
    {
        $component = is_string($component) ? HonorComponent::query()->where('code', $component)->first() : $component;

        if ($component === null || ! $component->isActiveOn($date)) {
            return null;
        }

        return HonorComponentRate::query()
            ->where('honor_component_id', $component->id)
            ->activeOn($date)
            ->first(['amount'])
            ?->amount;
    }

    /**
     * Uang transportasi untuk jarak domisili ke sekolah; null bila transport nonaktif atau belum ada set berlaku.
     */
    public static function transportAmountFor(float|int|string $distanceKm, CarbonInterface $date): ?int
    {
        $km = self::roundKm($distanceKm);

        return self::transportTiersOn($date)
            ?->first(fn (TransportTier $t) => $t->max_km_inclusive === null || bccomp($km, $t->max_km_inclusive, 1) <= 0)
            ?->amount;
    }

    /**
     * @return Collection<int, TransportTier>|null
     */
    public static function transportTiersOn(CarbonInterface $date): ?Collection
    {
        $component = HonorComponent::query()->where('code', HonorComponent::TRANSPORT)->first();

        if ($component === null || ! $component->isActiveOn($date)) {
            return null;
        }

        return TransportTierSet::query()
            ->where('honor_component_id', $component->id)
            ->activeOn($date)
            ->first(['id'])
            ?->tiers;
    }

    /**
     * Contoh: "≤ 10 km: Rp10.000 · > 10 km: Rp15.000".
     */
    public static function transportSummary(CarbonInterface $date): ?string
    {
        $tiers = self::transportTiersOn($date);

        return $tiers === null ? null : self::summarizeTiers($tiers);
    }

    /**
     * @param  iterable<TransportTier>  $tiers  urut berdasarkan position
     */
    public static function summarizeTiers(iterable $tiers): string
    {
        $parts = [];

        foreach ($tiers as $t) {
            $min = $t->position === 1 ? null : Format::km($t->min_km_exclusive);
            $range = match (true) {
                $t->max_km_inclusive === null && $min === null => 'Semua jarak',
                $t->max_km_inclusive === null => "> {$min} km",
                $min === null => '≤ '.Format::km($t->max_km_inclusive).' km',
                default => "> {$min}–".Format::km($t->max_km_inclusive).' km',
            };
            $parts[] = $range.': '.Format::rupiah($t->amount);
        }

        return implode(' · ', $parts);
    }

    /**
     * Bulatkan jarak ke 1 desimal (half up) dengan aritmetika desimal, bukan perbandingan float.
     */
    public static function roundKm(float|int|string $km): string
    {
        $value = is_float($km) ? sprintf('%.10F', $km) : trim((string) $km);

        if (! is_numeric($value) || bccomp($value, '0', 10) < 0) {
            throw new InvalidArgumentException("Jarak tidak valid: {$value}");
        }

        return bcadd($value, '0.05', 1);
    }
}
