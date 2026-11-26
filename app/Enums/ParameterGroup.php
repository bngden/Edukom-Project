<?php

namespace App\Enums;

enum ParameterGroup: string
{
    case Learning = 'learning';
    case Attendance = 'attendance';
    case Leave = 'leave';
    case Payroll = 'payroll';
    case Operational = 'operational';
    case Retention = 'retention';

    public function label(): string
    {
        return match ($this) {
            self::Learning => 'Pembelajaran',
            self::Attendance => 'Presensi',
            self::Leave => 'Izin & Penggantian',
            self::Payroll => 'Penggajian',
            self::Operational => 'Operasional',
            self::Retention => 'Masa Simpan',
        };
    }
}
