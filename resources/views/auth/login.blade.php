<x-layouts.base title="Masuk">
    <div class="flex min-h-screen flex-col lg:flex-row">
        <aside class="flex h-[72px] shrink-0 items-center rounded-tr-curve bg-royal px-4 sm:px-6 lg:h-auto lg:w-[38%] lg:max-w-[520px] lg:flex-col lg:items-start lg:justify-between lg:px-10 lg:py-10">
            <x-brand />
            <p class="hidden text-body text-nav-text lg:block">CV Edukom Jaya Abadi</p>
        </aside>

        <main class="flex flex-1 p-4 sm:p-6 lg:p-4">
            <div class="flex w-full items-center rounded-panel bg-white px-5 py-10 sm:px-10 lg:px-16">
                <div class="w-full max-w-[400px]">
                    <h1 class="text-title font-semibold tracking-tight">Masuk</h1>
                    <p class="mt-1 text-body text-muted">Gunakan email dan kata sandi akun Edukom Anda.</p>

                    <form method="POST" action="{{ route('login.store') }}" class="mt-8 flex flex-col gap-5" novalidate>
                        @csrf

                        @if ($errors->has('auth'))
                            <x-alert>{{ $errors->first('auth') }}</x-alert>
                        @endif

                        <x-field name="email" label="Email" type="email" icon="mail" :value="old('email')"
                                 autocomplete="username" autofocus required />

                        <x-field name="password" label="Kata sandi" type="password" icon="lock"
                                 autocomplete="current-password" required />

                        <button type="submit"
                                data-pending-label="Memproses…"
                                class="mt-2 h-11 rounded-control bg-royal text-body font-medium text-white transition-colors hover:bg-royal-700 focus-visible:outline-offset-4 disabled:cursor-wait disabled:bg-royal-700">
                            Masuk
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-layouts.base>
