<x-layouts.app title="Ganti kata sandi">
    <form method="POST" action="{{ route('akun.kata-sandi.update') }}" class="flex max-w-[400px] flex-col gap-5" novalidate>
        @csrf
        @method('PUT')

        @if (session('status'))
            <x-alert type="success">{{ session('status') }}</x-alert>
        @endif

        <p class="text-body text-muted">Minimal 8 karakter. Setelah disimpan, akun ini otomatis keluar dari perangkat lain.</p>

        <x-field name="current_password" label="Kata sandi saat ini" type="password" autocomplete="current-password" required />
        <x-field name="password" label="Kata sandi baru" type="password" autocomplete="new-password" required />
        <x-field name="password_confirmation" label="Ulangi kata sandi baru" type="password" autocomplete="new-password" required />

        <button type="submit"
                data-pending-label="Menyimpan…"
                class="mt-2 h-10 self-start rounded-control bg-royal px-5 text-body font-medium text-white transition-colors hover:bg-royal-700 disabled:cursor-wait disabled:bg-royal-700">
            Simpan kata sandi
        </button>
    </form>
</x-layouts.app>
