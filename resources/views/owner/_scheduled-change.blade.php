{{-- Banner versi terjadwal + batalkan. $scheduled: versi, $display: fn($versi): string, $cancelUrl, $bag: nama error bag (opsional) --}}
<div class="mt-6 flex flex-wrap items-center justify-between gap-3 rounded-card bg-royal-50 px-5 py-4">
    <p>Mulai <span class="font-semibold">{{ \App\Support\Format::date($scheduled->effective_from, short: true) }}</span> menjadi <span class="font-semibold">{{ $display($scheduled) }}</span>.</p>
    <details>
        <summary class="btn btn-secondary cursor-pointer list-none [&::-webkit-details-marker]:hidden">Batalkan</summary>
        <form method="POST" action="{{ $cancelUrl }}" class="mt-3 flex flex-wrap items-start gap-2">
            @csrf
            @isset($bag)
                <input type="hidden" name="_bag" value="{{ $bag }}">
            @endisset
            <label class="sr-only" for="batal-versi">Alasan pembatalan</label>
            <input id="batal-versi" name="reason" required maxlength="1000" placeholder="Alasan pembatalan" class="field w-64">
            <button type="submit" class="btn btn-danger" data-pending-label="Membatalkan…">Batalkan perubahan ini</button>
        </form>
    </details>
</div>
