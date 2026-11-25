<?php

namespace App\Domain\Access\Actions;

use App\Models\AccessDenial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class RecordAccessDenial
{
    public function handle(Request $request): void
    {
        $user = $request->user();

        try {
            AccessDenial::query()->create([
                'user_id' => $user instanceof User ? $user->id : null,
                'role' => $user instanceof User ? $user->role->value : null,
                'method' => $request->method(),
                'path' => Str::limit('/'.ltrim($request->path(), '/'), 2048, ''),
                'route_name' => $request->route()?->getName(),
                'ip' => $request->ip(),
                'occurred_at' => now(),
            ]);
        } catch (Throwable $e) {
            // Gagal mencatat tidak boleh mengubah respons 403 menjadi 500.
            Log::error('access_denial_record_failed', ['exception' => $e]);
        }
    }
}
