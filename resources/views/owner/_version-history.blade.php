{{-- Daftar riwayat versi. $versions (terbaru dulu), $display: fn($versi): string, $empty: teks bila kosong --}}
@php
    use App\Enums\VersionStatus;
    use App\Support\Format;
@endphp
@if ($versions->isEmpty())
    <p class="mt-4 rounded-card border border-line px-5 py-6 text-muted">{{ $empty }}</p>
@else
    <ol class="mt-4 divide-y divide-line rounded-card border border-line">
        @foreach ($versions as $version)
            @php($status = $version->versionStatus())
            <li class="flex flex-wrap items-start justify-between gap-x-4 gap-y-2 px-5 py-4">
                <div class="min-w-0 flex-1">
                    <p @class(['font-medium', 'text-muted line-through' => $status === VersionStatus::Cancelled])>{{ $display($version) }}</p>
                    <p class="text-caption text-muted">
                        {{ Format::date($version->effective_from, short: true) }}{{ $version->effective_to ? ' sampai '.Format::date($version->effective_to, short: true) : '' }}
                        oleh {{ $version->creator?->name ?? 'Sistem' }}
                    </p>
                    @if ($version->reason)
                        <p class="mt-1 text-caption">{{ $version->reason }}</p>
                    @endif
                    @if ($version->cancel_reason)
                        <p class="mt-1 text-caption text-muted">Dibatalkan {{ $version->canceller?->name }}: {{ $version->cancel_reason }}</p>
                    @endif
                </div>
                <x-chip :tone="$status->tone()">{{ $status->label() }}</x-chip>
            </li>
        @endforeach
    </ol>
@endif
