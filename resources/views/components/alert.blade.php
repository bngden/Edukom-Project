@props(['type' => 'danger'])
@php
    $styles = [
        'danger' => ['bg-danger-bg text-danger', 'error'],
        'success' => ['bg-success-bg text-success', 'check_circle'],
    ][$type];
@endphp
<div role="{{ $type === 'danger' ? 'alert' : 'status' }}" {{ $attributes->class(['flex items-start gap-2.5 rounded-control px-3.5 py-3 text-body font-medium', $styles[0]]) }}>
    <x-icon :name="$styles[1]" class="mt-px size-5" />
    <p>{{ $slot }}</p>
</div>
