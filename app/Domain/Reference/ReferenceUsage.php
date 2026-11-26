<?php

namespace App\Domain\Reference;

use Illuminate\Support\Facades\DB;

/**
 * Menghitung pemakaian data referensi dari tabel yang terdaftar di config('edukom.reference_usage').
 */
class ReferenceUsage
{
    /**
     * Jumlah pemakaian per id (satu query per tabel terdaftar).
     *
     * @param  class-string  $model
     * @param  iterable<int>  $ids
     * @return array<int, int>
     */
    public static function countsFor(string $model, iterable $ids): array
    {
        $ids = collect($ids)->values()->all();
        $counts = array_fill_keys($ids, 0);

        if ($ids === []) {
            return $counts;
        }

        foreach (config("edukom.reference_usage.{$model}", []) as [$table, $column]) {
            $rows = DB::table($table)
                ->whereIn($column, $ids)
                ->groupBy($column)
                ->select($column)
                ->selectRaw('count(*) as total')
                ->pluck('total', $column);

            foreach ($rows as $id => $total) {
                $counts[$id] += (int) $total;
            }
        }

        return $counts;
    }
}
