<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\Retention\RetentionCatalog;
use App\Domain\Retention\RetentionPurger;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RetentionRunResource;
use App\Models\RetentionRun;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Masa Simpan Data
 *
 * Hanya Owner. Nilai masa simpan diubah lewat parameter kebijakan grup "retention"
 * (POST /policy-parameters/{key}/versions); endpoint ini menampilkan ringkasan dan riwayat pembersihan.
 */
class RetentionController extends Controller
{
    /**
     * Ringkasan masa simpan
     *
     * Per jenis data: masa simpan yang berlaku hari ini, perubahan terjadwal, dan key parameter untuk mengubahnya.
     * Disertai pembersihan terakhir (bukan uji).
     */
    public function index(): JsonResponse
    {
        $types = collect(RetentionCatalog::summary(today()))->map(fn (array $row) => [
            'type' => $row['type'],
            'label' => $row['label'],
            'parameter_key' => $row['parameter']?->key,
            'months' => $row['current']?->value,
            'effective_from' => $row['current']?->effective_from->toDateString(),
            'scheduled' => $row['scheduled'] ? [
                'version_id' => $row['scheduled']->id,
                'months' => $row['scheduled']->value,
                'effective_from' => $row['scheduled']->effective_from->toDateString(),
            ] : null,
        ]);
        $lastRun = RetentionRun::lastReal();

        return response()->json(['data' => [
            'types' => $types,
            'last_run' => $lastRun ? new RetentionRunResource($lastRun) : null,
        ]]);
    }

    /**
     * Riwayat pembersihan
     *
     * 25 per halaman, terbaru dulu (termasuk uji tanpa menghapus).
     */
    public function runs(): AnonymousResourceCollection
    {
        return RetentionRunResource::collection(
            RetentionRun::query()->with('trigger:id,name')->latest('started_at')->latest('id')->paginate(25),
        );
    }

    /**
     * Jalankan uji (tanpa menghapus)
     *
     * Menghitung perkiraan jumlah data per jenis yang akan dibersihkan. Tidak menghapus apa pun.
     */
    public function dryRun(): JsonResponse
    {
        $run = RetentionPurger::run(dryRun: true)->load('trigger:id,name');

        return (new RetentionRunResource($run))->response()->setStatusCode(201);
    }
}
