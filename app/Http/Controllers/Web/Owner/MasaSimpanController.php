<?php

namespace App\Http\Controllers\Web\Owner;

use App\Domain\Retention\RetentionCatalog;
use App\Domain\Retention\RetentionPurger;
use App\Http\Controllers\Controller;
use App\Models\RetentionRun;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MasaSimpanController extends Controller
{
    public function index(Request $request): View
    {
        $dryRunId = $request->session()->get('dry_run_id');

        return view('owner.masa-simpan', [
            'types' => RetentionCatalog::summary(today()),
            'lastRun' => RetentionRun::lastReal(),
            'dryRun' => $dryRunId ? RetentionRun::query()->find($dryRunId) : null,
        ]);
    }

    public function dryRun(): RedirectResponse
    {
        $run = RetentionPurger::run(dryRun: true);

        return to_route('owner.masa-simpan')->with('dry_run_id', $run->id);
    }
}
