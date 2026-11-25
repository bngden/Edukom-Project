<?php

namespace App\Enums;

enum VersionStatus: string
{
    case Scheduled = 'scheduled';
    case Active = 'active';
    case Ended = 'ended';
    case Cancelled = 'cancelled';

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
