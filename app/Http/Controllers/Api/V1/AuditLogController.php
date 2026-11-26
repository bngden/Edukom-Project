<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\Audit\AuditLogQuery;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AuditLogIndexRequest;
use App\Http\Resources\V1\AuditLogResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Riwayat Perubahan
 */
class AuditLogController extends Controller
{
    /**
     * Daftar riwayat perubahan
     *
     * Hanya Owner dan Admin. Terbaru dulu, 25 per halaman.
     */
    public function index(AuditLogIndexRequest $request): AnonymousResourceCollection
    {
        return AuditLogResource::collection(AuditLogQuery::paginate($request->validated()));
    }
}
