@props(['name', 'label', 'type' => 'text', 'icon' => null, 'errorBag' => 'default'])
@php
    $error = $errors->getBag($errorBag)->first($name);
    $id = $attributes->get('id', $name);
    $isPassword = $type === 'password';
@endphp
<div class="flex flex-col gap-1.5">
    <label for="{{ $id }}" class="text-caption font-medium text-ink">{{ $label }}</label>
    <div class="relative">
        @if ($icon)
            <x-icon :name="$icon" class="pointer-events-none absolute top-1/2 left-3.5 size-5 -translate-y-1/2 text-muted" />
        @endif
        <input
            id="{{ $id }}"
            name="{{ $name }}"
            type="{{ $type }}"
            @if ($error) aria-invalid="true" aria-describedby="{{ $id }}-error" @endif
            {{ $attributes->except('id')->class([
                'h-11 w-full rounded-control border bg-white text-body text-ink placeholder:text-muted transition-colors focus:outline-none',
                'pl-11' => $icon,
                'pl-3.5' => ! $icon,
                'pr-12' => $isPassword,
                'pr-3.5' => ! $isPassword,
                'border-danger focus:border-danger focus:ring-1 focus:ring-danger' => $error,
                'border-line hover:border-muted/40 focus:border-royal focus:ring-1 focus:ring-royal' => ! $error,
            ]) }}
        >
        @if ($isPassword)
            <button
                type="button"
                data-password-toggle="{{ $id }}"
                aria-label="Tampilkan kata sandi"
                aria-pressed="false"
                class="absolute top-1/2 right-1.5 flex size-9 -translate-y-1/2 items-center justify-center rounded-[10px] text-muted transition-colors hover:bg-quiet hover:text-ink"
            >
                <span data-icon-show><x-icon name="visibility" /></span>
                <span data-icon-hide hidden><x-icon name="visibility_off" /></span>
            </button>
        @endif
    </div>
    @if ($error)
        <p id="{{ $id }}-error" class="text-caption font-medium text-danger">{{ $error }}</p>
    @endif
</div>
