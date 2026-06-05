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
import $ from 'jquery';
import DataTable from 'datatables.net-dt';
import AOS from 'aos';
import 'aos/dist/aos.css';
import './bootstrap';
import '../css/app.css';

window.$ = window.jQuery = $;
window.DataTable = DataTable;

// ── Expose Alpine globally so inline scripts (simulasi-alpine.blade.php)
//    can call Alpine.data() BEFORE Alpine.start() ──────────────────────────
window.Alpine = Alpine;

// ── Start Alpine and AOS after DOM is ready ──────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    Alpine.start();
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true, // whether animation should happen only once - while scrolling down
        offset: 50, // offset (in px) from the original trigger point
    });
});

document.addEventListener('DOMContentLoaded', () => {

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

    /* ── Navbar scroll shadow ─────────────────────── */
    const navbar = document.getElementById('main-navbar');
    function handleScroll() {
        if (!navbar) return;
        navbar.classList.toggle('navbar-scrolled', window.scrollY > 20);
        navbar.classList.toggle('bg-white/95', window.scrollY > 20);
        navbar.classList.toggle('dark:bg-charcoal-950/95', window.scrollY > 20);
    }
    window.addEventListener('scroll', handleScroll, { passive: true });
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
