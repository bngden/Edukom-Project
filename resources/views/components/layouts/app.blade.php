@props(['title'])
@php
    $user = auth()->user();
    $initials = collect(preg_split('/\s+/', trim($user->name)))->filter()->take(2)->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))->implode('');
    $nav = [
        ['route' => 'beranda', 'label' => 'Beranda', 'icon' => 'home'],
        ['route' => 'akun.kata-sandi', 'label' => 'Ganti kata sandi', 'icon' => 'key'],
    ];
@endphp
<x-layouts.base :title="$title">
    <header class="flex h-[72px] items-center justify-between rounded-tr-curve bg-royal px-4 md:hidden">
        <x-brand />
        <button type="button" data-nav-toggle aria-controls="mobile-nav" aria-expanded="false" aria-label="Menu"
                class="flex size-10 items-center justify-center rounded-control text-white hover:bg-nav-active">
            <x-icon name="menu" class="size-6" />
        </button>
    </header>
    <nav id="mobile-nav" hidden class="mx-4 mt-2 rounded-card border border-line bg-white p-2 shadow-float md:hidden">
        @foreach ($nav as $item)
            <a href="{{ route($item['route']) }}" @if (request()->routeIs($item['route'])) aria-current="page" @endif
               class="flex items-center gap-3 rounded-control px-3 py-2.5 font-medium aria-[current=page]:bg-royal-50 aria-[current=page]:text-royal">
                <x-icon :name="$item['icon']" />{{ $item['label'] }}
            </a>
        @endforeach
        <form method="POST" action="{{ route('logout') }}" class="mt-1 border-t border-line pt-1">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 rounded-control px-3 py-2.5 font-medium text-danger hover:bg-danger-bg">
                <x-icon name="logout" />Keluar
            </button>
        </form>
    </nav>

    <aside class="fixed inset-y-0 left-0 z-10 hidden w-20 flex-col justify-between rounded-tr-curve bg-royal text-white md:flex lg:w-[264px]">
        <div>
            <div class="flex h-[72px] items-center justify-center lg:justify-start lg:px-6">
                <x-brand class="[&>span:last-child]:hidden lg:[&>span:last-child]:inline" />
            </div>
            <nav class="mt-2 flex flex-col gap-1 px-3">
                @foreach ($nav as $item)
                    <a href="{{ route($item['route']) }}" title="{{ $item['label'] }}"
                       @if (request()->routeIs($item['route'])) aria-current="page" @endif
                       class="relative flex items-center justify-center gap-3 rounded-[10px] px-3 py-2.5 font-medium text-nav-text transition-colors hover:bg-nav-active hover:text-white lg:justify-start aria-[current=page]:bg-nav-active aria-[current=page]:font-semibold aria-[current=page]:text-white aria-[current=page]:before:absolute aria-[current=page]:before:inset-y-1.5 aria-[current=page]:before:left-0 aria-[current=page]:before:w-[3px] aria-[current=page]:before:rounded-r aria-[current=page]:before:bg-white">
                        <x-icon :name="$item['icon']" />
                        <span class="sr-only lg:not-sr-only">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </div>

        <div class="p-3 lg:p-4">
            <div class="flex flex-col gap-3 rounded-[14px] lg:bg-nav-active lg:p-3">
                <div class="flex items-center justify-center gap-3 lg:justify-start">
                    <span class="flex size-9 shrink-0 items-center justify-center rounded-full bg-white text-body font-semibold text-royal" title="{{ $user->name }}">{{ $initials }}</span>
                    <span class="hidden min-w-0 lg:block">
                        <span class="block truncate text-caption font-semibold">{{ $user->name }}</span>
                        <span class="block text-caption text-nav-text">{{ $user->role->label() }}</span>
                    </span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Keluar"
                            class="flex w-full items-center justify-center gap-2 rounded-[10px] py-2 text-caption font-medium text-nav-text transition-colors hover:bg-nav-active hover:text-white">
                        <x-icon name="logout" class="size-[18px]" />
                        <span class="sr-only lg:not-sr-only">Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <div class="p-4 md:pl-24 lg:pl-[280px]">
        <main class="min-h-[calc(100vh-2rem)] rounded-panel bg-white px-5 py-6 sm:px-8 sm:py-8">
            <h1 class="text-title-sm font-semibold tracking-tight sm:text-title">{{ $title }}</h1>
            <div class="mt-6">
                {{ $slot }}
            </div>
        </main>
    </div>
</x-layouts.base>
