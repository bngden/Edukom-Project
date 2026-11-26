<?php

namespace App\Domain\Audit;

use App\Models\AuditLog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

/**
 * Daftar riwayat perubahan terfilter, terbaru dulu (dipakai API dan halaman Riwayat Perubahan).
 */
class AuditLogQuery
{
    /**
     * @param  array{subject_type?: string|null, subject_id?: string|null, actor_id?: int|null, action?: string|null, date_from?: string|null, date_to?: string|null}  $filters
     */
    public static function paginate(array $filters, int $perPage = 25): LengthAwarePaginator
    {
        return AuditLog::query()
            ->with('actor:id,name')
            ->where(array_filter(Arr::only($filters, ['subject_type', 'subject_id', 'actor_id', 'action'])))
            ->when($filters['date_from'] ?? null, fn ($q, $v) => $q->where('occurred_at', '>=', Carbon::parse($v)))
            ->when($filters['date_to'] ?? null, fn ($q, $v) => $q->where('occurred_at', '<', Carbon::parse($v)->addDay()))
            ->orderByDesc('occurred_at')
            ->orderByDesc('id')
            ->paginate($perPage);
    }
}
