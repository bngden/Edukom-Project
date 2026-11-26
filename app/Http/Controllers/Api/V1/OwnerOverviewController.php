<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\Owner\OwnerOverview;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RetentionRunResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Beranda Owner
 */
class OwnerOverviewController extends Controller
{
    /**
     * Ringkasan Beranda
     *
     * Blok yang datanya sudah tersedia: parameter Belum Dikonfigurasi, jumlah perubahan terjadwal, ringkasan komponen
     * honor dan alasan penolakan, notifikasi belum dibaca, dan pembersihan data terakhir. Blok modul yang belum aktif
     * (keputusan, pembelajaran, aset, laporan) tidak dikirim; tampilan menampilkan "Tersedia setelah modul terkait aktif".
     */
    public function __invoke(Request $request): JsonResponse
    {
        $data = OwnerOverview::for($request->user(), today());
        $data['last_retention_run'] = $data['last_retention_run'] ? new RetentionRunResource($data['last_retention_run']) : null;

        return response()->json(['data' => $data]);
    }
}
