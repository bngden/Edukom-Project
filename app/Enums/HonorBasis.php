<?php

namespace App\Enums;

enum HonorBasis: string
{
    case PerValidSession = 'per_valid_session';
    case PerSchoolVisit = 'per_school_visit';
    case PerSchoolPerPeriod = 'per_school_per_period';
    case FixedPerPeriod = 'fixed_per_period';

    public function label(): string
    {
        return match ($this) {
            self::PerValidSession => 'Per sesi sah',
            self::PerSchoolVisit => 'Per kunjungan sekolah',
            self::PerSchoolPerPeriod => 'Per sekolah per periode',
            self::FixedPerPeriod => 'Tetap per periode',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::PerValidSession => 'Dibayar untuk setiap sesi mengajar yang sah.',
            self::PerSchoolVisit => 'Dibayar sekali per sekolah per hari kunjungan.',
            self::PerSchoolPerPeriod => 'Dibayar sekali per sekolah dalam satu periode penggajian.',
            self::FixedPerPeriod => 'Nominal tetap sekali per periode penggajian.',
        };
    }
}
