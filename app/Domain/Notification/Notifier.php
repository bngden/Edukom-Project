<?php

namespace App\Domain\Notification;

use App\Models\User;
use App\Notifications\EdukomNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Throwable;

class Notifier
{
    /**
     * Dikirim setelah transaksi pemicu commit. Gagal kirim hanya dicatat di log; proses pemicu tetap sukses.
     *
     * @param  User|iterable<User>  $users
     */
    public static function send(User|iterable $users, EdukomNotification $notification): void
    {
        DB::afterCommit(function () use ($users, $notification) {
            try {
                Notification::send($users, $notification);
            } catch (Throwable $e) {
                Log::warning('notification_failed', ['event' => $notification->event, 'exception' => $e]);
            }
        });
    }
}
