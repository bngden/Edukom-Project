<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

/**
 * Notifikasi di dalam sistem (web saja). Kirim lewat App\Domain\Notification\Notifier.
 * Jangan memuat data kesehatan atau data pribadi yang tidak perlu.
 */
class EdukomNotification extends Notification
{
    public function __construct(
        public readonly string $event,
        public readonly string $title,
        public readonly string $message,
        public readonly ?string $subjectType = null,
        public readonly int|string|null $subjectId = null,
        public readonly ?string $actionUrl = null,
    ) {}

    /**
     * @return list<string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function databaseType(object $notifiable): string
    {
        return $this->event;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'event' => $this->event,
            'title' => $this->title,
            'message' => $this->message,
            'subject_type' => $this->subjectType,
            'subject_id' => $this->subjectId,
            'action_url' => $this->actionUrl,
        ];
    }
}
