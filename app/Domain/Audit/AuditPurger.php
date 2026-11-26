<?php

namespace App\Domain\Audit;

use App\Models\AuditLog;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\DB;

/**
 * Satu-satunya jalur penghapusan riwayat perubahan (trigger DB menolak DELETE tanpa @edukom_audit_purge = 1).
 */
class AuditPurger
{
    public static function countBefore(CarbonInterface $before): int
    {
        return AuditLog::query()->where('occurred_at', '<', $before)->count();
    }

    public static function purgeBefore(CarbonInterface $before): int
    {
        $deleted = 0;

        DB::statement('SET @edukom_audit_purge = 1');

        try {
            // Bulk delete tidak memicu event model, jadi penjaga `deleting` di AuditLog tidak terpanggil.
            do {
                $batch = AuditLog::query()->where('occurred_at', '<', $before)->limit(1000)->delete();
                $deleted += $batch;
            } while ($batch === 1000);
        } finally {
            DB::statement('SET @edukom_audit_purge = NULL');
        }

        return $deleted;
    }
}
