<?php

namespace App\Enums;

enum VersionStatus: string
{
    case Scheduled = 'scheduled';
    case Active = 'active';
    case Ended = 'ended';
    case Cancelled = 'cancelled';

    /**
     * Warna chip status di halaman web (komponen x-chip).
     */
    public function tone(): string
    {
        return match ($this) {
            self::Scheduled => 'info',
            self::Active => 'success',
            self::Ended, self::Cancelled => 'neutral',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Scheduled => 'Terjadwal',
            self::Active => 'Berlaku',
            self::Ended => 'Berakhir',
            self::Cancelled => 'Dibatalkan',
        };
    }
}
