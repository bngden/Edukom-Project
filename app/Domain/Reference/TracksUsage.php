<?php

namespace App\Domain\Reference;

/**
 * Data referensi yang dipakai modul lain. Tabel pemakai didaftarkan di config('edukom.reference_usage').
 */
interface TracksUsage
{
    public function isUsed(): bool;

    public function usageCount(): int;
}
