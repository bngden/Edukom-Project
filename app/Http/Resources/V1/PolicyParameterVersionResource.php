<?php

namespace App\Http\Resources\V1;

use App\Domain\Policy\ParameterCatalog;
use App\Models\PolicyParameterVersion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin PolicyParameterVersion
 */
class PolicyParameterVersionResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $status = $this->versionStatus();

        return [
            'id' => $this->id,
            'value' => $this->value,
            'display_value' => ParameterCatalog::display($this->parameter->key, $this->value),
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
