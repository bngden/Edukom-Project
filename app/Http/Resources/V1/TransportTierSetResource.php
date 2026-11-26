<?php

namespace App\Http\Resources\V1;

use App\Domain\Honorarium\HonorRates;
use App\Models\TransportTier;
use App\Models\TransportTierSet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Butuh relasi `tiers`.
 *
 * @mixin TransportTierSet
 */
class TransportTierSetResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $status = $this->versionStatus();

        return [
            'id' => $this->id,
            'tiers' => $this->tiers->map(fn (TransportTier $t) => [
                'position' => $t->position,
                'min_km_exclusive' => $t->min_km_exclusive,
                'max_km' => $t->max_km_inclusive,
                'amount' => $t->amount,
            ]),
            'summary' => HonorRates::summarizeTiers($this->tiers),
            'effective_from' => $this->effective_from->toDateString(),
            'effective_to' => $this->effective_to?->toDateString(),
            'status' => $status->value,
            'status_label' => $status->label(),
            'reason' => $this->reason,
            'created_by_name' => $this->when($this->relationLoaded('creator'), fn () => $this->creator?->name ?? 'Sistem'),
            'created_at' => $this->created_at?->toIso8601String(),
            'cancelled_at' => $this->cancelled_at?->toIso8601String(),
            'cancelled_by_name' => $this->when($this->relationLoaded('canceller'), fn () => $this->canceller?->name),
            'cancel_reason' => $this->cancel_reason,
        ];
    }
}
