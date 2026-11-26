@php
    use App\Domain\Audit\AuditLabels;
    use App\Support\Format;

    $filtered = collect($filters)->filter()->isNotEmpty();
    $field = 'h-10 rounded-control border border-line bg-white px-3 text-body focus:border-royal focus:outline-none';
@endphp
<x-layouts.owner title="Riwayat Perubahan">
    <form method="GET" action="{{ route('owner.riwayat') }}" class="flex flex-wrap items-end gap-3">
        @foreach (['subject_id', 'action', 'actor_id'] as $hidden)
            @if (filled($filters[$hidden] ?? null))
                <input type="hidden" name="{{ $hidden }}" value="{{ $filters[$hidden] }}">
            @endif
        @endforeach

        <label class="flex flex-col gap-1.5 text-caption font-medium">
            Jenis data
            <select name="subject_type" class="{{ $field }} min-w-48">
                <option value="">Semua</option>
                @foreach (AuditLabels::SUBJECT_TYPES as $value => $label)
                    <option value="{{ $value }}" @selected(($filters['subject_type'] ?? null) === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>
        <label class="flex flex-col gap-1.5 text-caption font-medium">
            Dari tanggal
            <input type="date" name="date_from" value="{{ $filters['date_from'] ?? '' }}" class="{{ $field }}">
        </label>
        <label class="flex flex-col gap-1.5 text-caption font-medium">
            Sampai tanggal
            <input type="date" name="date_to" value="{{ $filters['date_to'] ?? '' }}" class="{{ $field }}">
        </label>
        <button type="submit" class="h-10 rounded-control border border-line px-4 font-medium transition-colors hover:bg-quiet">Terapkan</button>
        @if ($filtered)
            <a href="{{ route('owner.riwayat') }}" class="flex h-10 items-center px-2 font-medium text-royal hover:text-royal-700">Hapus penyaring</a>
        @endif
    </form>

    @if ($errors->any())
        <x-alert class="mt-4">{{ $errors->first() }}</x-alert>
    @endif

    @if (filled($filters['subject_id'] ?? null) && $logs->isNotEmpty())
        <p class="mt-5 text-muted">Menampilkan riwayat <span class="font-medium text-ink">{{ $logs->first()->subject_label }}</span>.</p>
    @endif

    @if ($logs->isEmpty())
        <div class="mt-6 flex flex-col items-center gap-3 rounded-card border border-line px-6 py-12 text-center">
            <x-icon name="history" class="size-10 text-muted" />
            <p class="text-muted">{{ $filtered ? 'Tidak ada riwayat yang cocok dengan penyaring ini.' : 'Belum ada perubahan yang tercatat.' }}</p>
        </div>
    @else
        <div class="mt-6 rounded-card border border-line">
            <div class="hidden grid-cols-[150px_170px_minmax(0,1fr)_minmax(0,1fr)_100px] gap-4 border-b border-line px-5 py-2.5 text-caption font-medium text-muted md:grid">
                <span>Waktu</span><span>Pelaku</span><span>Aktivitas</span><span>Data</span><span>Perubahan</span>
            </div>
            <ul class="divide-y divide-line">
                @foreach ($logs as $log)
                    @php
                        $keys = array_keys(($log->before ?? []) + ($log->after ?? []));
                    @endphp
                    <li class="relative grid gap-x-4 gap-y-1 px-5 py-4 md:grid-cols-[150px_170px_minmax(0,1fr)_minmax(0,1fr)_100px] md:items-start">
                        <p>
                            {{ Format::date($log->occurred_at, short: true) }}
                            <span class="text-caption text-muted md:block">{{ $log->occurred_at->format('H.i') }}</span>
                        </p>
                        <p>
                            {{ $log->actor_type === 'system' ? 'Sistem' : ($log->actor?->name ?? 'Akun terhapus') }}
                            @if ($log->actor_role)
                                <span class="block text-caption text-muted">{{ \App\Enums\Role::tryFrom($log->actor_role)?->label() }}</span>
                            @endif
                        </p>
                        <p class="font-medium md:font-normal">
                            {{ AuditLabels::action($log->action) }}
                            @if ($log->reason)
                                <span class="block text-caption text-muted">Alasan: {{ $log->reason }}</span>
                            @endif
                        </p>
                        <p class="min-w-0">
                            @if ($log->subject_id && isset(AuditLabels::SUBJECT_TYPES[$log->subject_type]))
                                <a href="{{ route('owner.riwayat', ['subject_type' => $log->subject_type, 'subject_id' => $log->subject_id]) }}"
                                   class="break-words hover:text-royal">{{ $log->subject_label ?? '—' }}</a>
                            @else
                                <span class="break-words">{{ $log->subject_label ?? '—' }}</span>
                            @endif
                            <span class="block text-caption text-muted">{{ AuditLabels::subjectType($log->subject_type) }}</span>
                        </p>
                        <div class="md:col-span-1 max-md:col-span-full">
                            @if ($keys)
                                <details class="group">
                                    <summary class="cursor-pointer list-none font-medium text-royal hover:text-royal-700 [&::-webkit-details-marker]:hidden">
                                        <span class="group-open:hidden">Lihat</span><span class="hidden group-open:inline">Tutup</span>
                                    </summary>
                                    <dl class="mt-3 flex flex-col gap-2 rounded-control bg-canvas p-3 text-caption md:absolute md:right-5 md:left-5 md:z-10 md:mt-2 md:border md:border-line md:bg-white md:shadow-float">
                                        @foreach ($keys as $key)
                                            <div>
                                                <dt class="text-muted">{{ AuditLabels::field($key) }}</dt>
                                                <dd class="break-all">
                                                    @if (array_key_exists($key, $log->before ?? []))
                                                        <span class="text-muted line-through decoration-muted/50">{{ AuditLabels::value($log->before[$key]) }}</span>
                                                    @endif
                                                    @if (array_key_exists($key, $log->after ?? []))
                                                        <span class="font-medium">{{ AuditLabels::value($log->after[$key]) }}</span>
                                                    @endif
                                                </dd>
                                            </div>
                                        @endforeach
                                    </dl>
                                </details>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <nav aria-label="Halaman" class="mt-4 flex items-center justify-end gap-3 text-caption text-muted">
            <span>{{ $logs->firstItem() }}–{{ $logs->lastItem() }} dari {{ $logs->total() }}</span>
            @foreach ([[$logs->previousPageUrl(), 'chevron_left', 'Sebelumnya'], [$logs->nextPageUrl(), 'chevron_right', 'Berikutnya']] as [$url, $icon, $label])
                @if ($url)
                    <a href="{{ $url }}" aria-label="{{ $label }}" class="flex size-9 items-center justify-center rounded-control border border-line text-ink hover:bg-quiet"><x-icon :name="$icon" class="size-5" /></a>
                @else
                    <span aria-hidden="true" class="flex size-9 items-center justify-center rounded-control border border-line opacity-40"><x-icon :name="$icon" class="size-5" /></span>
                @endif
            @endforeach
        </nav>
    @endif
</x-layouts.owner>
