<?php

namespace App\Http\Resources\V1;

use App\Enums\RateType;
use App\Models\HonorComponent;
use App\Models\HonorComponentRate;
use App\Models\TransportTierSet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Status dan tarif dihitung pada ?date= (default hari ini). Butuh relasi `rates` (dan `tierSets.tiers` untuk
 * komponen tingkatan jarak) terurut effective_from menurun.
 *
 * @mixin HonorComponent
 */
class HonorComponentResource extends JsonResource
{
    public bool $withHistory = false;

    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $date = $request->date('date') ?? today();
        [$current, $scheduled] = HonorComponentRate::currentAndScheduled($this->rates, $date);
        $tiered = $this->rate_type === RateType::DistanceTiers;
        [$currentTiers, $scheduledTiers] = $tiered ? TransportTierSet::currentAndScheduled($this->tierSets, $date) : [null, null];
        $status = $this->statusOn($date);

        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'basis' => $this->basis->value,
            'basis_label' => $this->basis->label(),
            'rate_type' => $this->rate_type->value,
            'rate_type_label' => $this->rate_type->label(),
            'is_system' => $this->is_system,
            'sort_order' => $this->sort_order,
            'status' => $status->value,
            'status_label' => $status->label(),
            'deactivated_from' => $this->deactivated_from?->toDateString(),
            'deactivation_reason' => $this->deactivation_reason,
            'current_amount' => $current?->amount,
            'current_effective_from' => $current?->effective_from->toDateString(),
            'scheduled_rate' => $scheduled ? new HonorComponentRateResource($scheduled) : null,
            'rates' => $this->when($this->withHistory, fn () => HonorComponentRateResource::collection($this->rates)),
            $this->mergeWhen($tiered, fn () => [
                'current_tier_set' => $currentTiers ? new TransportTierSetResource($currentTiers) : null,
                'scheduled_tier_set' => $scheduledTiers ? new TransportTierSetResource($scheduledTiers) : null,
            ]),
        ];
    }
}
