@props(['tone' => 'neutral'])
@php
    $tones = [
        'neutral' => 'bg-quiet text-muted before:bg-muted',
        'info' => 'bg-royal-50 text-royal before:bg-royal',
        'warning' => 'bg-warning-bg text-warning before:bg-warning',
        'success' => 'bg-success-bg text-success before:bg-success',
        'danger' => 'bg-danger-bg text-danger before:bg-danger',
    ];
@endphp
<span {{ $attributes->class(['inline-flex h-6 shrink-0 items-center gap-1.5 rounded-full px-2.5 text-caption font-medium whitespace-nowrap before:size-1.5 before:rounded-full', $tones[$tone]]) }}>{{ $slot }}</span>
