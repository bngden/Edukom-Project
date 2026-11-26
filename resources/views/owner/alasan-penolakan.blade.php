@php
    $create = $errors->create;
    $edit = $errors->edit;
    $tabs = ['all' => 'Semua', 'active' => 'Aktif', 'inactive' => 'Nonaktif'];
@endphp
<x-layouts.owner title="Alasan Penolakan">
    <div class="flex flex-wrap items-center justify-between gap-3">
        <form method="GET" action="{{ route('owner.alasan-penolakan') }}" class="flex flex-wrap items-center gap-3">
            <div role="radiogroup" aria-label="Status" class="flex rounded-control bg-quiet p-1">
                @foreach ($tabs as $value => $label)
                    <label class="cursor-pointer">
                        <input type="radio" name="status" value="{{ $value }}" class="peer sr-only" @checked($status === $value) onchange="this.form.submit()">
                        <span class="block rounded-[9px] px-3.5 py-1.5 font-medium text-muted transition-colors peer-checked:bg-white peer-checked:text-ink peer-checked:shadow-sm peer-focus-visible:outline-2 peer-focus-visible:outline-royal">{{ $label }}</span>
                    </label>
                @endforeach
            </div>
            <label class="relative">
                <span class="sr-only">Cari nama alasan</span>
                <x-icon name="search" class="pointer-events-none absolute top-1/2 left-3 size-5 -translate-y-1/2 text-muted" />
                <input type="search" name="search" value="{{ $search }}" placeholder="Cari alasan" class="field h-10 w-60 pl-10">
            </label>
        </form>
        <button type="button" class="btn btn-primary" data-dialog-open="tambah-alasan">Tambah alasan</button>
    </div>

    @if ($errors->any())
        <x-alert class="mt-5">{{ $errors->first() }}</x-alert>
    @endif

    @if ($reasons->isEmpty())
        <div class="mt-6 flex flex-col items-center gap-3 rounded-card border border-line px-6 py-12 text-center">
            <x-icon name="format_list_bulleted" class="size-10 text-muted" />
            <p class="text-muted">{{ filled($search) || $status !== 'all' ? 'Tidak ada alasan yang cocok.' : 'Belum ada alasan penolakan.' }}</p>
        </div>
    @else
        <ul class="mt-6 divide-y divide-line rounded-card border border-line">
            @foreach ($reasons as $reason)
                @php($used = $reason->usage_count)
                <li class="flex flex-wrap items-center gap-x-4 gap-y-3 px-5 py-4 sm:flex-nowrap">
                    @if ($canReorder)
                        <div class="flex shrink-0 flex-col">
                            @foreach ([['up', 'arrow_upward', 'Naikkan', $loop->first], ['down', 'arrow_downward', 'Turunkan', $loop->last]] as [$dir, $icon, $label, $edge])
                                <form method="POST" action="{{ route('owner.alasan-penolakan.'.$dir, $reason) }}">
                                    @csrf
                                    <button type="submit" aria-label="{{ $label }} {{ $reason->name }}" @disabled($edge)
                                            class="flex size-7 items-center justify-center rounded-full text-muted hover:bg-quiet hover:text-ink disabled:opacity-30 disabled:hover:bg-transparent">
                                        <x-icon :name="$icon" class="size-4" />
                                    </button>
                                </form>
                            @endforeach
                        </div>
                    @endif

                    <div class="min-w-0 flex-1">
                        <p @class(['font-medium', 'text-muted' => ! $reason->is_active])>{{ $reason->name }}</p>
                        @if ($reason->description)
                            <p class="text-caption text-muted">{{ $reason->description }}</p>
                        @endif
                    </div>

                    <span class="w-24 shrink-0 text-caption text-muted">{{ $used ? "Dipakai {$used}×" : 'Belum dipakai' }}</span>
                    <x-chip :tone="$reason->is_active ? 'success' : 'neutral'" class="w-20 justify-center">{{ $reason->is_active ? 'Aktif' : 'Nonaktif' }}</x-chip>

                    <div class="flex shrink-0 items-center gap-1">
                        <button type="button" data-dialog-open="ubah-{{ $reason->id }}" class="btn h-9 px-3 text-muted hover:bg-quiet hover:text-ink">Ubah</button>
                        <form method="POST" action="{{ route('owner.alasan-penolakan.'.($reason->is_active ? 'deactivate' : 'activate'), $reason) }}">
                            @csrf
                            <button type="submit" class="btn h-9 w-28 px-3 text-muted hover:bg-quiet hover:text-ink">{{ $reason->is_active ? 'Nonaktifkan' : 'Aktifkan' }}</button>
                        </form>
                        <span title="{{ $used ? 'Sudah pernah dipakai, hanya dapat dinonaktifkan' : '' }}">
                            <button type="button" data-dialog-open="hapus-{{ $reason->id }}" aria-label="Hapus {{ $reason->name }}" @disabled($used)
                                    class="flex size-9 items-center justify-center rounded-full text-muted hover:bg-danger-bg hover:text-danger disabled:opacity-30 disabled:hover:bg-transparent disabled:hover:text-muted">
                                <x-icon name="delete" class="size-5" />
                            </button>
                        </span>
                    </div>

                    @php($mine = $edit->any() && (int) old('_edit_id') === $reason->id)
                    <dialog id="ubah-{{ $reason->id }}" aria-labelledby="judul-ubah-{{ $reason->id }}" class="m-auto w-[min(480px,calc(100vw-2rem))] rounded-[20px] p-0 backdrop:bg-ink/40"
                            @if ($mine) data-open-on-load @endif>
                        <form method="POST" action="{{ route('owner.alasan-penolakan.update', $reason) }}" class="flex flex-col gap-5 p-6" novalidate>
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="_bag" value="edit">
                            <input type="hidden" name="_edit_id" value="{{ $reason->id }}">
                            <h2 id="judul-ubah-{{ $reason->id }}" class="text-[18px] leading-[26px] font-semibold">Ubah alasan</h2>
                            <label class="flex flex-col gap-1.5">
                                <span class="font-medium">Nama</span>
                                <input name="name" required maxlength="150" value="{{ $mine ? old('name') : $reason->name }}" class="field" @if ($mine && $edit->has('name')) aria-invalid="true" @endif>
                                @if ($mine && $edit->has('name'))<span class="text-caption text-danger">{{ $edit->first('name') }}</span>@endif
                            </label>
                            <label class="flex flex-col gap-1.5">
                                <span class="font-medium">Keterangan <span class="font-normal text-muted">(opsional)</span></span>
                                <textarea name="description" rows="2" maxlength="1000" class="field">{{ $mine ? old('description') : $reason->description }}</textarea>
                            </label>
                            <div class="flex justify-end gap-3">
                                <button type="button" class="btn btn-secondary" data-dialog-close>Batal</button>
                                <button type="submit" class="btn btn-primary" data-pending-label="Menyimpan…">Simpan</button>
                            </div>
                        </form>
                    </dialog>

                    @unless ($used)
                        <dialog id="hapus-{{ $reason->id }}" aria-labelledby="judul-hapus-{{ $reason->id }}" class="m-auto w-[min(440px,calc(100vw-2rem))] rounded-[20px] p-0 backdrop:bg-ink/40">
                            <form method="POST" action="{{ route('owner.alasan-penolakan.destroy', $reason) }}" class="flex flex-col gap-4 p-6">
                                @csrf
                                @method('DELETE')
                                <h2 id="judul-hapus-{{ $reason->id }}" class="text-[18px] leading-[26px] font-semibold">Hapus "{{ $reason->name }}"?</h2>
                                <p class="text-muted">Alasan ini belum pernah dipakai, jadi dapat dihapus permanen.</p>
                                <div class="flex justify-end gap-3">
                                    <button type="button" class="btn btn-secondary" data-dialog-close>Batal</button>
                                    <button type="submit" class="btn btn-danger" data-pending-label="Menghapus…">Hapus</button>
                                </div>
                            </form>
                        </dialog>
                    @endunless
                </li>
            @endforeach
        </ul>
    @endif

    <dialog id="tambah-alasan" aria-labelledby="judul-tambah" @if ($create->any()) data-open-on-load @endif
            class="m-auto w-[min(480px,calc(100vw-2rem))] rounded-[20px] p-0 backdrop:bg-ink/40">
        <form method="POST" action="{{ route('owner.alasan-penolakan.store') }}" class="flex flex-col gap-5 p-6" novalidate>
            @csrf
            <input type="hidden" name="_bag" value="create">
            <h2 id="judul-tambah" class="text-[18px] leading-[26px] font-semibold">Tambah alasan</h2>
            <label class="flex flex-col gap-1.5">
                <span class="font-medium">Nama</span>
                <input name="name" required maxlength="150" value="{{ $create->any() ? old('name') : '' }}" class="field" @if ($create->has('name')) aria-invalid="true" @endif>
                @if ($create->has('name'))<span class="text-caption text-danger">{{ $create->first('name') }}</span>@endif
            </label>
            <label class="flex flex-col gap-1.5">
                <span class="font-medium">Keterangan <span class="font-normal text-muted">(opsional)</span></span>
                <textarea name="description" rows="2" maxlength="1000" class="field">{{ $create->any() ? old('description') : '' }}</textarea>
            </label>
            <div class="flex justify-end gap-3">
                <button type="button" class="btn btn-secondary" data-dialog-close>Batal</button>
                <button type="submit" class="btn btn-primary" data-pending-label="Menyimpan…">Tambah alasan</button>
            </div>
        </form>
    </dialog>
</x-layouts.owner>
