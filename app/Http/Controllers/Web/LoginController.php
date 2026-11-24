<?php

namespace App\Http\Controllers\Web;

use App\Domain\Auth\Actions\LoginUser;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request, LoginUser $loginUser): RedirectResponse
    {
        try {
            $user = $loginUser->handle(
                $request->validated('email'),
                $request->validated('password'),
                $request->ip(),
            );
        } catch (ApiException $e) {
            return back()->withErrors(['auth' => $e->getMessage()])->onlyInput('email');
        }

        Auth::guard('web')->login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('beranda'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
