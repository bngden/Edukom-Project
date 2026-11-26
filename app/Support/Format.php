<?php

namespace App\Support;

use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;

/**
 * Format tampilan Indonesia (halaman web dan pesan galat).
 */
class Format
{
    public static function rupiah(?int $amount): string
    {
        return $amount === null ? '—' : 'Rp'.number_format($amount, 0, ',', '.');
    }

    /**
     * "10.0" → "10", "12.5" → "12,5".
     */
    public static function km(string|int|float|null $km): string
    {
        return $km === null ? '' : str_replace('.', ',', preg_replace('/\.0$/', '', (string) $km));
    }

    /**
     * "1 Desember 2026" (panjang) atau "1 Des 2026" (pendek).
     */
    public static function date(CarbonInterface|string $date, bool $short = false): string
    {
        return Carbon::parse($date)->locale('id')->translatedFormat($short ? 'j M Y' : 'j F Y');
    }
}
