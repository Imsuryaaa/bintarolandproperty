// ── Dark mode: MUST run before any render to prevent flash ──────────────────
(function () {
    const stored = localStorage.getItem('theme');
    if (stored === 'dark') {
        document.documentElement.classList.add('dark');
    }
})();

// ── x-cloak: inject BEFORE Alpine so hidden elements stay hidden until init ──
(function () {
    var s = document.createElement('style');
    s.textContent = '[x-cloak]{display:none!important}';
    document.head.prepend(s);
})();

// ── Imports ──────────────────────────────────────────────────────────────────
import Alpine from 'alpinejs';
import './bootstrap';
import '../css/app.css';

// ── Expose Alpine globally ────────────────────────────────────────────────────
window.Alpine = Alpine;

// ── Detect mobile sekali saja ─────────────────────────────────────────────────
const IS_MOBILE = window.matchMedia('(max-width: 767px)').matches;

// ═══════════════════════════════════════════════════════════════════════════════
//  SISTEM ANIMASI NATIVE — Intersection Observer
//  Jauh lebih ringan dari AOS: tidak ada forced reflow, tidak ada 3rd-party
//  observer overhead, semua animasi di CSS transition (GPU compositor).
// ═══════════════════════════════════════════════════════════════════════════════

/**
 * initRevealObserver — observasi elemen [data-reveal]
 * Ketika masuk viewport, tambahkan class "is-visible" → CSS transition berjalan.
 */
function initRevealObserver() {
    if (!('IntersectionObserver' in window)) {
        // Fallback: langsung tampilkan semua elemen
        document.querySelectorAll('[data-reveal]').forEach(el => {
            el.classList.add('is-visible');
        });
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target); // Hanya 1x, tidak repeat
                }
            });
        },
        {
            threshold:  0.1,   // Trigger saat 10% elemen terlihat
            rootMargin: '0px 0px -40px 0px', // Trigger sedikit sebelum masuk viewport
        }
    );

    document.querySelectorAll('[data-reveal]').forEach(el => observer.observe(el));
}

/**
 * initCardRevealObserver — observasi .prop-card
 * Lebih agresif: threshold 0.05 agar kartu langsung reveal saat hampir masuk.
 * Stagger delay ditangani via CSS nth-child.
 */
function initCardRevealObserver() {
    if (!('IntersectionObserver' in window)) {
        document.querySelectorAll('.prop-card').forEach(el => {
            el.classList.add('card-visible');
        });
        return;
    }

    const cardObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // requestAnimationFrame memastikan class toggle di frame yang tepat
                    requestAnimationFrame(() => {
                        entry.target.classList.add('card-visible');
                    });
                    cardObserver.unobserve(entry.target);
                }
            });
        },
        {
            threshold:  0.05,
            rootMargin: '0px 0px -20px 0px',
        }
    );

    document.querySelectorAll('.prop-card').forEach(el => cardObserver.observe(el));

    // Expose untuk dipanggil ulang setelah AJAX pagination swap
    window._cardObserver = cardObserver;
}

/**
 * Re-observe cards baru setelah AJAX pagination.
 * Dipanggil dari handler AJAX di home.blade.php.
 */
window.reObserveCards = function () {
    if (!window._cardObserver) return;
    document.querySelectorAll('.prop-card:not(.card-visible)').forEach(el => {
        window._cardObserver.observe(el);
    });
};

