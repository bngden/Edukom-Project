@props(['name'])
@php
    $svg = trim(file_get_contents(resource_path("svg/icons/{$name}.svg")));
    $svg = preg_replace('/\s(width|height)="\d+"/', '', $svg);
    $svg = str_replace('<svg ', '<svg fill="currentColor" aria-hidden="true" focusable="false" '.$attributes->merge(['class' => 'size-5 shrink-0'])->toHtml().' ', $svg);
@endphp
{!! $svg !!}
