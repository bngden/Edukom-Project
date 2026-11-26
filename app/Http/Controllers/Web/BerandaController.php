<?php

namespace App\Http\Controllers\Web;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BerandaController extends Controller
{
    public function __invoke(Request $request): View|RedirectResponse
    {
        $role = $request->user()->role;

        if ($role === Role::Owner) {
            return redirect()->route('owner.beranda');
        }

        return view('beranda', ['roleLabel' => $role->label()]);
    }
}
