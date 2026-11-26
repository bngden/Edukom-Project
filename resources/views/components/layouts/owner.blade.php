@props(['title'])
@php
    $user = auth()->user();
    $initials = collect(preg_split('/\s+/', trim($user->name)))->filter()->take(2)->map(fn ($p) => mb_strtoupper(mb_substr($p, 0, 1)))->implode('');
    $groups = [
        'Utama' => [['owner.beranda', 'Beranda', 'home']],
        'Persetujuan' => [
            [null, 'Honorarium', 'payments'],
            [null, 'Penyesuaian Honor', 'balance'],
            [null, 'Pengadaan Aset', 'shopping_cart'],
            [null, 'Eskalasi & Izin Mendesak', 'warning'],
        ],
        'Pemantauan' => [
            [null, 'Pembelajaran', 'co_present'],
            [null, 'Aset & Perangkat', 'laptop_chromebook'],
            [null, 'Izin & Penggantian', 'swap_horiz'],
            [null, 'Pembayaran Honor', 'receipt_long'],
        ],
        'Kebijakan' => [
            ['owner.komponen-honor', 'Komponen Honor', 'toll'],
            ['owner.parameter', 'Parameter Kebijakan', 'tune'],
            ['owner.alasan-penolakan', 'Alasan Penolakan', 'format_list_bulleted'],
            ['owner.masa-simpan', 'Masa Simpan Data', 'auto_delete'],
        ],
        'Pengaturan' => [['owner.riwayat', 'Riwayat Perubahan', 'history']],
    ];
    $notifications = $user->notifications()->latest()->limit(8)->get(['id', 'data', 'read_at', 'created_at']);
    $unread = $user->unreadNotifications()->count();
