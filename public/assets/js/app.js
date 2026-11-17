document.addEventListener('DOMContentLoaded', () => {
    // Menu mobile da nav em pílula
    const toggle = document.getElementById('navToggle');
    const topbar = document.getElementById('topbar');

    if (toggle && topbar) {
        toggle.addEventListener('click', () => {
            const open = topbar.classList.toggle('nav-open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            toggle.setAttribute('aria-label', open ? 'Fechar menu' : 'Abrir menu');
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && topbar.classList.contains('nav-open')) {
                topbar.classList.remove('nav-open');
                toggle.setAttribute('aria-expanded', 'false');
                toggle.focus();
            }
        });
    }
});
