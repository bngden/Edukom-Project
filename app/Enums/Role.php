<?php

namespace App\Enums;

enum Role: string
{
    case Owner = 'owner';
    case Admin = 'admin';
    case Tentor = 'tentor';
    case Kurir = 'kurir';
    case Teknisi = 'teknisi';

    public function label(): string
    {
        return match ($this) {
            self::Owner => 'Owner',
            self::Admin => 'Admin',
            self::Tentor => 'Tentor',
            self::Kurir => 'Kurir',
            self::Teknisi => 'Teknisi',
        };
    }

    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