@endphp
<x-layouts.base :title="$title">
    <div data-drawer-close class="fixed inset-0 z-20 bg-ink/30 opacity-0 pointer-events-none transition-opacity duration-300 md:hidden [html[data-drawer-open]_&]:pointer-events-auto [html[data-drawer-open]_&]:opacity-100"></div>

    <aside id="owner-sidebar" aria-label="Menu utama"
           class="fixed inset-y-0 left-0 z-30 flex w-[272px] -translate-x-full flex-col rounded-tr-curve bg-royal text-white transition-transform duration-300 md:w-20 md:translate-x-0 lg:w-[264px] [html[data-drawer-open]_&]:translate-x-0">
        <div class="flex h-[72px] shrink-0 items-center px-6 md:justify-center md:px-0 lg:justify-start lg:px-6">
            <x-brand class="md:[&>span:last-child]:hidden lg:[&>span:last-child]:inline" />
        </div>

        <nav class="flex-1 overflow-y-auto pb-6 pl-3 [scrollbar-width:none]">
            @foreach ($groups as $group => $items)
                <p class="px-3 pt-4 pb-1 text-caption font-medium text-white/60 md:hidden lg:block">{{ $group }}</p>
                <ul class="flex flex-col gap-0.5 md:pt-3 lg:pt-0" aria-label="{{ $group }}">
                    @foreach ($items as [$route, $label, $icon])
                        <li>
                            @if ($route && Route::has($route))
                                <a href="{{ route($route) }}" title="{{ $label }}" @if (request()->routeIs($route.'*')) aria-current="page" @endif
                                   class="nav-item md:justify-center md:px-0 lg:justify-start lg:px-3">
                                    <x-icon :name="$icon" class="size-5" />
                                    <span class="truncate md:sr-only lg:not-sr-only">{{ $label }}</span>
                                </a>
                            @else
                                <span aria-disabled="true" title="{{ $label }} belum tersedia"
                                      class="nav-item md:justify-center md:px-0 lg:justify-start lg:px-3">
                                    <x-icon :name="$icon" class="size-5" />
                                    <span class="truncate md:sr-only lg:not-sr-only">{{ $label }}</span>
                                </span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </nav>

        <div class="shrink-0 p-3 lg:p-4">
            <div class="flex flex-col gap-2 rounded-[14px] p-3 md:p-0 lg:bg-white/10 lg:p-3 max-md:bg-white/10">
                <div class="flex items-center gap-3 md:justify-center lg:justify-start">
                    <span class="flex size-9 shrink-0 items-center justify-center rounded-full bg-white text-body font-semibold text-royal" title="{{ $user->name }}">{{ $initials }}</span>
                    <span class="min-w-0 md:hidden lg:block">
                        <span class="block truncate text-caption font-semibold">{{ $user->name }}</span>
                        <span class="block text-caption text-white/70">{{ $user->role->label() }}</span>
                    </span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Keluar"
                            class="flex w-full items-center justify-center gap-2 rounded-[10px] py-2 text-caption font-medium text-white/75 transition-colors hover:bg-white/10 hover:text-white">
                        <x-icon name="logout" class="size-[18px]" />
                        <span class="md:sr-only lg:not-sr-only">Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <div class="min-h-screen p-3 sm:p-4 md:pl-24 lg:pl-[280px]">
        <div class="mb-3 flex h-14 items-center justify-between rounded-card bg-royal px-4 md:hidden">
            <x-brand class="[&>svg]:size-7 [&>span:last-child]:text-[18px]" />
            <button type="button" data-drawer-toggle aria-controls="owner-sidebar" aria-expanded="false" aria-label="Buka menu"
                    class="flex size-10 items-center justify-center rounded-control text-white hover:bg-white/10">
                <x-icon name="menu" class="size-6" />
            </button>
        </div>

        <div class="min-h-[calc(100vh-2rem)] rounded-panel bg-white max-md:min-h-[calc(100vh-5.5rem)]">
            <header class="flex h-[72px] items-center justify-between gap-4 border-b border-line px-5 sm:px-8">
                <h1 class="truncate text-title-sm font-semibold tracking-tight sm:text-title">{{ $title }}</h1>

                <div class="flex shrink-0 items-center gap-1 sm:gap-3">
                    <div class="relative">
                        <button type="button" data-popover aria-controls="notif-panel" aria-expanded="false"
                                aria-label="Notifikasi{{ $unread ? ", {$unread} belum dibaca" : '' }}"
                                class="relative flex size-10 items-center justify-center rounded-full text-muted transition-colors hover:bg-quiet hover:text-ink">
                            <x-icon name="notifications" class="size-[22px]" />
                            @if ($unread)
                                <span class="absolute top-2 right-2 size-2 rounded-full bg-danger ring-2 ring-white"></span>
                            @endif
                        </button>
                        <div id="notif-panel" data-popover-panel hidden
                             class="absolute right-0 top-12 z-40 w-[min(360px,calc(100vw-1.5rem))] overflow-hidden rounded-card border border-line bg-white shadow-float max-sm:-right-12">
                            <div class="flex items-center justify-between gap-3 px-4 py-3">
                                <p class="font-semibold">Notifikasi</p>
                                @if ($unread)
                                    <form method="POST" action="{{ route('notifikasi.baca-semua') }}">
                                        @csrf
                                        <button type="submit" class="text-caption font-medium text-royal hover:text-royal-700">Tandai semua dibaca</button>
                                    </form>
                                @endif
                            </div>
                            @forelse ($notifications as $notification)
                                <form method="POST" action="{{ route('notifikasi.baca', $notification->id) }}" class="border-t border-line">
                                    @csrf
                                    <button type="submit" class="flex w-full gap-3 px-4 py-3 text-left transition-colors hover:bg-royal-50">
                                        <span @class(['mt-2 size-2 shrink-0 rounded-full', 'bg-royal' => ! $notification->read_at])></span>
                                        <span class="min-w-0">
                                            <span @class(['block', 'font-semibold' => ! $notification->read_at, 'text-muted' => $notification->read_at])>{{ $notification->data['title'] ?? '' }}</span>
                                            <span class="mt-0.5 line-clamp-2 text-caption text-muted">{{ $notification->data['message'] ?? '' }}</span>
                                            <span class="mt-1 block text-caption text-muted">{{ $notification->created_at->diffForHumans() }}</span>
                                        </span>
                                    </button>
                                </form>
                            @empty
                                <p class="border-t border-line px-4 py-6 text-center text-muted">Belum ada notifikasi.</p>
                            @endforelse
                        </div>
                    </div>

                    <span class="hidden h-6 w-px bg-line sm:block"></span>

                    <div class="relative">
                        <button type="button" data-popover aria-controls="account-menu" aria-expanded="false" aria-label="Menu akun"
                                class="flex items-center gap-3 rounded-full p-0.5 transition-colors hover:bg-quiet sm:pl-3">
                            <span class="hidden text-right sm:block">
                                <span class="block font-medium leading-tight">{{ $user->name }}</span>
                                <span class="block text-caption text-muted">{{ $user->role->label() }}</span>
                            </span>
                            <span class="flex size-9 items-center justify-center rounded-full bg-royal text-body font-semibold text-white">{{ $initials }}</span>
                        </button>
                        <div id="account-menu" data-popover-panel hidden
                             class="absolute right-0 top-12 z-40 w-56 rounded-card border border-line bg-white p-1.5 shadow-float">
                            <a href="{{ route('akun.kata-sandi') }}" class="flex items-center gap-3 rounded-control px-3 py-2.5 font-medium hover:bg-quiet">
                                <x-icon name="key" class="size-[18px] text-muted" />Ganti kata sandi
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-3 rounded-control px-3 py-2.5 font-medium text-danger hover:bg-danger-bg">
                                    <x-icon name="logout" class="size-[18px]" />Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="px-5 py-6 sm:px-8 sm:py-8">
                @if (session('status'))
                    <x-alert type="success" class="mb-6">{{ session('status') }}</x-alert>
                @endif
                {{ $slot }}
            </main>
        </div>
    </div>
</x-layouts.base>