// ── Single DOMContentLoaded listener ─────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {

    // ── Alpine ────────────────────────────────────────────────────────────────
    Alpine.start();

    // ── Inisialisasi sistem animasi ───────────────────────────────────────────
    initRevealObserver();
    initCardRevealObserver();

    /* ── Dark mode toggle ─────────────────────────── */
    const toggleBtn        = document.getElementById('theme-toggle');
    const knob             = document.getElementById('theme-toggle-knob');
    const sunIcon          = document.getElementById('icon-sun');
    const moonIcon         = document.getElementById('icon-moon');

    const toggleBtnMobile  = document.getElementById('theme-toggle-mobile');
    const knobMobile       = document.getElementById('theme-toggle-knob-mobile');
    const sunIconMobile    = document.getElementById('icon-sun-mobile');
    const moonIconMobile   = document.getElementById('icon-moon-mobile');

    function applyTheme(dark) {
        document.documentElement.classList.toggle('dark', dark);
        localStorage.setItem('theme', dark ? 'dark' : 'light');

        if (knob) {
            knob.classList.toggle('translate-x-5', dark);
            knob.classList.toggle('translate-x-0', !dark);
        }
        if (sunIcon && moonIcon) {
            sunIcon.classList.toggle('opacity-0', dark);
            sunIcon.classList.toggle('opacity-100', !dark);
            moonIcon.classList.toggle('opacity-100', dark);
            moonIcon.classList.toggle('opacity-0', !dark);
        }

        if (knobMobile) {
            knobMobile.classList.toggle('translate-x-5', dark);
            knobMobile.classList.toggle('translate-x-0', !dark);
        }
        if (sunIconMobile && moonIconMobile) {
            sunIconMobile.classList.toggle('opacity-0', dark);
            sunIconMobile.classList.toggle('opacity-100', !dark);
            moonIconMobile.classList.toggle('opacity-100', dark);
            moonIconMobile.classList.toggle('opacity-0', !dark);
        }

        const adminDarkIcon  = document.getElementById('theme-toggle-dark-icon');
        const adminLightIcon = document.getElementById('theme-toggle-light-icon');
        if (adminDarkIcon && adminLightIcon) {
            adminDarkIcon.classList.toggle('hidden', dark);
            adminLightIcon.classList.toggle('hidden', !dark);
        }
    }

    const isDark = document.documentElement.classList.contains('dark');
    applyTheme(isDark);

    toggleBtn?.addEventListener('click', () => {
        applyTheme(!document.documentElement.classList.contains('dark'));
    });
    toggleBtnMobile?.addEventListener('click', () => {
        applyTheme(!document.documentElement.classList.contains('dark'));
    });

    /* ── Navbar scroll shadow — rAF throttled ────────────── */
    const navbar = document.getElementById('main-navbar');
    let scrollRafPending = false;

    function handleScroll() {
        if (!navbar) return;
        const scrolled = window.scrollY > 20;
        navbar.classList.toggle('navbar-scrolled', scrolled);
        navbar.classList.toggle('bg-white/95', scrolled);
        navbar.classList.toggle('dark:bg-charcoal-950/95', scrolled);
        if (IS_MOBILE) {
            navbar.classList.toggle('bg-white', !scrolled);
            navbar.classList.toggle('dark:bg-charcoal-950', !scrolled);
        }
    }

    window.addEventListener('scroll', () => {
        if (!scrollRafPending) {
            scrollRafPending = true;
            requestAnimationFrame(() => {
                handleScroll();
                scrollRafPending = false;
            });
        }
    }, { passive: true });

    handleScroll();

    /* ── Mobile menu ──────────────────────────────── */
    const menuBtn   = document.getElementById('mobile-menu-btn');
    const mobileNav = document.getElementById('mobile-nav');
    const iconOpen  = document.getElementById('icon-menu-open');
    const iconClose = document.getElementById('icon-menu-close');

    menuBtn?.addEventListener('click', () => {
        const open = !mobileNav.classList.contains('hidden');
        mobileNav.classList.toggle('hidden', open);
        iconOpen?.classList.toggle('hidden', !open);
        iconClose?.classList.toggle('hidden', open);
    });

    mobileNav?.querySelectorAll('a').forEach(a => {
        a.addEventListener('click', () => {
            mobileNav.classList.add('hidden');
            iconOpen?.classList.remove('hidden');
            iconClose?.classList.add('hidden');
        });
    });
});
