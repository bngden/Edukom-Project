<x-layouts.app title="Beranda">
    <div class="max-w-xl border-t border-line pt-6">
        @if ($isOwner)
            <h2 class="text-[18px] leading-[26px] font-semibold">Belum ada modul Owner yang aktif</h2>
            <p class="mt-2 text-body text-muted">
                Parameter kebijakan, komponen honor, dan alasan penolakan izin akan tampil di menu setelah selesai dibangun.
            </p>
        @else
            <h2 class="text-[18px] leading-[26px] font-semibold">Modul untuk peran {{ $roleLabel }} belum tersedia</h2>
            <p class="mt-2 text-body text-muted">
                Saat ini Anda hanya bisa mengganti kata sandi atau keluar.
            </p>
        @endif
    </div>
</x-layouts.app>
