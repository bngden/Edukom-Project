<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Satu tingkatan: jarak > min_km_exclusive sampai <= max_km_inclusive (null = tanpa batas atas).
 */
class TransportTier extends Model
{
    protected $fillable = ['position', 'min_km_exclusive', 'max_km_inclusive', 'amount'];

    protected function casts(): array
    {
        return [
            'position' => 'integer',
            'min_km_exclusive' => 'decimal:1',
            'max_km_inclusive' => 'decimal:1',
            'amount' => 'integer',
        ];
    }
}
