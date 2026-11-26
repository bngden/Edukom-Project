{{-- Ringkasan per jenis data satu kali pembersihan (atau uji). $run: RetentionRun --}}
<dl class="mt-4 divide-y divide-line border-t border-line text-caption">
    @foreach ($run->summary ?? [] as $item)
        <div class="flex items-baseline justify-between gap-3 py-2">
            <dt @class(['text-muted' => $item['status'] !== 'success'])>{{ $item['label'] }}</dt>
            <dd class="text-right">
                @if ($item['status'] === 'success')
                    <span class="font-semibold">{{ $item['count'] }}</span>
                    <span class="text-muted">sebelum {{ \App\Support\Format::date($item['cutoff'], short: true) }}</span>
                @elseif ($item['status'] === 'failed')
                    <span class="text-danger">Gagal</span>
                @else
                    <span class="text-muted">{{ $item['message'] }}</span>
                @endif
            </dd>
        </div>
    @endforeach
</dl>
