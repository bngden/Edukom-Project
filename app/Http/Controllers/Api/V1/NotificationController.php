<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\NotificationIndexRequest;
use App\Http\Resources\V1\NotificationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

/**
 * @group Notifikasi
 *
 * Notifikasi milik user yang sedang login. Notifikasi user lain → 404.
 */
class NotificationController extends Controller
{
    /**
     * Daftar notifikasi
     *
     * Terbaru dulu, 20 per halaman.
     */
    public function index(NotificationIndexRequest $request): AnonymousResourceCollection
    {
        $notifications = $request->user()->notifications()
            ->when($request->validated('status') === 'unread', fn ($q) => $q->unread())
            ->when($request->validated('status') === 'read', fn ($q) => $q->read())
            ->paginate(20);

        return NotificationResource::collection($notifications);
    }

    /**
     * Jumlah belum dibaca
     */
    public function unreadCount(Request $request): JsonResponse
    {
        return response()->json(['data' => ['count' => $request->user()->unreadNotifications()->count()]]);
    }

    /**
     * Tandai dibaca
     */
    public function markRead(Request $request, string $id): Response
    {
        $request->user()->notifications()->findOrFail($id)->markAsRead();

        return response()->noContent();
    }

    /**
     * Tandai semua dibaca
     */
    public function markAllRead(Request $request): Response
    {
        $request->user()->unreadNotifications()->update(['read_at' => now()]);

        return response()->noContent();
    }
}
