document.addEventListener('submit', (event) => {
    const button = event.target.querySelector('[data-pending-label]');
    if (!button) {
        return;
    }
    if (button.disabled) {
        event.preventDefault();
        return;
    }
    button.disabled = true;
    button.setAttribute('aria-busy', 'true');
    button.textContent = button.dataset.pendingLabel;
});

document.addEventListener('click', (event) => {
    const toggle = event.target.closest('[data-password-toggle]');
    if (toggle) {
        const input = document.getElementById(toggle.dataset.passwordToggle);
        const show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        toggle.setAttribute('aria-pressed', String(show));
        toggle.setAttribute('aria-label', show ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
        toggle.querySelector('[data-icon-show]').hidden = show;
        toggle.querySelector('[data-icon-hide]').hidden = !show;
        return;
    }

    const navToggle = event.target.closest('[data-nav-toggle]');
    if (navToggle) {
        const nav = document.getElementById(navToggle.getAttribute('aria-controls'));
        const open = navToggle.getAttribute('aria-expanded') !== 'true';
        navToggle.setAttribute('aria-expanded', String(open));
        nav.hidden = !open;
    }
});

// Panel melayang (notifikasi, menu akun): tombol [data-popover] dengan aria-controls. Tutup saat klik di luar atau Esc.
const closePopovers = (except = null) => {
    document.querySelectorAll('[data-popover][aria-expanded="true"]').forEach((button) => {
        if (button === except) {
            return;
        }
        button.setAttribute('aria-expanded', 'false');
        document.getElementById(button.getAttribute('aria-controls')).hidden = true;
    });
};

document.addEventListener('click', (event) => {
    const button = event.target.closest('[data-popover]');
    if (button) {
        const panel = document.getElementById(button.getAttribute('aria-controls'));
        const open = button.getAttribute('aria-expanded') !== 'true';
        closePopovers(button);
        button.setAttribute('aria-expanded', String(open));
        panel.hidden = !open;
        return;
    }
    if (!event.target.closest('[data-popover-panel]')) {
        closePopovers();
    }
});

// Drawer sidebar di layar kecil.
const setDrawer = (open) => {
    document.documentElement.toggleAttribute('data-drawer-open', open);
    document.querySelectorAll('[data-drawer-toggle]').forEach((b) => b.setAttribute('aria-expanded', String(open)));
};

document.addEventListener('click', (event) => {
    if (event.target.closest('[data-drawer-toggle]')) {
        setDrawer(!document.documentElement.hasAttribute('data-drawer-open'));
    } else if (event.target.closest('[data-drawer-close]')) {
        setDrawer(false);
    }
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closePopovers();
        setDrawer(false);
    }
});

// Pastikan menu aktif terlihat di sidebar yang bisa digulir (layar pendek).
document.querySelector('#owner-sidebar [aria-current="page"]')?.scrollIntoView({ block: 'nearest' });

// Dialog bawaan: tombol [data-dialog-open="id"], tutup lewat [data-dialog-close]; [data-open-on-load] dibuka saat ada galat.
document.addEventListener('click', (event) => {
    const opener = event.target.closest('[data-dialog-open]');
    if (opener) {
        document.getElementById(opener.dataset.dialogOpen)?.showModal();
    } else if (event.target.closest('[data-dialog-close]')) {
        event.target.closest('dialog')?.close();
    }
});
document.querySelectorAll('dialog[data-open-on-load]').forEach((dialog) => dialog.showModal());

// Editor tingkatan jarak: baris "sampai X km" + baris terakhir "di atas X km" (tanpa batas atas).
const km = (value) => value.replace(/\.0$/, '').replace('.', ',');
const rupiah = (value) => 'Rp' + Number(value).toLocaleString('id-ID');

const refreshTierEditor = (editor) => {
    const rows = [...editor.querySelectorAll('[data-tier-row]')];
    let previous = null;
    let error = '';
    const parts = [];

    rows.forEach((row, index) => {
        const last = index === rows.length - 1;
        const max = row.querySelector('[data-tier-max]');
        const amount = row.querySelector('[data-tier-amount]');
        max.name = `tiers[${index}][max_km]`;
        amount.name = `tiers[${index}][amount]`;

        const raw = last ? '' : max.value.trim().replace(',', '.');
        const maxInvalid = !last && (!/^\d+(\.\d)?$/.test(raw) || Number(raw) <= 0 || (previous !== null && Number(raw) <= Number(previous)));
        const amountInvalid = !/^\d+$/.test(amount.value.trim());

        if (!last) {
            max.toggleAttribute('aria-invalid', maxInvalid && raw !== '');
        }
        amount.toggleAttribute('aria-invalid', amountInvalid && amount.value !== '');

        if (!error && maxInvalid) {
            error = raw === ''
                ? `Isi batas jarak tingkatan ke-${index + 1}.`
                : `Batas tingkatan ke-${index + 1} harus lebih besar dari ${previous === null ? '0' : km(previous)} km, maksimal 1 angka di belakang koma.`;
        }
        if (!error && amountInvalid) {
            error = `Isi nominal tingkatan ke-${index + 1} (angka bulat, Rp0 atau lebih).`;
        }

        if (last) {
            row.querySelector('[data-tier-label]').textContent = previous === null ? 'Semua jarak' : `di atas ${km(previous)} km`;
        }
        const remove = row.querySelector('[data-tier-remove]');
        remove.classList.toggle('invisible', last);
        remove.disabled = last;

        const range = last
            ? (previous === null ? 'Semua jarak' : `> ${km(previous)} km`)
            : (previous === null ? `≤ ${km(raw)} km` : `> ${km(previous)}–${km(raw)} km`);
        parts.push(`${range}: ${amountInvalid ? 'Rp…' : rupiah(amount.value)}`);

        if (!last) {
            previous = raw;
        }
    });

    editor.querySelector('[data-tier-preview]').textContent = parts.join(' · ');
    const message = editor.querySelector('[data-tier-error]');
    message.textContent = error;
    message.hidden = error === '';
    editor.querySelector('[data-tier-submit]').disabled = error !== '';
};

document.querySelectorAll('[data-tier-editor]').forEach((editor) => {
    editor.addEventListener('input', () => refreshTierEditor(editor));
    editor.addEventListener('click', (event) => {
        if (event.target.closest('[data-tier-add]')) {
            const rows = editor.querySelectorAll('[data-tier-row]');
            const row = editor.querySelector('[data-tier-template]').content.firstElementChild.cloneNode(true);
            rows[rows.length - 1].before(row);
            refreshTierEditor(editor);
            row.querySelector('[data-tier-max]').focus();
        }
        const remove = event.target.closest('[data-tier-remove]');
        if (remove) {
            remove.closest('[data-tier-row]').remove();
            refreshTierEditor(editor);
        }
    });
    refreshTierEditor(editor);
});
