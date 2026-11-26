<?php

namespace App\Http\Resources\V1;

use App\Models\LeaveRejectionReason;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * `usage_count` diisi controller (atribut sementara) agar daftar tidak menghitung per baris.
 *
 * @mixin LeaveRejectionReason
 */
class LeaveRejectionReasonResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $usage = $this->usage_count ?? $this->usageCount();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,
            'status_label' => $this->is_active ? 'Aktif' : 'Nonaktif',
            'deactivated_at' => $this->deactivated_at?->toIso8601String(),
            'usage_count' => $usage,
            'can_delete' => $usage === 0,
        ];
    }
}
