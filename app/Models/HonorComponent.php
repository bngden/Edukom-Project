<?php

namespace App\Models;

use App\Enums\HonorBasis;
use App\Enums\HonorComponentStatus;
use App\Enums\RateType;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Komponen honorarium. Tidak pernah dihapus; dinonaktifkan lewat deactivated_from.
 */
class HonorComponent extends Model
{
    public const TRANSPORT = 'transport';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'basis' => HonorBasis::class,
            'rate_type' => RateType::class,
            'is_system' => 'boolean',
            'deactivated_from' => 'immutable_date:Y-m-d',
        ];
    }

    public function rates(): HasMany
    {
        return $this->hasMany(HonorComponentRate::class)->chaperone('component');
    }

    public function tierSets(): HasMany
    {
        return $this->hasMany(TransportTierSet::class)->chaperone('component');
    }

    public function isActiveOn(CarbonInterface $date): bool
    {
        return $this->deactivated_from === null || $date->lt($this->deactivated_from);
    }

    public function statusOn(CarbonInterface $date): HonorComponentStatus
    {
        return match (true) {
            $this->deactivated_from === null => HonorComponentStatus::Active,
            $this->isActiveOn($date) => HonorComponentStatus::ScheduledInactive,
            default => HonorComponentStatus::Inactive,
        };
    }

    /**
     * Komponen yang masih dipakai pada $date (padanan query dari isActiveOn).
     */
    #[Scope]
    protected function activeOn(Builder $query, CarbonInterface $date): void
    {
        $query->where(fn (Builder $q) => $q->whereNull('deactivated_from')->orWhere('deactivated_from', '>', $date->toDateString()));
    }
}
