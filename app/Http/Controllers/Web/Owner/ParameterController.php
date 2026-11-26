<?php

namespace App\Http\Controllers\Web\Owner;

use App\Domain\Versioning\VersionTimeline;
use App\Enums\ParameterGroup;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Owner\CancelVersionFormRequest;
use App\Http\Requests\Web\Owner\StoreParameterVersionRequest;
use App\Models\PolicyParameter;
use App\Models\PolicyParameterVersion;
use App\Support\Format;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ParameterController extends Controller
{
    /**
     * Semua parameter kecuali grup Masa Simpan (punya halaman sendiri), dikelompokkan per grup.
     */
    public function index(): View
    {
        $parameters = PolicyParameter::query()
            ->where('group', '!=', ParameterGroup::Retention)
            ->with(['versions' => fn ($q) => $q->openOn(today())])
            ->orderBy('sort_order')
            ->get();

        return view('owner.parameter.index', ['groups' => $parameters->groupBy(fn (PolicyParameter $p) => $p->group->label())]);
    }

    public function show(PolicyParameter $policyParameter): View
    {
        $policyParameter->load(['versions' => fn ($q) => $q->history()]);

        return view('owner.parameter.show', ['parameter' => $policyParameter]);
    }

    public function storeVersion(StoreParameterVersionRequest $request, PolicyParameter $policyParameter): RedirectResponse
    {
        $version = new PolicyParameterVersion([
            'policy_parameter_id' => $policyParameter->id,
            'value' => $request->validated('value'),
            'effective_from' => $request->validated('effective_from'),
        ]);

        VersionTimeline::add($version->setRelation('parameter', $policyParameter), $request->validated('reason'));

        return to_route('owner.parameter.show', $policyParameter)
            ->with('status', 'Nilai baru tersimpan, berlaku mulai '.Format::date($version->effective_from).'.');
    }

    public function cancelVersion(CancelVersionFormRequest $request, PolicyParameter $policyParameter, PolicyParameterVersion $version): RedirectResponse
    {
        VersionTimeline::cancel($version, $request->validated('reason'));

        return to_route('owner.parameter.show', $policyParameter)->with('status', 'Nilai terjadwal dibatalkan.');
    }
}
