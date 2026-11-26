<?php

namespace App\Http\Controllers\Web\Owner;

use App\Domain\Honorarium\HonorComponents;
use App\Domain\Honorarium\TransportTierSets;
use App\Domain\Versioning\VersionTimeline;
use App\Enums\HonorBasis;
use App\Enums\RateType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Owner\CancelVersionFormRequest;
use App\Http\Requests\Web\Owner\DeactivateComponentRequest;
use App\Http\Requests\Web\Owner\StoreComponentRequest;
use App\Http\Requests\Web\Owner\StoreRateRequest;
use App\Http\Requests\Web\Owner\StoreTierSetRequest;
use App\Http\Requests\Web\Owner\UpdateComponentRequest;
use App\Models\HonorComponent;
use App\Models\HonorComponentRate;
use App\Models\TransportTierSet;
use App\Support\Format;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KomponenHonorController extends Controller
{
    public function index(): View
    {
        // Jumlah komponen kecil (4 bawaan + tambahan Owner), jadi tanpa paginasi.
        $components = HonorComponent::query()
            ->with(['rates' => fn ($q) => $q->openOn(today()), 'tierSets' => fn ($q) => $q->openOn(today())->with('tiers')])
            ->orderBy('sort_order')
            ->get();

        return view('owner.komponen-honor.index', ['components' => $components, 'bases' => HonorBasis::cases()]);
    }

    public function show(HonorComponent $honorComponent): View
    {
        // Hanya riwayat yang sesuai jenis tarif komponen.
        $honorComponent->load($honorComponent->rate_type === RateType::DistanceTiers
            ? ['tierSets' => fn ($q) => $q->history()->with('tiers')]
            : ['rates' => fn ($q) => $q->history()]);

        return view('owner.komponen-honor.show', ['honor' => $honorComponent]);
    }

    public function store(StoreComponentRequest $request): RedirectResponse
    {
        $component = HonorComponents::create($request->validated());

        return to_route('owner.komponen-honor.show', $component)->with('status', "Komponen {$component->name} ditambahkan.");
    }

    public function update(UpdateComponentRequest $request, HonorComponent $honorComponent): RedirectResponse
    {
        HonorComponents::updateInfo($honorComponent, $request->validated());

        return back()->with('status', 'Informasi komponen disimpan.');
    }

    public function storeRate(StoreRateRequest $request, HonorComponent $honorComponent): RedirectResponse
    {
        $rate = HonorComponents::addRate($honorComponent, $request->validated('amount'), $request->validated('effective_from'), $request->validated('reason'));

        return back()->with('status', 'Besaran baru tersimpan, berlaku mulai '.Format::date($rate->effective_from).'.');
    }

    public function cancelRate(CancelVersionFormRequest $request, HonorComponent $honorComponent, HonorComponentRate $rate): RedirectResponse
    {
        VersionTimeline::cancel($rate, $request->validated('reason'));

        return back()->with('status', 'Besaran terjadwal dibatalkan.');
    }

    public function storeTierSet(StoreTierSetRequest $request, HonorComponent $honorComponent): RedirectResponse
    {
        $set = TransportTierSets::add($honorComponent, $request->validated('tiers'), $request->validated('effective_from'), $request->validated('reason'));

        return back()->with('status', 'Tingkatan jarak baru tersimpan, berlaku mulai '.Format::date($set->effective_from).'.');
    }

    public function cancelTierSet(CancelVersionFormRequest $request, HonorComponent $honorComponent, TransportTierSet $tierSet): RedirectResponse
    {
        VersionTimeline::cancel($tierSet, $request->validated('reason'));

        return back()->with('status', 'Tingkatan jarak terjadwal dibatalkan.');
    }

    public function deactivate(DeactivateComponentRequest $request, HonorComponent $honorComponent): RedirectResponse
    {
        HonorComponents::deactivate($honorComponent, $request->validated('deactivated_from'), $request->validated('reason'));

        return back()->with('status', 'Komponen dijadwalkan nonaktif mulai '.Format::date($request->validated('deactivated_from')).'.');
    }

    public function cancelDeactivation(CancelVersionFormRequest $request, HonorComponent $honorComponent): RedirectResponse
    {
        HonorComponents::cancelDeactivation($honorComponent, $request->validated('reason'));

        return back()->with('status', 'Penonaktifan dibatalkan. Komponen tetap aktif.');
    }
}
