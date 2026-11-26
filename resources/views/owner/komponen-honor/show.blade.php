@php
    use App\Domain\Honorarium\HonorRates;
    use App\Enums\HonorComponentStatus;
    use App\Enums\RateType;
    use App\Models\HonorComponentRate;
    use App\Models\TransportTierSet;
    use App\Support\Format;

    $today = today();
    $tiered = $honor->rate_type === RateType::DistanceTiers;
    $versions = $tiered ? $honor->tierSets : $honor->rates;
    [$current, $scheduled] = ($tiered ? TransportTierSet::class : HonorComponentRate::class)::currentAndScheduled($versions, $today);
    $display = fn ($v) => $tiered ? HonorRates::summarizeTiers($v->tiers) : Format::rupiah($v->amount);
    $date = fn ($d) => Format::date($d, short: true);
    $status = $honor->statusOn($today);
    $inactive = $status === HonorComponentStatus::Inactive;
    $bag = $tiered ? $errors->tiers : $errors->rate;
    $base = $scheduled ?? $current;
    $tierRows = match (true) {
        ! $tiered => [],
        $bag->any() && is_array(old('tiers')) => old('tiers'),
        default => $base?->tiers->map(fn ($t) => ['max_km' => $t->max_km_inclusive, 'amount' => $t->amount])->all() ?? [['max_km' => null, 'amount' => null]],
    };
