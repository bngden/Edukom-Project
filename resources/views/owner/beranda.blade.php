@php
    $pending = $overview['needs_configuration'];
    $scheduled = [
        'Parameter kebijakan' => [$overview['scheduled_changes']['policy_parameters'], 'owner.parameter'],
        'Tarif komponen honor' => [$overview['scheduled_changes']['honor_rates'], 'owner.komponen-honor'],
        'Tingkatan jarak' => [$overview['scheduled_changes']['transport_tiers'], 'owner.komponen-honor'],
        'Masa simpan data' => [$overview['scheduled_changes']['retention'], 'owner.masa-simpan'],
    ];
    $run = $overview['last_retention_run'];
@endphp
<x-layouts.owner title="Beranda">
    <div class="grid gap-x-10 gap-y-8 lg:grid-cols-[minmax(0,1fr)_300px]">
        <section aria-labelledby="perlu-dikonfigurasi">
            <div class="flex items-baseline justify-between gap-4">
                <h2 id="perlu-dikonfigurasi" class="text-[16px] leading-6 font-semibold">Perlu dikonfigurasi</h2>
                @if ($pending->isNotEmpty())
                    <span class="text-caption text-muted">{{ $pending->count() }} parameter belum punya nilai</span>
                @endif
            </div>

            @if ($pending->isEmpty())
                <p class="mt-3 rounded-card border border-line px-5 py-6 text-muted">Semua parameter kebijakan sudah punya nilai.</p>
            @else
                <ul class="mt-3 divide-y divide-line rounded-card border border-line">
                    @foreach ($pending as $item)
                        <li class="flex items-center justify-between gap-4 px-5 py-3.5">
                            <span class="min-w-0">
                                <span class="block font-medium">{{ $item['label'] }}</span>
                                <span class="block text-caption text-muted">{{ $item['group_label'] }}</span>
                            </span>
                            <a href="{{ route('owner.parameter.show', $item['key']) }}" class="link shrink-0">Tetapkan</a>
                        </li>
                    @endforeach
                </ul>
            @endif

            <p class="mt-8 border-t border-line pt-6 text-muted">
                Antrean persetujuan dan ringkasan pemantauan akan tampil di sini setelah modulnya aktif.
            </p>
        </section>

        <div class="flex flex-col gap-8">
            <section aria-labelledby="terjadwal">
                <h2 id="terjadwal" class="text-[16px] leading-6 font-semibold">Perubahan terjadwal</h2>
                <dl class="mt-3 divide-y divide-line rounded-card border border-line">
                    @foreach ($scheduled as $label => [$count, $route])
                        <div class="flex items-center justify-between gap-4 px-5 py-3">
                            <dt @class(['text-muted' => $count === 0])>
                                @if ($count)
                                    <a href="{{ route($route) }}" class="hover:text-royal">{{ $label }}</a>
                                @else
                                    {{ $label }}
                                @endif
                            </dt>
                            <dd @class(['font-semibold', 'text-muted font-normal' => $count === 0])>{{ $count }}</dd>
                        </div>
                    @endforeach
                </dl>
            </section>

            <section aria-labelledby="kebijakan">
                <h2 id="kebijakan" class="text-[16px] leading-6 font-semibold">Kebijakan</h2>
                <dl class="mt-3 divide-y divide-line rounded-card border border-line">
                    @foreach (['Komponen honor' => $overview['honor_components'], 'Alasan penolakan' => $overview['leave_rejection_reasons']] as $label => $counts)
                        <div class="flex items-center justify-between gap-4 px-5 py-3">
                            <dt>{{ $label }}</dt>
                            <dd class="text-right">
                                <span class="font-semibold">{{ $counts['active'] }}</span> aktif
                                @if ($counts['inactive'])
                                    <span class="block text-caption text-muted">{{ $counts['inactive'] }} nonaktif</span>
                                @endif
                            </dd>
                        </div>
                    @endforeach
                </dl>
            </section>

            <section aria-labelledby="pembersihan">
                <h2 id="pembersihan" class="text-[16px] leading-6 font-semibold">Pembersihan data terakhir</h2>
                <div class="mt-3 rounded-card border border-line px-5 py-4">
                    @if ($run)
                        <div class="flex items-start justify-between gap-3">
                            <p>
                                {{ \App\Support\Format::date($run->started_at, short: true) }}
                                <span class="block text-caption text-muted">pukul {{ $run->started_at->format('H.i') }} WIB</span>
                            </p>
                            <x-chip :tone="$run->tone()">{{ $run->statusLabel() }}</x-chip>
                        </div>
                        <p class="mt-3 text-caption text-muted">{{ collect($run->summary)->sum('count') }} data dibersihkan</p>
                    @else
                        <p class="text-muted">Belum pernah dijalankan.</p>
                    @endif
                </div>
            </section>
        </div>
    </div>
</x-layouts.owner>
