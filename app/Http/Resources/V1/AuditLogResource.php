<?php

namespace App\Http\Resources\V1;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin AuditLog
 */
class AuditLogResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'occurred_at' => $this->occurred_at->toIso8601String(),
            'actor' => [
                'type' => $this->actor_type,
                'id' => $this->actor_id,
                'name' => $this->actor_type === 'system' ? 'Sistem' : $this->actor?->name,
                'role' => $this->actor_role,
            ],
            'action' => $this->action,
            'subject' => [
                'type' => $this->subject_type,
                'id' => $this->subject_id,
                'label' => $this->subject_label,
            ],
            'before' => $this->before,
            'after' => $this->after,
            'reason' => $this->reason,
            'ip' => $this->ip,
            'request_id' => $this->request_id,
        ];
    }
}
