<?php

use App\Http\Controllers\Api\V1\AuditLogController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\HealthController;
use App\Http\Controllers\Api\V1\HonorComponentController;
use App\Http\Controllers\Api\V1\LeaveRejectionReasonController;
use App\Http\Controllers\Api\V1\NotificationController;
use App\Http\Controllers\Api\V1\OwnerOverviewController;
use App\Http\Controllers\Api\V1\PolicyParameterController;
use App\Http\Controllers\Api\V1\RetentionController;
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
    Route::get('/policy-parameters', [PolicyParameterController::class, 'index'])->name('policy-parameters.index');
    Route::get('/policy-parameters/{policyParameter:key}', [PolicyParameterController::class, 'show'])->name('policy-parameters.show');
    Route::get('/honor-components', [HonorComponentController::class, 'index'])->name('honor-components.index');
    Route::get('/honor-components/{honorComponent}', [HonorComponentController::class, 'show'])->name('honor-components.show');
    Route::get('/honor-components/{honorComponent}/tier-sets', [HonorComponentController::class, 'tierSets'])->name('honor-components.tier-sets.index');
    Route::get('/leave-rejection-reasons', [LeaveRejectionReasonController::class, 'index'])->name('leave-rejection-reasons.index');
});

Route::middleware(['auth:sanctum', 'role:owner'])->name('api.v1.')->group(function () {
    Route::get('/owner/overview', OwnerOverviewController::class)->name('owner.overview');
    Route::get('/retention', [RetentionController::class, 'index'])->name('retention.index');
    Route::get('/retention-runs', [RetentionController::class, 'runs'])->name('retention-runs.index');
    Route::post('/retention-runs/dry-run', [RetentionController::class, 'dryRun'])->name('retention-runs.dry-run');
});

Route::middleware(['auth:sanctum', 'role:owner'])->prefix('leave-rejection-reasons')->name('api.v1.leave-rejection-reasons.')->group(function () {
    Route::post('/', [LeaveRejectionReasonController::class, 'store'])->name('store');
    Route::put('/order', [LeaveRejectionReasonController::class, 'reorder'])->name('reorder');
    Route::patch('/{leaveRejectionReason}', [LeaveRejectionReasonController::class, 'update'])->name('update');
    Route::post('/{leaveRejectionReason}/deactivate', [LeaveRejectionReasonController::class, 'deactivate'])->name('deactivate');
    Route::post('/{leaveRejectionReason}/activate', [LeaveRejectionReasonController::class, 'activate'])->name('activate');
    Route::delete('/{leaveRejectionReason}', [LeaveRejectionReasonController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth:sanctum', 'role:owner'])->prefix('honor-components')->name('api.v1.honor-components.')->scopeBindings()->group(function () {
    Route::post('/', [HonorComponentController::class, 'store'])->name('store');
    Route::patch('/{honorComponent}', [HonorComponentController::class, 'update'])->name('update');
    Route::post('/{honorComponent}/rates', [HonorComponentController::class, 'storeRate'])->name('rates.store');
    Route::post('/{honorComponent}/rates/{rate}/cancel', [HonorComponentController::class, 'cancelRate'])->name('rates.cancel');
    Route::post('/{honorComponent}/tier-sets', [HonorComponentController::class, 'storeTierSet'])->name('tier-sets.store');
    Route::post('/{honorComponent}/tier-sets/{tierSet}/cancel', [HonorComponentController::class, 'cancelTierSet'])->name('tier-sets.cancel');
    Route::post('/{honorComponent}/deactivate', [HonorComponentController::class, 'deactivate'])->name('deactivate');
    Route::post('/{honorComponent}/cancel-deactivation', [HonorComponentController::class, 'cancelDeactivation'])->name('cancel-deactivation');
});

Route::middleware(['auth:sanctum', 'role:owner'])->name('api.v1.')->scopeBindings()->group(function () {
    Route::post('/policy-parameters/{policyParameter:key}/versions', [PolicyParameterController::class, 'storeVersion'])
        ->name('policy-parameters.versions.store');
    Route::post('/policy-parameters/{policyParameter:key}/versions/{version}/cancel', [PolicyParameterController::class, 'cancelVersion'])
        ->name('policy-parameters.versions.cancel');
});
