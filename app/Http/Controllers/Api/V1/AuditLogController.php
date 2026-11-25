<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AuditLogIndexRequest;
use App\Http\Resources\V1\AuditLogResource;
use App\Models\AuditLog;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class AuditLogController extends Controller
{
    /**
     * Riwayat perubahan (Owner, Admin). Terbaru dulu, 25 per halaman.
     */
    public function index(AuditLogIndexRequest $request): AnonymousResourceCollection
    {
        $filters = $request->validated();

        $logs = AuditLog::query()
            ->with('actor:id,name')
            ->where(array_filter(Arr::only($filters, ['subject_type', 'subject_id', 'actor_id', 'action'])))
            ->when($filters['date_from'] ?? null, fn ($q, $v) => $q->where('occurred_at', '>=', Carbon::parse($v)))
            ->when($filters['date_to'] ?? null, fn ($q, $v) => $q->where('occurred_at', '<', Carbon::parse($v)->addDay()))
            ->orderByDesc('occurred_at')
            ->orderByDesc('id')
            ->paginate(25);

        return AuditLogResource::collection($logs);
    }
}
