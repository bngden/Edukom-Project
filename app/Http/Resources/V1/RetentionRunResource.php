<?php

namespace App\Http\Resources\V1;

use App\Models\RetentionRun;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin RetentionRun
 */
class RetentionRunResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'dry_run' => $this->dry_run,
            'status' => $this->status,
            'status_label' => $this->statusLabel(),
            'started_at' => $this->started_at->toIso8601String(),
            'finished_at' => $this->finished_at?->toIso8601String(),
            'triggered_by_name' => $this->when($this->relationLoaded('trigger'), fn () => $this->trigger?->name ?? 'Sistem'),
            'summary' => $this->summary ?? [],
        ];
    }
}
