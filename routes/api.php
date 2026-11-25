<?php

use App\Http\Controllers\Api\V1\AuditLogController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\HealthController;
use App\Http\Controllers\Api\V1\NotificationController;
use Illuminate\Support\Facades\Route;

// Prefix /api/v1 diatur di bootstrap/app.php (apiPrefix).

Route::get('/health', HealthController::class)->name('api.v1.health');

Route::prefix('auth')->name('api.v1.auth.')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:login')
        ->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/me', [AuthController::class, 'me'])->name('me');
        Route::put('/password', [AuthController::class, 'changePassword'])->name('password');
    });
});

Route::middleware('auth:sanctum')->prefix('notifications')->name('api.v1.notifications.')->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->name('index');
    Route::get('/unread-count', [NotificationController::class, 'unreadCount'])->name('unread-count');
    Route::post('/read-all', [NotificationController::class, 'markAllRead'])->name('read-all');
    Route::post('/{id}/read', [NotificationController::class, 'markRead'])->name('read');
});

Route::middleware(['auth:sanctum', 'role:owner,admin'])->name('api.v1.')->group(function () {
    Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');
});
