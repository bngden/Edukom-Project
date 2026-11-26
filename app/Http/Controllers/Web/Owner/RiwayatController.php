<?php

namespace App\Http\Controllers\Web\Owner;

use App\Domain\Audit\AuditLogQuery;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AuditLogIndexRequest;
use Illuminate\View\View;

class RiwayatController extends Controller
{
    public function __invoke(AuditLogIndexRequest $request): View
    {
        $filters = $request->validated();

        return view('owner.riwayat', [
            'filters' => $filters,
            'logs' => AuditLogQuery::paginate($filters)->withQueryString(),
        ]);
    }
}
