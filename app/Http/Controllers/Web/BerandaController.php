<?php

namespace App\Http\Controllers\Web;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BerandaController extends Controller
{
    public function __invoke(Request $request): View
    {
        $role = $request->user()->role;

        return view('beranda', [
            'isOwner' => $role === Role::Owner,
            'roleLabel' => $role->label(),
        ]);
    }
}
