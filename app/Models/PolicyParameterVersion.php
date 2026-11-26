<?php

namespace App\Models;

use App\Domain\Versioning\HasEffectiveDating;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PolicyParameterVersion extends Model
{
    use HasEffectiveDating;

    protected $fillable = ['policy_parameter_id', 'value', 'effective_from'];

    protected function casts(): array
    {
        return ['value' => 'json'];
    }

    public function versionSeries(): Builder
    {
        return static::query()->where('policy_parameter_id', $this->policy_parameter_id);
    }

    public function versionAuditName(): string
    {
        return 'policy_parameter';
    }

    public function versionSubject(): Model
    {
        return $this->parameter;
    }

    public function versionLabel(): ?string
    {
        return $this->parameter?->label;
    }

    public function parameter(): BelongsTo
    {
        return $this->belongsTo(PolicyParameter::class, 'policy_parameter_id');
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
