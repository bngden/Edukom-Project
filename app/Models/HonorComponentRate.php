<?php

namespace App\Models;

use App\Domain\Versioning\HasEffectiveDating;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HonorComponentRate extends Model
{
    use HasEffectiveDating;

    protected $fillable = ['honor_component_id', 'amount', 'effective_from'];

    protected function casts(): array
    {
        return ['amount' => 'integer'];
    }

    public function versionSeries(): Builder
    {
        return static::query()->where('honor_component_id', $this->honor_component_id);
    }

    public function versionAuditName(): string
    {
        return 'honor_component';
    }

    public function versionSubject(): Model
    {
        return $this->component;
    }

    public function versionLabel(): ?string
    {
        return $this->component?->name;
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
