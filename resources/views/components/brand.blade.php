<span {{ $attributes->merge(['class' => 'flex items-center gap-3 text-white']) }}>
    {!! str_replace('<svg ', '<svg class="size-9 shrink-0" aria-hidden="true" ', file_get_contents(resource_path('svg/brand/edukom-mark-white.svg'))) !!}
    <span class="text-title-sm font-semibold tracking-tight">Edukom</span>
</span>
