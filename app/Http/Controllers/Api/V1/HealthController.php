<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * @group Sistem
 */
class HealthController extends Controller
{
    /**
     * Cek status layanan
     *
     * Tidak perlu login. Waktu dalam zona Asia/Jakarta (ISO 8601).
     *
     * @unauthenticated
     */
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'time' => now()->toIso8601String(),
        ]);
    }
}
