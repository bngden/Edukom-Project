<?php

namespace App\Http\Resources\V1;

use App\Domain\Policy\ParameterCatalog;
use App\Models\PolicyParameter;
use App\Models\PolicyParameterVersion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Butuh relasi `versions` terurut effective_from menurun. Dengan $withHistory, seluruh versi ikut dikirim.
 *
 * @mixin PolicyParameter
 */
class PolicyParameterResource extends JsonResource
{
    public bool $withHistory = false;

    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        [$current, $scheduled] = PolicyParameterVersion::currentAndScheduled($this->versions, today());

        return [
            'key' => $this->key,
            'group' => $this->group->value,
            'group_label' => $this->group->label(),
            'label' => $this->label,
            'description' => $this->description,
            'unit' => $this->unit,
            'value_type' => $this->value_type->value,
            'status' => $current ? 'configured' : 'not_configured',
            'status_label' => $current ? 'Dikonfigurasi' : 'Belum Dikonfigurasi',
            'current_value' => $current?->value,
            'current_effective_from' => $current?->effective_from->toDateString(),
            'display_value' => $current ? ParameterCatalog::display($this->key, $current->value) : null,
            'scheduled_version' => $scheduled ? new PolicyParameterVersionResource($scheduled) : null,
            'versions' => $this->when($this->withHistory, fn () => PolicyParameterVersionResource::collection($this->versions)),
        ];
    }
}
