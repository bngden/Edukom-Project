<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Notifications\DatabaseNotification;

/**
 * @mixin DatabaseNotification
 */
class NotificationResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'event' => $this->type,
            'title' => $this->data['title'] ?? null,
            'message' => $this->data['message'] ?? null,
            'subject_type' => $this->data['subject_type'] ?? null,
            'subject_id' => $this->data['subject_id'] ?? null,
            'action_url' => $this->data['action_url'] ?? null,
            'is_read' => $this->read(),
            'read_at' => $this->read_at?->toIso8601String(),
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}
