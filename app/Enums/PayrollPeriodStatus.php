<?php

namespace App\Enums;

enum PayrollPeriodStatus: string
{
    case Open = 'open';
    case Closed = 'closed';
    case AwaitingApproval = 'awaiting_approval';
    case PartiallyApproved = 'partially_approved';
    case Approved = 'approved';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Open => 'Terbuka',
            self::Closed => 'Ditutup',
            self::AwaitingApproval => 'Menunggu Persetujuan',
            self::PartiallyApproved => 'Disetujui Sebagian',
            self::Approved => 'Disetujui',
            self::Rejected => 'Ditolak',
        };
    }
}
