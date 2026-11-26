@php
    use App\Support\Format;
@endphp
<x-layouts.owner title="Masa Simpan Data">
    <p class="max-w-3xl text-muted">Data dasar honorarium, laporan, dan data induk yang sudah dipakai tidak ikut dibersihkan.</p>

    <div class="mt-6 grid gap-10 lg:grid-cols-[minmax(0,1fr)_360px]">
        <section aria-labelledby="per-jenis">
            <h2 id="per-jenis" class="text-[16px] leading-6 font-semibold">Masa simpan per jenis data</h2>
            <ul class="mt-3 divide-y divide-line rounded-card border border-line">
                @foreach ($types as ['label' => $label, 'parameter' => $parameter, 'current' => $current, 'scheduled' => $scheduled])
                    <li class="grid items-center gap-x-6 gap-y-1.5 px-5 py-4 sm:grid-cols-[minmax(0,1fr)_minmax(0,1fr)_auto]">
                        <span class="font-medium">{{ $label }}</span>
                        <span>
                            @if ($current)
                                {{ $current->value }} bulan
                                <span class="block text-caption text-muted">sejak {{ Format::date($current->effective_from, short: true) }}</span>
                            @else
                                <x-chip tone="warning">Belum dikonfigurasi</x-chip>
                            @endif
                        </span>
                        <span class="flex items-center gap-3 sm:justify-end">
                            @if ($scheduled)
                                <x-chip tone="info">{{ $scheduled->value }} bulan mulai {{ Format::date($scheduled->effective_from, short: true) }}</x-chip>
                            @endif
                            @if ($parameter)
                                <a href="{{ route('owner.parameter.show', $parameter) }}" class="btn btn-secondary h-9 px-3">Ubah</a>
                            @endif
                        </span>
                    </li>
                @endforeach
            </ul>
        </section>

        <div class="flex flex-col gap-8">
            <section aria-labelledby="pembersihan-terakhir">
                <div class="flex items-baseline justify-between gap-4">
                    <h2 id="pembersihan-terakhir" class="text-[16px] leading-6 font-semibold">Pembersihan terakhir</h2>
                    @if ($lastRun)
                        <a href="{{ route('owner.riwayat', ['subject_type' => 'retention_run']) }}" class="link text-caption">Lihat di Riwayat Perubahan</a>
                    @endif
                </div>
                <div class="mt-3 rounded-card border border-line px-5 py-4">
                    @if ($lastRun)
                        <div class="flex items-start justify-between gap-3">
                            <p>
                                {{ Format::date($lastRun->started_at, short: true) }}
                                <span class="block text-caption text-muted">pukul {{ $lastRun->started_at->format('H.i') }} WIB oleh {{ $lastRun->trigger?->name ?? 'Sistem' }}</span>
                            </p>
                            <x-chip :tone="$lastRun->tone()">{{ $lastRun->statusLabel() }}</x-chip>
                        </div>
                        @include('owner._retention-summary', ['run' => $lastRun])
                    @else
                        <p class="text-muted">Belum pernah dijalankan. Pembersihan berjalan otomatis setiap hari pukul 02.00 WIB.</p>
                    @endif
                </div>
            </section>

            <section aria-labelledby="uji-pembersihan">
                <h2 id="uji-pembersihan" class="text-[16px] leading-6 font-semibold">Uji pembersihan</h2>
                <div class="mt-3 rounded-card border border-line px-5 py-4">
                    @if ($dryRun)
                        <p>Perkiraan bila dijalankan sekarang:</p>
                        @include('owner._retention-summary', ['run' => $dryRun])
                    @else
                        <p class="text-muted">Hitung data yang akan dibersihkan tanpa menghapus apa pun.</p>
                    @endif
                    <form method="POST" action="{{ route('owner.masa-simpan.dry-run') }}" class="mt-4">
                        @csrf
                        <button type="submit" class="btn btn-secondary" data-pending-label="Menghitung…">Jalankan uji</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-layouts.owner>
