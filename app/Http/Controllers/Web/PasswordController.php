<?php

namespace App\Http\Controllers\Web;

use App\Domain\Auth\Actions\ChangePassword;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ChangePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PasswordController extends Controller
{
    public function edit(): View
    {
        return view('akun.kata-sandi');
    }

    public function update(ChangePasswordRequest $request, ChangePassword $changePassword): RedirectResponse
    {
        $changePassword->handle($request->user(), $request->validated('password'), $request->session()->getId());
        $request->session()->migrate(true);

        return redirect()
            ->route('akun.kata-sandi')
            ->with('status', 'Kata sandi tersimpan. Akun ini sudah keluar dari perangkat lain.');
    }
}
