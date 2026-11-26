@php
    use App\Domain\Honorarium\HonorRates;
    use App\Enums\HonorComponentStatus;
    use App\Enums\RateType;
    use App\Models\HonorComponentRate;
    use App\Models\TransportTierSet;
    use App\Support\Format;

    $today = today();
    $create = $errors->create;
@endphp
<x-layouts.owner title="Komponen Honor">
    <div class="flex justify-end">
        <button type="button" class="btn btn-primary" data-dialog-open="tambah-komponen">Tambah komponen</button>
    </div>

    <ul class="mt-6 divide-y divide-line rounded-card border border-line">
        @foreach ($components as $honor)
            @php
                $tiered = $honor->rate_type === RateType::DistanceTiers;
                [$now, $next] = $tiered
                    ? TransportTierSet::currentAndScheduled($honor->tierSets, $today)
                    : HonorComponentRate::currentAndScheduled($honor->rates, $today);
                $status = $honor->statusOn($today);
                $inactive = $status === HonorComponentStatus::Inactive;
            @endphp
            <li>
                <a href="{{ route('owner.komponen-honor.show', $honor) }}"
                   class="group grid gap-x-6 gap-y-1.5 px-5 py-4 transition-colors first:rounded-t-card last:rounded-b-card hover:bg-royal-50/60 md:grid-cols-[minmax(0,1fr)_minmax(0,1.1fr)_200px] md:items-center">
                    <span class="min-w-0">
                        <span @class(['block font-medium', 'text-muted' => $inactive])>{{ $honor->name }}</span>
                        <span class="block text-caption text-muted">{{ $honor->basis->label() }}</span>
                    </span>
                    <span @class(['min-w-0', 'text-muted' => $inactive])>
                        @if ($tiered)
                            {{ $now ? HonorRates::summarizeTiers($now->tiers) : 'Belum ada tingkatan' }}
                        @else
                            {{ Format::rupiah($now?->amount) }}
                        @endif
                    </span>
                    <span class="flex flex-wrap items-center gap-2 md:justify-end">
                        @if ($inactive)
                            <x-chip>Nonaktif</x-chip>
                        @elseif ($status === HonorComponentStatus::ScheduledInactive)
                            <x-chip tone="warning">Nonaktif {{ Format::date($honor->deactivated_from, short: true) }}</x-chip>
                        @endif
                        @if ($next)
                            <x-chip tone="info">Berubah {{ Format::date($next->effective_from, short: true) }}</x-chip>
                        @endif
                        <x-icon name="chevron_right" class="size-5 text-muted transition-colors group-hover:text-royal max-md:hidden" />
                    </span>
                </a>
            </li>
        @endforeach
    </ul>

    <dialog id="tambah-komponen" aria-labelledby="judul-tambah" @if ($create->any()) data-open-on-load @endif
            class="m-auto w-[min(480px,calc(100vw-2rem))] rounded-[20px] p-0 backdrop:bg-ink/40">
        <form method="POST" action="{{ route('owner.komponen-honor.store') }}" class="flex flex-col gap-5 p-6" novalidate>
            @csrf
            <input type="hidden" name="_bag" value="create">
            <div class="flex items-start justify-between gap-4">
                <h2 id="judul-tambah" class="text-[18px] leading-[26px] font-semibold">Tambah komponen</h2>
                <button type="button" data-dialog-close aria-label="Tutup" class="-m-1 rounded-full p-1 text-muted hover:bg-quiet"><x-icon name="close" /></button>
            </div>

            @if ($create->has('general'))
                <x-alert>{{ $create->first('general') }}</x-alert>
            @endif

            <label class="flex flex-col gap-1.5">
                <span class="font-medium">Nama</span>
                <input name="name" value="{{ $create->any() ? old('name') : '' }}" required maxlength="100" class="field" @if ($create->has('name')) aria-invalid="true" @endif>
                @if ($create->has('name'))<span class="text-caption text-danger">{{ $create->first('name') }}</span>@endif
            </label>

            <label class="flex flex-col gap-1.5">
                <span class="font-medium">Dasar perhitungan</span>
                <select name="basis" required class="field" @if ($create->has('basis')) aria-invalid="true" @endif>
                    <option value="" disabled @selected(! old('basis'))>Pilih dasar perhitungan</option>
                    @foreach ($bases as $basis)
                        <option value="{{ $basis->value }}" @selected(old('basis') === $basis->value)>{{ $basis->label() }}</option>
                    @endforeach
                </select>
                @if ($create->has('basis'))<span class="text-caption text-danger">{{ $create->first('basis') }}</span>@endif
            </label>

            <div class="grid gap-5 sm:grid-cols-2">
                <label class="flex flex-col gap-1.5">
                    <span class="font-medium">Besaran</span>
                    <span class="relative">
                        <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-muted">Rp</span>
                        <input type="number" name="amount" min="0" step="1" inputmode="numeric" required value="{{ $create->any() ? old('amount') : '' }}" class="field pl-10" @if ($create->has('amount')) aria-invalid="true" @endif>
                    </span>
                    @if ($create->has('amount'))<span class="text-caption text-danger">{{ $create->first('amount') }}</span>@endif
                </label>
                <label class="flex flex-col gap-1.5">
                    <span class="font-medium">Berlaku mulai</span>
                    <input type="date" name="effective_from" required value="{{ $create->any() ? old('effective_from') : $today->copy()->addDay()->toDateString() }}" class="field" @if ($create->has('effective_from')) aria-invalid="true" @endif>
                    @if ($create->has('effective_from'))<span class="text-caption text-danger">{{ $create->first('effective_from') }}</span>@endif
                </label>
            </div>

            <label class="flex flex-col gap-1.5">
                <span class="font-medium">Keterangan <span class="font-normal text-muted">(opsional)</span></span>
                <textarea name="description" rows="2" maxlength="1000" class="field">{{ $create->any() ? old('description') : '' }}</textarea>
            </label>

            <div class="flex justify-end gap-3">
                <button type="button" class="btn btn-secondary" data-dialog-close>Batal</button>
                <button type="submit" class="btn btn-primary" data-pending-label="Menyimpan…">Tambah komponen</button>
            </div>
        </form>
    </dialog>
</x-layouts.owner>
