{{-- Input nilai sesuai tipe parameter. $type: ParameterType, $value: nilai awal (old() atau nilai berlaku), $unit: satuan. --}}
@php
    use App\Enums\ParameterType as T;

    $v = old('value', $value);
    $invalid = $errors->has('value') || $errors->has('value.*');
    $num = fn (string $name, mixed $val, string $width = 'w-24') => '<input type="number" inputmode="numeric" min="0" name="'.$name.'" value="'.e($val).'" class="field '.$width.'"'.($invalid ? ' aria-invalid="true"' : '').' required>';
    $time = fn (string $name, mixed $val) => '<input type="time" name="'.$name.'" value="'.e($val).'" class="field w-[7.5rem]"'.($invalid ? ' aria-invalid="true"' : '').' required>';
    $row = 'flex flex-wrap items-center gap-x-2 gap-y-2';
@endphp

<div class="flex flex-col gap-3">
    @switch($type)
        @case(T::Integer)
            <div class="{{ $row }}">{!! $num('value', $v, 'w-32') !!} <span class="text-muted">{{ $unit }}</span></div>
            @break

        @case(T::Time)
            <div class="{{ $row }}">{!! $time('value', $v) !!} <span class="text-muted">WIB</span></div>
            @break

        @case(T::RelativeDeadline)
            <div class="{{ $row }}">H- {!! $num('value[days_before]', $v['days_before'] ?? '') !!} pukul {!! $time('value[time]', $v['time'] ?? '') !!} WIB</div>
            @break

        @case(T::ByLeaveType)
            <div class="{{ $row }}"><span class="w-24">Terencana</span> {!! $num('value[planned]', $v['planned'] ?? '') !!} jam</div>
            <div class="{{ $row }}"><span class="w-24">Mendesak</span> {!! $num('value[urgent]', $v['urgent'] ?? '') !!} jam</div>
            @break

        @case(T::Escalation)
            <div class="{{ $row }}"><span class="w-24">Terencana</span> H- {!! $num('value[planned][days_before]', $v['planned']['days_before'] ?? '') !!} pukul {!! $time('value[planned][time]', $v['planned']['time'] ?? '') !!}</div>
            <div class="{{ $row }}"><span class="w-24">Mendesak</span> {!! $num('value[urgent_hours_before]', $v['urgent_hours_before'] ?? '') !!} jam sebelum mulai</div>
            @break

        @case(T::ServiceHours)
            <fieldset class="flex flex-wrap gap-1.5">
                <legend class="sr-only">Hari layanan</legend>
                @foreach ([1 => 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'] as $day => $label)
                    <label class="cursor-pointer">
                        <input type="checkbox" name="value[days][]" value="{{ $day }}" class="peer sr-only" @checked(in_array($day, array_map('intval', $v['days'] ?? []), true))>
                        <span class="flex h-9 w-11 items-center justify-center rounded-control border border-line font-medium transition-colors peer-checked:border-royal peer-checked:bg-royal-50 peer-checked:text-royal peer-focus-visible:outline-2 peer-focus-visible:outline-royal">{{ $label }}</span>
                    </label>
                @endforeach
            </fieldset>
            <div class="{{ $row }}">{!! $time('value[start]', $v['start'] ?? '') !!} sampai {!! $time('value[end]', $v['end'] ?? '') !!} WIB</div>
            @break

        @case(T::ReuploadLimit)
            <div class="{{ $row }}">Maks {!! $num('value[max_times]', $v['max_times'] ?? '') !!} kali dalam {!! $num('value[within_days]', $v['within_days'] ?? '') !!} hari</div>
            @break

        @case(T::FileRule)
            <fieldset class="flex flex-wrap gap-2">
                <legend class="mb-2 text-caption text-muted">Jenis berkas</legend>
                @foreach (['jpg', 'jpeg', 'png', 'pdf'] as $ext)
                    <label class="cursor-pointer">
                        <input type="checkbox" name="value[extensions][]" value="{{ $ext }}" class="peer sr-only" @checked(in_array($ext, $v['extensions'] ?? [], true))>
                        <span class="flex h-9 min-w-14 items-center justify-center rounded-control border border-line px-3 font-medium uppercase transition-colors peer-checked:border-royal peer-checked:bg-royal-50 peer-checked:text-royal peer-focus-visible:outline-2 peer-focus-visible:outline-royal">{{ $ext }}</span>
                    </label>
                @endforeach
            </fieldset>
            <div class="{{ $row }}">Maks {!! $num('value[max_size_mb]', $v['max_size_mb'] ?? '') !!} MB per berkas</div>
            <div class="{{ $row }}">Maks {!! $num('value[max_files]', $v['max_files'] ?? '') !!} berkas</div>
            @break
    @endswitch

    @if ($invalid)
        <p class="text-caption text-danger">{{ $errors->first('value') ?: $errors->first('value.*') }}</p>
    @endif
</div>
