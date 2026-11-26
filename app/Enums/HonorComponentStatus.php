<?php

namespace App\Enums;

enum HonorComponentStatus: string
{
    case Active = 'active';
    case ScheduledInactive = 'scheduled_inactive';
    case Inactive = 'inactive';

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Aktif',
            self::ScheduledInactive => 'Akan Nonaktif',
            self::Inactive => 'Nonaktif',
        };
    }
}
