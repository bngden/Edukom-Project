<?php

namespace App\Models;

use App\Enums\PayrollPeriodStatus;
use Database\Factories\PayrollPeriodFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Satu periode = satu bulan kalender; cut-off = hari terakhir bulan.
 */
class PayrollPeriod extends Model
{
    /** @use HasFactory<PayrollPeriodFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'starts_on' => 'immutable_date',
            'ends_on' => 'immutable_date',
            'status' => PayrollPeriodStatus::class,
        ];
    }
}
