<?php

namespace App\Http\Controllers\Web\Owner;

use App\Domain\Owner\OwnerOverview;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BerandaController extends Controller
{
    public function __invoke(Request $request): View
    {
        return view('owner.beranda', ['overview' => OwnerOverview::for($request->user(), today())]);
    }
}
