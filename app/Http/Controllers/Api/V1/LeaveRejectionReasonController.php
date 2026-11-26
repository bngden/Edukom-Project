<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\Reference\LeaveRejectionReasons;
use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LeaveRejectionReasonIndexRequest;
use App\Http\Requests\Api\V1\ReorderLeaveRejectionReasonsRequest;
use App\Http\Requests\Api\V1\StoreLeaveRejectionReasonRequest;
use App\Http\Requests\Api\V1\UpdateLeaveRejectionReasonRequest;
use App\Http\Resources\V1\LeaveRejectionReasonResource;
use App\Models\LeaveRejectionReason;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

/**
 * @group Alasan Penolakan Izin
 *
 * Owner mengelola daftar; Admin hanya melihat alasan aktif untuk dipilih. Peran lain 403.
 */
class LeaveRejectionReasonController extends Controller
{
    /**
     * Daftar alasan
     *
     * Owner: ?status=active|inactive|all (default all). Admin selalu menerima alasan aktif saja.
     * Urut sort_order, tanpa paginasi (daftar kecil).
     */
    public function index(LeaveRejectionReasonIndexRequest $request): AnonymousResourceCollection
    {
        $status = $request->user()->role === Role::Owner ? $request->validated('status', 'all') : 'active';
        $reasons = LeaveRejectionReasons::listing($status, $request->validated('search'));

        return LeaveRejectionReasonResource::collection($reasons);
    }

    /**
     * Tambah alasan
     *
     * Nama unik tanpa membedakan huruf, 3–150 karakter.
     */
    public function store(StoreLeaveRejectionReasonRequest $request): JsonResponse
    {
        $reason = LeaveRejectionReasons::create($request->validated());

        return (new LeaveRejectionReasonResource($reason))->response()->setStatusCode(201);
    }

    /**
     * Ubah nama, deskripsi, atau urutan
     */
    public function update(UpdateLeaveRejectionReasonRequest $request, LeaveRejectionReason $leaveRejectionReason): LeaveRejectionReasonResource
    {
        return new LeaveRejectionReasonResource(LeaveRejectionReasons::update($leaveRejectionReason, $request->validated()));
    }

    /**
     * Simpan urutan
     *
     * `ids` memuat semua alasan (aktif dan nonaktif) tepat satu kali, dalam urutan baru.
     */
    public function reorder(ReorderLeaveRejectionReasonsRequest $request): Response
    {
        LeaveRejectionReasons::reorder($request->validated('ids'));

        return response()->noContent();
    }

    /**
     * Nonaktifkan alasan
     *
     * Tidak muncul di pilihan baru; data lama tetap menampilkannya. Sudah nonaktif → 409.
     */
    public function deactivate(LeaveRejectionReason $leaveRejectionReason): Response
    {
        LeaveRejectionReasons::deactivate($leaveRejectionReason);

        return response()->noContent();
    }

    /**
     * Aktifkan kembali alasan
     */
    public function activate(LeaveRejectionReason $leaveRejectionReason): Response
    {
        LeaveRejectionReasons::activate($leaveRejectionReason);

        return response()->noContent();
    }

    /**
     * Hapus alasan
     *
     * Hanya alasan yang belum pernah dipakai; sudah dipakai → 409 REFERENCE_IN_USE (nonaktifkan saja).
     */
    public function destroy(LeaveRejectionReason $leaveRejectionReason): Response
    {
        LeaveRejectionReasons::delete($leaveRejectionReason);

        return response()->noContent();
    }
}
