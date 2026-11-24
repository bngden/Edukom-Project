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
