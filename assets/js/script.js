/* ═══════════════════════════════════════════════════════════════
   Startout AI — front-end behaviors
   ═══════════════════════════════════════════════════════════════ */

document.addEventListener('DOMContentLoaded', function () {
    const root = document.documentElement;

    /* ── Theme toggle (persists across pages via localStorage) ── */
    const themeToggle = document.getElementById('themeToggle');

    function setTheme(theme) {
        root.setAttribute('data-theme', theme);
        try { localStorage.setItem('startout-theme', theme); } catch (e) {}
    }

    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            const next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            setTheme(next);
        });
    }

    /* ── Mobile menu ── */
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileOverlay = document.getElementById('mobileOverlay');
    const mmClose = document.getElementById('mmClose');

    function openMobile() {
        if (mobileMenu) mobileMenu.classList.add('open');
        if (mobileOverlay) mobileOverlay.classList.add('open');
        if (hamburger) hamburger.setAttribute('aria-expanded', 'true');
    }
    function closeMobile() {
        if (mobileMenu) mobileMenu.classList.remove('open');
        if (mobileOverlay) mobileOverlay.classList.remove('open');
        if (hamburger) hamburger.setAttribute('aria-expanded', 'false');
    }
    if (hamburger) hamburger.addEventListener('click', openMobile);
    if (mmClose) mmClose.addEventListener('click', closeMobile);
    if (mobileOverlay) mobileOverlay.addEventListener('click', closeMobile);

    // Close mobile menu when a link inside is clicked
    if (mobileMenu) {
        mobileMenu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', closeMobile);
        });
    }

    /* ── FAQ accordion ── */
    document.querySelectorAll('.faq-item').forEach(function (item) {
        const q = item.querySelector('.faq-q');
        const a = item.querySelector('.faq-a');
        if (!q || !a) return;

        q.addEventListener('click', function () {
            const isOpen = item.classList.contains('open');

            // Close all in same group
            item.parentElement.querySelectorAll('.faq-item.open').forEach(function (other) {
                if (other !== item) {
                    other.classList.remove('open');
                    other.querySelector('.faq-a').style.maxHeight = '0px';
                }
            });

            if (isOpen) {
                item.classList.remove('open');
                a.style.maxHeight = '0px';
            } else {
                item.classList.add('open');
                a.style.maxHeight = a.scrollHeight + 'px';
            }
        });
    });

    /* ── Reveal on scroll ── */
    const revealEls = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window && revealEls.length) {
        const io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        revealEls.forEach(function (el) { io.observe(el); });
    } else {
        revealEls.forEach(function (el) { el.classList.add('in-view'); });
    }
});
