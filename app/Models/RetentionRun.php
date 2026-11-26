<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Satu kali pembersihan masa simpan. summary: list per jenis {type, label, months, cutoff, count, status, message}.
 */
class RetentionRun extends Model
{
    public const RUNNING = 'running';

    public const SUCCESS = 'success';

    public const PARTIAL = 'partial';

    public const FAILED = 'failed';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'started_at' => 'immutable_datetime',
            'finished_at' => 'immutable_datetime',
            'dry_run' => 'boolean',
            'summary' => 'array',
        ];
    }

    public function trigger(): BelongsTo
    {
        return $this->belongsTo(User::class, 'triggered_by');
    }

    /**
     * Pembersihan sungguhan (bukan uji) terakhir.
     */
    public static function lastReal(): ?self
    {
        return static::query()->with('trigger:id,name')->where('dry_run', false)->latest('started_at')->first();
    }

    public function tone(): string
    {
        return match ($this->status) {
            self::SUCCESS => 'success',
            self::PARTIAL => 'warning',
            self::FAILED => 'danger',
            default => 'neutral',
        };
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            self::RUNNING => 'Berjalan',
            self::SUCCESS => 'Berhasil',
            self::PARTIAL => 'Sebagian gagal',
            default => 'Gagal',
        };
    }
}
