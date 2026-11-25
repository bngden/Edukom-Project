<?php

namespace App\Domain\Payroll;

use App\Enums\PayrollPeriodStatus;
use App\Exceptions\ApiException;
use App\Models\PayrollPeriod;
use Carbon\CarbonInterface;

class PeriodGuard
{
    /**
     * Terkunci bila periode bulan tersebut ada dan statusnya selain Terbuka. Bulan tanpa periode = tidak terkunci.
     */
    public static function isLocked(CarbonInterface $date): bool
    {
        return PayrollPeriod::query()
            ->where('year', $date->year)
            ->where('month', $date->month)
            ->where('status', '!=', PayrollPeriodStatus::Open)
            ->exists();
    }

    public static function assertNotLocked(CarbonInterface $date, string $field = 'effective_from'): void
    {
        if (! self::isLocked($date)) {
            return;
        }

        $message = 'Tanggal berlaku jatuh pada periode penggajian '
            .$date->locale('id')->translatedFormat('F Y').' yang sudah ditutup.';

        throw ApiException::locked($message, 'LOCKED_PERIOD', [$field => [$message]]);
    }
}
