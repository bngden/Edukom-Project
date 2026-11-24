<?php

namespace App\Domain\Auth\Actions;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Mengganti kata sandi lalu memutus semua sesi lain milik user (SEC-03).
 * Sesi yang sedang dipakai ($currentSessionId) tetap aktif.
 */
class ChangePassword
{
    public function handle(User $user, string $newPassword, ?string $currentSessionId): void
    {
        DB::transaction(function () use ($user, $newPassword, $currentSessionId): void {
            $user->forceFill([
                'password' => $newPassword,
                'remember_token' => Str::random(60),
            ])->save();

            // Satu DELETE berindeks (sessions.user_id), tanpa memuat baris sesi ke memori.
            DB::table('sessions')
                ->where('user_id', $user->getKey())
                ->when($currentSessionId !== null, fn ($query) => $query->where('id', '!=', $currentSessionId))
                ->delete();

            $user->tokens()->delete();
        });
    }
}
