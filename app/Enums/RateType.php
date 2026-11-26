<?php

namespace App\Enums;

enum RateType: string
{
    case Flat = 'flat';
    case DistanceTiers = 'distance_tiers';

    public function label(): string
    {
        return match ($this) {
            self::Flat => 'Nominal tetap',
            self::DistanceTiers => 'Tingkatan jarak',
        };
    }
}
