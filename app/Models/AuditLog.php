<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LogicException;

/**
 * Riwayat perubahan, append-only. Tulis lewat App\Domain\Audit\Audit::record().
 */
class AuditLog extends Model
{
    use HasUlids;

    public $timestamps = false;

    protected $guarded = [];

    protected static function booted(): void
    {
        $block = static fn () => throw new LogicException('Riwayat perubahan tidak dapat diubah atau dihapus.');

        static::updating($block);
        static::deleting($block);
    }

    protected function casts(): array
    {
        return [
            'occurred_at' => 'immutable_datetime',
            'before' => 'array',
            'after' => 'array',
        ];
    }

    public function actor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'actor_id');
    }
}