@endphp
<x-layouts.owner title="Komponen Honor">
    <a href="{{ route('owner.komponen-honor') }}" class="inline-flex items-center gap-1 text-muted hover:text-ink">
        <x-icon name="chevron_left" class="size-5" />Semua komponen
    </a>

    <div class="mt-4 flex flex-wrap items-start justify-between gap-4">
        <div class="max-w-2xl">
            <div class="flex flex-wrap items-center gap-3">
                <h2 class="text-[20px] leading-7 font-semibold">{{ $honor->name }}</h2>
                @if ($inactive)
                    <x-chip>Nonaktif sejak {{ $date($honor->deactivated_from) }}</x-chip>
                @elseif ($honor->deactivated_from)
                    <x-chip tone="warning">Nonaktif mulai {{ $date($honor->deactivated_from) }}</x-chip>
                @endif
            </div>
            <p class="text-muted">{{ $honor->basis->label() }}</p>
            @if ($honor->description)
                <p class="mt-2">{{ $honor->description }}</p>
            @endif
        </div>
        <div class="max-w-md text-right">
            @if ($current)
                <p @class(['font-semibold', 'text-[22px] leading-8' => ! $tiered, 'text-[16px] leading-6' => $tiered])>{{ $display($current) }}</p>
                <p class="text-caption text-muted">berlaku sejak {{ $date($current->effective_from) }}</p>
            @else
                <x-chip tone="warning">Belum ada besaran</x-chip>
            @endif
        </div>
    </div>

    @if ($errors->cancel->any())
        <x-alert class="mt-6">{{ $errors->cancel->first() }}</x-alert>
    @endif

    @if ($scheduled)
        @include('owner._scheduled-change', [
            'cancelUrl' => $tiered ? route('owner.komponen-honor.tier-sets.cancel', [$honor, $scheduled]) : route('owner.komponen-honor.rates.cancel', [$honor, $scheduled]),
            'bag' => 'cancel',
        ])
    @endif

    <div class="mt-8 grid gap-10 lg:grid-cols-[minmax(0,460px)_minmax(0,1fr)]">
        <div class="flex flex-col gap-10">
            @unless ($inactive)
                <section aria-labelledby="ubah-besaran">
                    <h3 id="ubah-besaran" class="text-[16px] leading-6 font-semibold">{{ $tiered ? 'Ubah tingkatan jarak' : 'Ubah besaran' }}</h3>

                    <form method="POST" novalidate
                          action="{{ $tiered ? route('owner.komponen-honor.tier-sets.store', $honor) : route('owner.komponen-honor.rates.store', $honor) }}"
                          class="mt-4 flex flex-col gap-5 rounded-card border border-line p-5" @if ($tiered) data-tier-editor @endif>
                        @csrf
                        <input type="hidden" name="_bag" value="{{ $tiered ? 'tiers' : 'rate' }}">
                        @if ($bag->has('general'))
                            <x-alert>{{ $bag->first('general') }}</x-alert>
                        @endif

                        @if ($tiered)
                            <div class="flex flex-col gap-2.5" data-tier-rows>
                                @foreach ($tierRows as $i => $row)
                                    @php($last = $loop->last)
                                    <div data-tier-row class="flex items-center gap-2">
                                        @if ($last)
                                            <span data-tier-label class="w-[11.5rem] shrink-0 text-muted"></span>
                                            <input type="hidden" data-tier-max name="tiers[{{ $i }}][max_km]" value="">
                                        @else
                                            <span class="w-14 shrink-0 text-muted">sampai</span>
                                            <input data-tier-max name="tiers[{{ $i }}][max_km]" value="{{ Format::km($row['max_km'] ?? null) }}" inputmode="decimal" aria-label="Batas jarak tingkatan {{ $i + 1 }} (km)" class="field w-20">
                                            <span class="w-8 shrink-0 text-muted">km</span>
                                        @endif
                                        <span class="relative min-w-0 flex-1">
                                            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-muted">Rp</span>
                                            <input data-tier-amount type="number" min="0" step="1" inputmode="numeric" name="tiers[{{ $i }}][amount]" value="{{ $row['amount'] ?? '' }}" aria-label="Nominal tingkatan {{ $i + 1 }}" class="field pl-10">
                                        </span>
                                        <button type="button" data-tier-remove aria-label="Hapus tingkatan {{ $i + 1 }}" class="flex size-9 shrink-0 items-center justify-center rounded-full text-muted hover:bg-quiet hover:text-danger" @if ($last) disabled @endif>
                                            <x-icon name="close" class="size-[18px]" />
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <template data-tier-template>
                                <div data-tier-row class="flex items-center gap-2">
                                    <span class="w-14 shrink-0 text-muted">sampai</span>
                                    <input data-tier-max inputmode="decimal" aria-label="Batas jarak (km)" class="field w-20">
                                    <span class="w-8 shrink-0 text-muted">km</span>
                                    <span class="relative min-w-0 flex-1">
                                        <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-muted">Rp</span>
                                        <input data-tier-amount type="number" min="0" step="1" inputmode="numeric" aria-label="Nominal" class="field pl-10">
                                    </span>
                                    <button type="button" data-tier-remove aria-label="Hapus tingkatan" class="flex size-9 shrink-0 items-center justify-center rounded-full text-muted hover:bg-quiet hover:text-danger">
                                        <x-icon name="close" class="size-[18px]" />
                                    </button>
                                </div>
                            </template>
                            <button type="button" data-tier-add class="link self-start">Tambah tingkatan</button>
                            <p data-tier-error class="text-caption text-danger" hidden></p>
                            @if ($bag->has('tiers') || $bag->has('tiers.*'))
                                <p class="text-caption text-danger">{{ $bag->first('tiers') ?: $bag->first('tiers.*') }}</p>
                            @endif
                            <p class="rounded-control bg-canvas px-3.5 py-2.5 text-caption"><span class="text-muted">Ringkasan:</span> <span data-tier-preview></span></p>
                        @else
                            <label class="flex flex-col gap-1.5">
                                <span class="font-medium">Besaran baru</span>
                                <span class="relative">
                                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-muted">Rp</span>
                                    <input type="number" name="amount" min="0" step="1" inputmode="numeric" required
                                           value="{{ $bag->any() ? old('amount') : $base?->amount }}" class="field pl-10" @if ($bag->has('amount')) aria-invalid="true" @endif>
                                </span>
                                @if ($bag->has('amount'))<span class="text-caption text-danger">{{ $bag->first('amount') }}</span>@endif
                            </label>
                        @endif

                        <label class="flex flex-col gap-1.5">
                            <span class="font-medium">Berlaku mulai</span>
                            <input type="date" name="effective_from" required value="{{ $bag->any() ? old('effective_from') : $today->copy()->addDay()->toDateString() }}"
                                   class="field" @if ($bag->has('effective_from')) aria-invalid="true" @endif>
                            @if ($bag->has('effective_from'))<span class="text-caption text-danger">{{ $bag->first('effective_from') }}</span>@endif
                        </label>

                        <label class="flex flex-col gap-1.5">
                            <span class="font-medium">Alasan <span class="font-normal text-muted">(opsional)</span></span>
                            <textarea name="reason" rows="2" maxlength="1000" class="field">{{ $bag->any() ? old('reason') : '' }}</textarea>
                        </label>

                        <button type="submit" class="btn btn-primary self-start" data-tier-submit data-pending-label="Menyimpan…">
                            {{ $tiered ? 'Simpan tingkatan baru' : 'Simpan besaran baru' }}
                        </button>
                    </form>
                </section>
            @endunless

            <section aria-labelledby="info-komponen">
                <h3 id="info-komponen" class="text-[16px] leading-6 font-semibold">Informasi komponen</h3>
                <form method="POST" action="{{ route('owner.komponen-honor.update', $honor) }}" class="mt-4 flex flex-col gap-5 rounded-card border border-line p-5" novalidate>
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="_bag" value="info">
                    <label class="flex flex-col gap-1.5">
                        <span class="font-medium">Nama</span>
                        <input name="name" required maxlength="100" value="{{ $errors->info->any() ? old('name') : $honor->name }}" class="field" @if ($errors->info->has('name')) aria-invalid="true" @endif>
                        @if ($errors->info->has('name'))<span class="text-caption text-danger">{{ $errors->info->first('name') }}</span>@endif
                    </label>
                    <label class="flex flex-col gap-1.5">
                        <span class="font-medium">Keterangan</span>
                        <textarea name="description" rows="2" maxlength="1000" class="field">{{ $errors->info->any() ? old('description') : $honor->description }}</textarea>
                    </label>
                    <button type="submit" class="btn btn-secondary self-start" data-pending-label="Menyimpan…">Simpan informasi</button>
                </form>
            </section>

            <section aria-labelledby="status-komponen">
                <h3 id="status-komponen" class="text-[16px] leading-6 font-semibold">Status</h3>
                <div class="mt-4 rounded-card border border-line p-5">
                    @if ($inactive)
                        <p class="text-muted">Komponen ini tidak dipakai untuk kejadian sejak {{ $date($honor->deactivated_from) }}. Riwayatnya tetap tersimpan.</p>
                    @elseif ($honor->deactivated_from)
                        <p>Komponen tidak dipakai lagi mulai <span class="font-semibold">{{ $date($honor->deactivated_from) }}</span>.</p>
                        <form method="POST" action="{{ route('owner.komponen-honor.cancel-deactivation', $honor) }}" class="mt-4 flex flex-wrap items-start gap-2">
                            @csrf
                            <input type="hidden" name="_bag" value="cancel">
                            <label class="sr-only" for="batal-nonaktif">Alasan pembatalan</label>
                            <input id="batal-nonaktif" name="reason" required maxlength="1000" placeholder="Alasan pembatalan" class="field w-64">
                            <button type="submit" class="btn btn-secondary" data-pending-label="Menyimpan…">Tetap aktifkan</button>
                        </form>
                    @else
                        @php($d = $errors->deactivate)
                        <p class="text-muted">Komponen yang dinonaktifkan tidak dipakai lagi dalam perhitungan sejak tanggalnya. Tidak dapat diaktifkan kembali.</p>
                        <form method="POST" action="{{ route('owner.komponen-honor.deactivate', $honor) }}" class="mt-4 flex flex-col gap-4" novalidate>
                            @csrf
                            <input type="hidden" name="_bag" value="deactivate">
                            @if ($d->has('general'))
                                <x-alert>{{ $d->first('general') }}</x-alert>
                            @endif
                            <div class="grid gap-4 sm:grid-cols-[170px_minmax(0,1fr)]">
                                <label class="flex flex-col gap-1.5">
                                    <span class="font-medium">Nonaktif mulai</span>
                                    <input type="date" name="deactivated_from" required value="{{ $d->any() ? old('deactivated_from') : '' }}" class="field" @if ($d->has('deactivated_from')) aria-invalid="true" @endif>
                                </label>
                                <label class="flex flex-col gap-1.5">
                                    <span class="font-medium">Alasan</span>
                                    <input name="reason" required maxlength="1000" value="{{ $d->any() ? old('reason') : '' }}" class="field" @if ($d->has('reason')) aria-invalid="true" @endif>
                                </label>
                            </div>
                            @if ($d->any() && ! $d->has('general'))
                                <p class="text-caption text-danger">{{ $d->first() }}</p>
                            @endif
                            <button type="submit" class="btn btn-danger self-start" data-pending-label="Menyimpan…">Nonaktifkan komponen</button>
                        </form>
                    @endif
                </div>
            </section>
        </div>

        <section aria-labelledby="riwayat-besaran">
            <div class="flex items-baseline justify-between gap-4">
                <h3 id="riwayat-besaran" class="text-[16px] leading-6 font-semibold">{{ $tiered ? 'Riwayat tingkatan' : 'Riwayat besaran' }}</h3>
                <a href="{{ route('owner.riwayat', ['subject_type' => 'honor_component', 'subject_id' => $honor->id]) }}" class="link text-caption">Lihat di Riwayat Perubahan</a>
            </div>
            @include('owner._version-history', ['versions' => $versions, 'empty' => 'Belum ada besaran yang pernah ditetapkan.'])
        </section>
    </div>
</x-layouts.owner>
