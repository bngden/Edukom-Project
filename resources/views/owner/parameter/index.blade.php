@php
    use App\Domain\Policy\ParameterCatalog;
    use App\Models\PolicyParameterVersion;
    use App\Support\Format;
    use Illuminate\Support\Str;

    $today = today();
@endphp
<x-layouts.owner title="Parameter Kebijakan">
    <nav aria-label="Grup parameter" class="flex flex-wrap gap-2">
        @foreach ($groups as $group => $parameters)
            <a href="#{{ Str::slug($group) }}" class="rounded-full border border-line px-3.5 py-1.5 font-medium transition-colors hover:border-royal hover:text-royal">{{ $group }}</a>
        @endforeach
    </nav>

    <div class="mt-8 flex flex-col gap-10">
        @foreach ($groups as $group => $parameters)
            <section id="{{ Str::slug($group) }}" aria-labelledby="judul-{{ Str::slug($group) }}" class="scroll-mt-6">
                <h2 id="judul-{{ Str::slug($group) }}" class="text-[16px] leading-6 font-semibold">{{ $group }}</h2>
                <ul class="mt-3 divide-y divide-line rounded-card border border-line">
                    @foreach ($parameters as $parameter)
                        @php([$current, $scheduled] = PolicyParameterVersion::currentAndScheduled($parameter->versions, $today))
                        <li id="{{ $parameter->key }}" class="scroll-mt-6">
                            <a href="{{ route('owner.parameter.show', $parameter) }}"
                               class="group grid gap-x-6 gap-y-1 px-5 py-3.5 transition-colors first:rounded-t-card last:rounded-b-card hover:bg-royal-50/60 md:grid-cols-[minmax(0,1.2fr)_minmax(0,1fr)_180px] md:items-center">
                                <span class="min-w-0">
                                    <span class="block font-medium">{{ $parameter->label }}</span>
                                    @if ($parameter->description)
                                        <span class="block text-caption text-muted">{{ $parameter->description }}</span>
                                    @endif
                                </span>
                                <span class="min-w-0">
                                    @if ($current)
                                        {{ ParameterCatalog::display($parameter->key, $current->value) }}
                                    @else
                                        <x-chip tone="warning">Belum dikonfigurasi</x-chip>
                                    @endif
                                </span>
                                <span class="flex items-center justify-between gap-3 md:justify-end">
                                    @if ($scheduled)
                                        <x-chip tone="info">Berubah {{ Format::date($scheduled->effective_from, short: true) }}</x-chip>
                                    @endif
                                    <x-icon name="chevron_right" class="size-5 text-muted transition-colors group-hover:text-royal max-md:hidden" />
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endforeach
    </div>

    @if (Route::has('owner.masa-simpan'))
        <p class="mt-10 border-t border-line pt-6 text-muted">
            Masa simpan data diatur di halaman <a href="{{ route('owner.masa-simpan') }}" class="link">Masa Simpan Data</a>.
        </p>
    @endif
</x-layouts.owner>
