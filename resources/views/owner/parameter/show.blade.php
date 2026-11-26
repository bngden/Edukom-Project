@php
    use App\Domain\Policy\ParameterCatalog;
    use App\Models\PolicyParameterVersion;
    use App\Support\Format;

    $today = today();
    [$current, $scheduled] = PolicyParameterVersion::currentAndScheduled($parameter->versions, $today);
    $display = fn ($v) => ParameterCatalog::display($parameter->key, $v->value);
@endphp
<x-layouts.owner title="Parameter Kebijakan">
    @if ($parameter->group === \App\Enums\ParameterGroup::Retention)
        <a href="{{ route('owner.masa-simpan') }}" class="inline-flex items-center gap-1 text-muted hover:text-ink">
            <x-icon name="chevron_left" class="size-5" />Masa Simpan Data
        </a>
    @else
        <a href="{{ route('owner.parameter') }}#{{ $parameter->key }}" class="inline-flex items-center gap-1 text-muted hover:text-ink">
            <x-icon name="chevron_left" class="size-5" />Semua parameter
        </a>
    @endif

    <div class="mt-4 flex flex-wrap items-start justify-between gap-4">
        <div class="max-w-2xl">
            <h2 class="text-[20px] leading-7 font-semibold">{{ $parameter->label }}</h2>
            <p class="text-muted">{{ $parameter->group->label() }}</p>
            @if ($parameter->description)
                <p class="mt-2">{{ $parameter->description }}</p>
            @endif
        </div>
        <div class="text-right">
            @if ($current)
                <p class="text-[22px] leading-8 font-semibold">{{ $display($current) }}</p>
                <p class="text-caption text-muted">berlaku sejak {{ Format::date($current->effective_from, short: true) }}</p>
            @else
                <x-chip tone="warning">Belum dikonfigurasi</x-chip>
            @endif
        </div>
    </div>

    @if ($errors->cancel->any())
        <x-alert class="mt-6">{{ $errors->cancel->first() }}</x-alert>
    @endif

    @if ($scheduled)
        @include('owner._scheduled-change', ['cancelUrl' => route('owner.parameter.versions.cancel', [$parameter, $scheduled]), 'bag' => 'cancel'])
    @endif

    <div class="mt-8 grid gap-10 lg:grid-cols-[minmax(0,440px)_minmax(0,1fr)]">
        <section aria-labelledby="nilai-baru">
            <h3 id="nilai-baru" class="text-[16px] leading-6 font-semibold">{{ $current || $scheduled ? 'Tetapkan nilai baru' : 'Tetapkan nilai' }}</h3>

            <form method="POST" action="{{ route('owner.parameter.versions.store', $parameter) }}" class="mt-4 flex flex-col gap-5 rounded-card border border-line p-5" novalidate>
                @csrf
                @error('general')
                    <x-alert>{{ $message }}</x-alert>
                @enderror

                @include('owner.parameter._value-input', [
                    'type' => $parameter->value_type,
                    'value' => ($scheduled ?? $current)?->value,
                    'unit' => $parameter->unit,
                ])

                <label class="flex flex-col gap-1.5">
                    <span class="font-medium">Berlaku mulai</span>
                    <input type="date" name="effective_from" required
                           value="{{ old('effective_from', $today->copy()->addDay()->toDateString()) }}"
                           class="field" @error('effective_from') aria-invalid="true" @enderror>
                    @error('effective_from')
                        <span class="text-caption text-danger">{{ $message }}</span>
                    @enderror
                </label>

                <label class="flex flex-col gap-1.5">
                    <span class="font-medium">Alasan <span class="font-normal text-muted">(opsional)</span></span>
                    <textarea name="reason" rows="2" maxlength="1000" class="field" @error('reason') aria-invalid="true" @enderror>{{ old('reason') }}</textarea>
                </label>

                <button type="submit" class="btn btn-primary self-start" data-pending-label="Menyimpan…">Simpan nilai baru</button>
            </form>
        </section>

        <section aria-labelledby="riwayat-versi">
            <div class="flex items-baseline justify-between gap-4">
                <h3 id="riwayat-versi" class="text-[16px] leading-6 font-semibold">Riwayat nilai</h3>
                <a href="{{ route('owner.riwayat', ['subject_type' => 'policy_parameter', 'subject_id' => $parameter->id]) }}" class="link text-caption">Lihat di Riwayat Perubahan</a>
            </div>

            @include('owner._version-history', ['versions' => $parameter->versions, 'empty' => 'Belum ada nilai yang pernah ditetapkan.'])
        </section>
    </div>
</x-layouts.owner>
