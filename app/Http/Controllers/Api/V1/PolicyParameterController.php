<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\Versioning\VersionTimeline;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CancelVersionRequest;
use App\Http\Requests\Api\V1\PolicyParameterIndexRequest;
use App\Http\Requests\Api\V1\StorePolicyParameterVersionRequest;
use App\Http\Resources\V1\PolicyParameterResource;
use App\Http\Resources\V1\PolicyParameterVersionResource;
use App\Models\PolicyParameter;
use App\Models\PolicyParameterVersion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

/**
 * @group Parameter Kebijakan
 *
 * Owner melihat dan mengubah (versi baru); Admin hanya melihat. Peran lain 403.
 */
class PolicyParameterController extends Controller
{
    /**
     * Daftar parameter
     *
     * Nilai yang berlaku hari ini, versi terjadwal, dan status Belum Dikonfigurasi.
     */
    public function index(PolicyParameterIndexRequest $request): AnonymousResourceCollection
    {
        // Katalog tetap (36 baris), jadi tanpa paginasi; versi dibatasi yang masih berlaku/terjadwal.
        $parameters = PolicyParameter::query()
            ->when($request->validated('group'), fn ($q, $group) => $q->where('group', $group))
            ->with(['versions' => fn ($q) => $q->openOn(today())])
            ->orderBy('sort_order')
            ->get();

        return PolicyParameterResource::collection($parameters);
    }

    /**
     * Detail dan riwayat versi
     *
     * 50 versi terbaru beserta status, pembuat, alasan, dan info pembatalan.
     */
    public function show(PolicyParameter $policyParameter): PolicyParameterResource
    {
        $policyParameter->load(['versions' => fn ($q) => $q->history()]);

        $resource = new PolicyParameterResource($policyParameter);
        $resource->withHistory = true;

        return $resource;
    }

    /**
     * Buat versi nilai baru
     *
     * Hanya Owner. Tanggal di periode tertutup → 423; tanggal ≤ versi terakhir → 409.
     */
    public function storeVersion(StorePolicyParameterVersionRequest $request, PolicyParameter $policyParameter): JsonResponse
    {
        $version = new PolicyParameterVersion([
            'policy_parameter_id' => $policyParameter->id,
            'value' => $request->validated('value'),
            'effective_from' => $request->validated('effective_from'),
        ]);

        VersionTimeline::add($version->setRelation('parameter', $policyParameter), $request->validated('reason'));

        return (new PolicyParameterVersionResource($version))->response()->setStatusCode(201);
    }

    /**
     * Batalkan versi terjadwal
     *
     * Hanya Owner dan hanya versi terakhir yang belum berlaku. Alasan wajib.
     */
    public function cancelVersion(CancelVersionRequest $request, PolicyParameter $policyParameter, PolicyParameterVersion $version): Response
    {
        VersionTimeline::cancel($version, $request->validated('reason'));

        return response()->noContent();
    }
}
