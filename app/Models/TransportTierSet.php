<?php

namespace App\Models;

use App\Domain\Versioning\HasEffectiveDating;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Satu versi set tingkatan jarak uang transportasi.
 */
class TransportTierSet extends Model
{
    use HasEffectiveDating;

    protected $fillable = ['honor_component_id', 'effective_from'];

    public function versionSeries(): Builder
    {
        return static::query()->where('honor_component_id', $this->honor_component_id);
    }

    public function versionSubject(): Model
    {
        return $this->component;
    }

    public function versionLabel(): ?string
    {
        return $this->component?->name;
    }

    /**
     * Isi versi untuk audit: daftar tingkatan, bukan kolom baris set.
     *
     * @return array<string, mixed>
     */
    public function versionContent(): array
    {
        return [
            'effective_from' => $this->effective_from->toDateString(),
            'tiers' => $this->tiers->map(fn (TransportTier $t) => [
                'max_km' => $t->max_km_inclusive,
                'amount' => $t->amount,
            ])->all(),
        ];
    }

    public function tiers(): HasMany
    {
        return $this->hasMany(TransportTier::class)->orderBy('position');
    }

    public function component(): BelongsTo
    {
        return $this->belongsTo(HonorComponent::class, 'honor_component_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function canceller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }
}
