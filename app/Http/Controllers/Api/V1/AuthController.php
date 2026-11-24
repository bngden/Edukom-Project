<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\Auth\Actions\ChangePassword;
use App\Domain\Auth\Actions\LoginUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ChangePasswordRequest;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Resources\V1\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * @group Autentikasi
 *
 * Sanctum SPA: panggil GET /sanctum/csrf-cookie lebih dulu, lalu kirim header X-XSRF-TOKEN.
 */
class AuthController extends Controller
{
    /**
     * Login
     *
     * 5 kali gagal berturut-turut mengunci akun 15 menit (423 ACCOUNT_LOCKED).
     * Akun nonaktif ditolak (403 ACCOUNT_INACTIVE). Dibatasi 10 percobaan/menit per IP.
     *
     * @unauthenticated
     */
    public function login(LoginRequest $request, LoginUser $loginUser): UserResource
    {
        $user = $loginUser->handle(
            $request->validated('email'),
            $request->validated('password'),
            $request->ip(),
        );

        Auth::guard('web')->login($user);
        $request->session()->regenerate();

        return new UserResource($user);
    }

    /**
     * Logout
     *
     * Mengakhiri sesi yang sedang dipakai.
     */
    public function logout(Request $request): Response
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->noContent();
    }

    /**
     * Pengguna yang sedang login
     */
    public function me(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    /**
     * Ganti kata sandi
     *
     * Minimal 8 karakter. Setelah berhasil, semua sesi lain milik pengguna ini diputus.
     */
    public function changePassword(ChangePasswordRequest $request, ChangePassword $changePassword): Response
    {
        $changePassword->handle(
            $request->user(),
            $request->validated('password'),
            $request->hasSession() ? $request->session()->getId() : null,
        );

        if ($request->hasSession()) {
            // Sesi aktif dipertahankan tetapi dengan ID baru (mencegah session fixation).
            $request->session()->migrate(true);
        }

        return response()->noContent();
    }
}
