<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\Honorarium\HonorComponents;
use App\Domain\Honorarium\TransportTierSets;
use App\Domain\Versioning\VersionTimeline;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CancelVersionRequest;
use App\Http\Requests\Api\V1\DeactivateHonorComponentRequest;
use App\Http\Requests\Api\V1\HonorComponentIndexRequest;
use App\Http\Requests\Api\V1\StoreHonorComponentRequest;
use App\Http\Requests\Api\V1\StoreHonorRateRequest;
use App\Http\Requests\Api\V1\StoreTransportTierSetRequest;
use App\Http\Requests\Api\V1\UpdateHonorComponentRequest;
use App\Http\Resources\V1\HonorComponentRateResource;
use App\Http\Resources\V1\HonorComponentResource;
use App\Http\Resources\V1\TransportTierSetResource;
use App\Models\HonorComponent;
use App\Models\HonorComponentRate;
use App\Models\TransportTierSet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

/**
 * @group Komponen Honorarium
 *
 * Owner mengelola komponen dan tarif; Admin hanya melihat. Peran lain 403. Komponen tidak pernah dihapus.
 */
class HonorComponentController extends Controller
{
    /**
     * Daftar komponen
     *
     * Status dan tarif pada ?date=YYYY-MM-DD (default hari ini).
     */
    public function index(HonorComponentIndexRequest $request): AnonymousResourceCollection
    {
        $date = $request->date('date') ?? today();

        // Jumlah komponen kecil (4 bawaan + tambahan Owner), jadi tanpa paginasi.
        $components = HonorComponent::query()
            ->with([
                'rates' => fn ($q) => $q->openOn($date),
                'tierSets' => fn ($q) => $q->openOn($date)->with('tiers'),
            ])
            ->orderBy('sort_order')
            ->get();

        return HonorComponentResource::collection($components);
    }

    /**
     * Riwayat set tingkatan jarak
     *
     * 50 versi terbaru beserta tingkatannya.
     */
    public function tierSets(HonorComponent $honorComponent): AnonymousResourceCollection
    {
        $sets = $honorComponent->tierSets()->history()->with('tiers')->get();

        return TransportTierSetResource::collection($sets);
    }

    /**
     * Ubah tingkatan jarak (versi set baru)
     *
     * Hanya komponen tingkatan jarak (Uang Transportasi); lainnya → 422. Periode tertutup → 423; tanggal ≤ versi terakhir → 409.
     */
    public function storeTierSet(StoreTransportTierSetRequest $request, HonorComponent $honorComponent): JsonResponse
    {
        $set = TransportTierSets::add($honorComponent, $request->validated('tiers'), $request->validated('effective_from'), $request->validated('reason'));

        return (new TransportTierSetResource($set))->response()->setStatusCode(201);
    }

    /**
     * Batalkan set tingkatan terjadwal
     */
    public function cancelTierSet(CancelVersionRequest $request, HonorComponent $honorComponent, TransportTierSet $tierSet): Response
    {
        VersionTimeline::cancel($tierSet, $request->validated('reason'));

        return response()->noContent();
    }

    /**
     * Detail dan riwayat tarif
     *
     * 50 versi tarif terbaru.
     */
    public function show(HonorComponent $honorComponent): HonorComponentResource
    {
        return $this->detail($honorComponent);
    }

    /**
     * Tambah komponen
     *
     * Komponen tambahan selalu bertarif nominal tetap.
     */
    public function store(StoreHonorComponentRequest $request): JsonResponse
    {
        $component = HonorComponents::create($request->validated());

        return $this->detail($component)->response()->setStatusCode(201);
    }

    /**
     * Ubah nama, deskripsi, atau urutan
     *
     * Dasar perhitungan dan jenis tarif tidak dapat diubah (422).
     */
    public function update(UpdateHonorComponentRequest $request, HonorComponent $honorComponent): HonorComponentResource
    {
        return $this->detail(HonorComponents::updateInfo($honorComponent, $request->validated()));
    }

    /**
     * Ubah besaran (versi tarif baru)
     *
     * Hanya tarif nominal tetap; Uang Transportasi → 422. Periode tertutup → 423; tanggal ≤ versi terakhir → 409.
     */
    public function storeRate(StoreHonorRateRequest $request, HonorComponent $honorComponent): JsonResponse
    {
        $rate = HonorComponents::addRate($honorComponent, $request->validated('amount'), $request->validated('effective_from'), $request->validated('reason'));

        return (new HonorComponentRateResource($rate))->response()->setStatusCode(201);
    }

    /**
     * Batalkan tarif terjadwal
     */
    public function cancelRate(CancelVersionRequest $request, HonorComponent $honorComponent, HonorComponentRate $rate): Response
    {
        VersionTimeline::cancel($rate, $request->validated('reason'));

        return response()->noContent();
    }

    /**
     * Nonaktifkan komponen
     *
     * Komponen tidak dipakai untuk kejadian sejak tanggal nonaktif. Tidak dapat diaktifkan kembali.
     */
    public function deactivate(DeactivateHonorComponentRequest $request, HonorComponent $honorComponent): Response
    {
        HonorComponents::deactivate($honorComponent, $request->validated('deactivated_from'), $request->validated('reason'));

        return response()->noContent();
    }

    /**
     * Batalkan penonaktifan terjadwal
     */
    public function cancelDeactivation(CancelVersionRequest $request, HonorComponent $honorComponent): Response
    {
        HonorComponents::cancelDeactivation($honorComponent, $request->validated('reason'));

        return response()->noContent();
    }

    private function detail(HonorComponent $component): HonorComponentResource
    {
        $component->load([
            'rates' => fn ($q) => $q->history(),
            'tierSets' => fn ($q) => $q->openOn(request()->date('date') ?? today())->with('tiers'),
        ]);

        $resource = new HonorComponentResource($component);
        $resource->withHistory = true;

        return $resource;
    }
}
