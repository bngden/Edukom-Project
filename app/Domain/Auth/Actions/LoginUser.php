<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Audit\Audit;
use App\Exceptions\ApiException;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * Memverifikasi kredensial dengan penguncian akun (SEC-02):
 * N kali gagal berturut-turut → terkunci M menit (config edukom.auth).
 * Tidak membuat sesi; itu tugas controller (guard web + regenerate).
 */
class LoginUser
{
    private const INVALID_MESSAGE = 'Email atau kata sandi salah.';

    public function handle(string $email, string $password, ?string $ip): User
    {
        $email = mb_strtolower(trim($email));

        // Baris user dikunci (FOR UPDATE) agar hitungan gagal tetap benar saat ada percobaan bersamaan.
        $outcome = DB::transaction(function () use ($email, $password): array {
            $user = User::query()
                ->select(['id', 'name', 'email', 'password', 'role', 'is_active', 'failed_login_attempts', 'locked_until', 'last_login_at', 'remember_token'])
                ->where('email', $email)
                ->lockForUpdate()
                ->first();

            if ($user === null) {
                return ['invalid', null, 'unknown_email'];
            }

            if ($user->isLocked()) {
                return ['locked', $user, 'locked'];
            }

            // Masa kunci sudah lewat: mulai hitungan baru.
            if ($user->locked_until !== null) {
                $user->forceFill(['failed_login_attempts' => 0, 'locked_until' => null]);
            }

            if (! Hash::check($password, $user->password)) {
                $attempts = $user->failed_login_attempts + 1;
                $user->failed_login_attempts = $attempts;

                $locked = $attempts >= (int) config('edukom.auth.max_failed_attempts');

                if ($locked) {
                    $user->locked_until = now()->addMinutes((int) config('edukom.auth.lock_minutes'));
                }

                $user->save();

                if ($locked) {
                    Audit::record('auth.account_locked', $user, null, [
                        'failed_login_attempts' => $attempts,
                        'locked_until' => $user->locked_until->toIso8601String(),
                    ]);
                }

                return [$locked ? 'locked' : 'invalid', $user, 'wrong_password'];
            }

            if (! $user->is_active) {
                $user->save();

                return ['inactive', $user, 'inactive'];
            }

            $user->forceFill([
                'failed_login_attempts' => 0,
                'locked_until' => null,
                'last_login_at' => now(),
            ])->save();

            return ['ok', $user, null];
        });

        [$status, $user, $reason] = $outcome;

        if ($status !== 'ok') {
            Log::channel('security')->warning('login_failed', [
                'email' => $email,
                'ip' => $ip,
                'time' => now()->toIso8601String(),
                'reason' => $reason,
                'failed_attempts' => $user?->failed_login_attempts,
            ]);
        }

        return match ($status) {
            'ok' => $user,
            'locked' => throw ApiException::locked(
                'Akun terkunci karena terlalu banyak percobaan login gagal. Coba lagi dalam '
                    .$this->remainingMinutes($user).' menit.',
                'ACCOUNT_LOCKED',
            ),
            'inactive' => throw ApiException::forbidden('Akun Anda nonaktif. Hubungi Owner.', 'ACCOUNT_INACTIVE'),
            default => throw ApiException::validation(self::INVALID_MESSAGE, ['email' => [self::INVALID_MESSAGE]]),
        };
    }

    private function remainingMinutes(User $user): int
    {
        return max(1, (int) ceil(now()->diffInSeconds($user->locked_until) / 60));
    }
}
