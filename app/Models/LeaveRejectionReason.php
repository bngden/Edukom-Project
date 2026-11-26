<?php

namespace App\Models;

use App\Domain\Reference\ReferenceUsage;
use App\Domain\Reference\TracksUsage;
use Illuminate\Database\Eloquent\Model;

/**
 * Alasan baku penolakan izin dan calon tentor pengganti (OW-03). Hanya boleh dihapus bila belum pernah dipakai.
 */
class LeaveRejectionReason extends Model implements TracksUsage
{
    protected $fillable = ['name', 'description', 'sort_order'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'deactivated_at' => 'immutable_datetime',
        ];
    }

    public function isUsed(): bool
    {
        return $this->usageCount() > 0;
    }

    public function usageCount(): int
    {
        return ReferenceUsage::countsFor(static::class, [$this->id])[$this->id];
    }
}
