<style>
    .site-header {
        position: sticky;
        top: 0;
        width: 100%;
        z-index: 9999;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
        transition: 0.25s ease;
    }

    .top-header {
        width: 100%;
        background: #eef4f5;
        padding: 13px 0;
    }

    .brand-wrapper {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 14px;
        width: 100%;
    }

    .brand-logo {
        width: 58px;
        height: 58px;
        object-fit: contain;
        flex-shrink: 0;
    }

    .brand-unw {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 14px;
        min-width: 0;
    }

    .brand-main {
        font-size: 42px;
        line-height: 1;
        font-weight: 800;
        color: var(--primary);
        letter-spacing: 1px;
    }

    .brand-sub {
        margin-top: 4px;
        font-size: 8px;
        line-height: 1.2;
        font-weight: 700;
        color: var(--primary);
        text-transform: uppercase;
    }

    .brand-divider {
        width: 2px;
        height: 43px;
        background: var(--primary);
        opacity: 0.7;
        flex-shrink: 0;
    }

    .brand-school {
        color: var(--primary);
        font-weight: 800;
        font-size: 16px;
        line-height: 1.25;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .navbar {
        background: var(--primary);
        min-height: 64px;
        position: relative;
        z-index: 1000;
        transition: 0.25s ease;
    }

    .nav-content {
        display: flex;
        align-items: stretch;
        min-height: 64px;
        position: relative;
    }

    .nav-menu {
        display: flex;
        align-items: stretch;
        height: auto;
        min-height: 64px;
    }

    .nav-item {
        position: relative;
        height: auto;
        display: flex;
        flex-direction: column;
    }

    .nav-link {
        height: 64px;
        padding: 0 17px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 700;
        color: var(--white);
        text-transform: uppercase;
        transition: 0.25s ease;
        white-space: nowrap;
        border: none;
        background: transparent;
        cursor: pointer;
    }

    .nav-link:hover,
    .nav-link.nav-click-active {
        background: var(--yellow);
        color: var(--white);
    }

    .nav-item.home-active .nav-link {
        color: var(--yellow);
        background: transparent;
    }

    .nav-item.home-active .nav-link:hover {
        color: var(--white);
        background: var(--yellow);
    }

    .nav-item.home-active::after {
        content: "";
        position: absolute;
        left: 16px;
        right: 16px;
        top: 59px;
        height: 5px;
        border-radius: 8px 8px 0 0;
        background: var(--yellow);
    }

    .nav-item.home-active.hide-indicator::after {
        display: none;
    }

    .chevron {
        width: 7px;
        height: 7px;
        border-right: 2px solid currentColor;
        border-bottom: 2px solid currentColor;
        transform: rotate(45deg) translateY(-2px);
        transform-origin: center;
        display: inline-block;
        flex-shrink: 0;
        margin-left: 2px;
        transition: transform 0.25s ease;
    }

    .nav-item:hover .chevron,
    .nav-item.open .chevron {
        transform: rotate(225deg) translateY(-1px);
    }

    /* PENGATURAN DROPDOWN DESKTOP DIPERBAIKI */
    .dropdown {
        position: absolute;
        top: 64px;
        left: 0;
        min-width: 255px;
        background: var(--white);
        border-radius: 0 0 6px 6px;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.22);
        padding: 12px 0;
        opacity: 0;
        visibility: hidden;
        transform: translateY(8px);
        transition: 0.25s ease;
        z-index: 2000;
    }

    .nav-item:hover .dropdown,
    .nav-item.open .dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    /* BATAS PERBAIKAN DROPDOWN DESKTOP */

    .dropdown a {
        display: block;
        width: 100%;
        padding: 11px 18px;
        font-size: 12px;
        font-weight: 600;
        color: #111827;
        transition: 0.2s ease;
        white-space: normal;
    }

    .dropdown a:hover {
        background: #f3f4f6;
        color: var(--primary);
        padding-left: 23px;
    }

    .hamburger {
        display: none;
        margin-left: auto;
        width: 42px;
        height: 42px;
        border: none;
        background: transparent;
        cursor: pointer;
        padding: 0;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 7px;
        line-height: 1;
    }

    .hamburger span {
        display: block;
        width: 26px;
        height: 3px;
        background: var(--primary);
        border-radius: 10px;
        margin: 0;
        padding: 0;
        flex: 0 0 3px;
        transition: 0.25s ease;
    }

    .hero-slide {
        opacity: 1 !important;
        transform: translateX(100%);
        transition: transform 0.75s ease-in-out !important;
        will-change: transform;
        z-index: 1;
    }

    .hero-slide.active {
        opacity: 1 !important;
        transform: translateX(0) !important;
        z-index: 3;
    }

    .hero-slide.was-active:not(.active),
    .hero-slide.slide-out-left {
        opacity: 1 !important;
        transform: translateX(-100%) !important;
        z-index: 2;
    }

    .hero-slide.slide-ready-right:not(.active):not(.was-active) {
        transform: translateX(100%) !important;
        z-index: 1;
    }

    @media (min-width: 993px) {
        .site-header.nav-collapsed .navbar {
            position: absolute;
            top: 14px;
            right: 24px;
            width: auto;
            min-height: 0;
            background: transparent;
            box-shadow: none;
        }

        .site-header.nav-collapsed .navbar .container {
            width: auto;
            margin: 0;
        }

        .site-header.nav-collapsed .nav-content {
            min-height: 0;
            justify-content: flex-end;
        }

        .site-header.nav-collapsed .hamburger {
            display: flex;
            width: 44px;
            height: 44px;
            margin-left: 0;
            gap: 7px;
        }

        .site-header.nav-collapsed .hamburger span {
            width: 30px;
            min-width: 30px;
            max-width: 30px;
            height: 3px;
            flex: 0 0 3px;
            margin: 0;
            padding: 0;
            background: var(--primary);
        }

        .site-header.nav-collapsed .nav-menu {
            display: none;
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            width: 285px;
            height: auto;
            max-height: calc(100vh - 110px);
            overflow-y: auto;
            flex-direction: column;
            align-items: stretch;
            padding: 8px 0 14px;
            background: var(--primary);
            border-radius: 0;
            box-shadow: none;
        }

        .site-header.nav-collapsed .nav-menu.show {
            display: flex;
        }

        .site-header.nav-collapsed .nav-item {
            width: 100%;
            height: auto;
        }

        .site-header.nav-collapsed .nav-link {
            width: 100%;
            height: 48px;
            padding: 0 16px;
            justify-content: space-between;
            font-size: 12px;
            color: var(--white);
        }

        .site-header.nav-collapsed .nav-item.home-active::after {
            display: none;
        }

        /* PENGATURAN DROPDOWN SAAT NAVIGASI STICKY COLLAPSED */
        .site-header.nav-collapsed .dropdown {
            position: static;
            box-shadow: none;
            padding: 5px 0;
            transform: none;
            display: none;
            /* Sembunyikan secara visual di mode collapsed */
            opacity: 1;
            visibility: visible;
        }

        .site-header.nav-collapsed .nav-item:hover .dropdown {
            display: none;
        }

        .site-header.nav-collapsed .nav-item.open .dropdown {
            display: block;
        }
    }

    @media (max-width: 1200px) {
        .nav-link {
            padding: 0 12px;
            font-size: 11px;
        }
    }

    @media (max-width: 992px) {
        .site-header {
            position: sticky;
            top: 0;
            background: #eef4f5;
        }

        .top-header {
            padding: 10px 74px 10px 0;
        }

        .brand-wrapper {
            justify-content: flex-start;
            gap: 12px;
        }

        .brand-main {
            font-size: 34px;
        }

        .brand-school {
            font-size: 13px;
        }

        .navbar {
            position: absolute;
            top: 12px;
            right: 14px;
            width: auto;
            min-height: 0;
            background: transparent;
            border-radius: 0;
            box-shadow: none;
        }

        .navbar .container {
            width: auto;
            margin: 0;
        }

        .nav-content {
            min-height: 0;
            justify-content: flex-end;
            position: relative;
        }

        .hamburger {
            display: flex;
            width: 46px;
            height: 46px;
            margin-left: 0;
            border-radius: 0;
            background: transparent;
            gap: 7px;
        }

        .hamburger span {
            width: 28px;
            min-width: 28px;
            max-width: 28px;
            height: 3px;
            flex: 0 0 3px;
            background: var(--primary);
        }

        .nav-menu {
            display: none;
            position: fixed;
            top: 74px;
            left: 0;
            right: 0;
            width: 100%;
            height: auto;
            max-height: calc(100vh - 74px);
            overflow-y: auto;
            flex-direction: column;
            align-items: stretch;
            padding: 0 0 12px;
            background: var(--primary);
            border-radius: 0;
            box-shadow: none;
            z-index: 10050;
        }

        .nav-menu.show {
            display: flex;
        }

        .nav-item {
            width: 100%;
            height: auto;
        }

        .nav-link {
            width: 100%;
            height: 50px;
            padding: 0 18px;
            justify-content: space-between;
            font-size: 12px;
            background: transparent;
            color: var(--white);
        }

        .nav-link:hover {
            background: transparent;
            color: var(--white);
        }

        .nav-link.nav-click-active {
            background: var(--yellow);
            color: var(--white);
        }

        .nav-item.home-active .nav-link {
            color: var(--yellow);
            background: transparent;
        }

        .nav-item.home-active .nav-link:hover {
            color: var(--yellow);
            background: transparent;
        }

        .nav-item.home-active::after {
            display: none;
        }

        /* PERBAIKAN RESET DROPDOWN UNTUK MOBILE */
        .dropdown {
            position: static;
            min-width: 100%;
            box-shadow: none;
            border-radius: 0;
            opacity: 1;
            visibility: visible;
            transform: none;
            display: none;
            padding: 5px 0;
            background: #ffffff;
        }

        .nav-item:hover .dropdown {
            display: none;
        }

        .nav-item.open .dropdown {
            display: block;
        }

        .dropdown a {
            padding: 12px 24px;
            font-size: 12px;
        }
    }

    @media (max-width: 768px) {
        .brand-logo {
            width: 52px;
            height: 52px;
        }

        .brand-unw {
            gap: 10px;
        }

        .brand-main {
            font-size: 31px;
        }

        .brand-school {
            font-size: 12px;
        }

        .brand-divider {
            height: 38px;
        }
    }

    @media (max-width: 640px) {
        .container {
            width: min(100% - 28px, 1120px);
        }

        .top-header {
            padding: 9px 70px 9px 0;
        }

        .brand-wrapper {
            justify-content: flex-start;
            gap: 9px;
        }

        .brand-logo {
            width: 46px;
            height: 46px;
        }

        .brand-unw {
            gap: 8px;
        }

        .brand-main {
            font-size: 28px;
        }

        .brand-sub {
            font-size: 6.5px;
        }

        .brand-divider {
            width: 1.5px;
            height: 34px;
        }

        .brand-school {
            font-size: 10px;
            white-space: normal;
        }

        .navbar {
            top: 9px;
            right: 14px;
        }

        .hamburger {
            width: 42px;
            height: 42px;
            gap: 6px;
        }

        .hamburger span {
            width: 26px;
            min-width: 26px;
            max-width: 26px;
            height: 3px;
            flex: 0 0 3px;
        }

        .nav-menu {
            top: 66px;
            max-height: calc(100vh - 66px);
        }
    }

    @media (max-width: 420px) {
        .brand-wrapper {
            align-items: center;
        }

        .brand-school,
        .brand-divider {
            display: none;
        }
    }
</style>

<div class="site-header" id="siteHeader">
    <header class="top-header">
        <div class="container">
            <div class="brand-wrapper">
                <img src="{{ asset('assets/images/logo-unw.png') }}" alt="Logo UNW" class="brand-logo">

                <div class="brand-unw">
                    <div>
                        <div class="brand-main">UNW</div>
                        <div class="brand-sub">
                            Universitas Ngudi Waluyo<br>
                            Pasca Sarjana
                        </div>
                    </div>

                    <div class="brand-divider"></div>

                    <div class="brand-school">
                        Postgraduate School<br>
                        Univcasarjana
                    </div>
                </div>
            </div>
        </div>
    </header>

    <nav class="navbar">
        <div class="container">
            <div class="nav-content">
                <button class="hamburger" id="hamburger" type="button" aria-label="Menu" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <ul class="nav-menu" id="navMenu">
                    <li class="nav-item home-active" id="homeNavItem">
                        <a href="{{ route('home') }}" class="nav-link" data-nav="home">Beranda</a>
                    </li>

                    <li class="nav-item has-dropdown">
                        <a href="#" class="nav-link dropdown-trigger">
                            <span>Profile</span>
                            <span class="chevron" aria-hidden="true"></span>
                        </a>
                        <div class="dropdown">
                            <a href="#">Tentang Pascasarjana</a>
                            <a href="{{ route('visi-misi') }}">Visi dan Misi</a>
                            <a href="#">Struktur Organisasi</a>
                        </div>
                    </li>

                    <li class="nav-item has-dropdown">
                        <a href="#" class="nav-link dropdown-trigger">
                            <span>Akademik</span>
                            <span class="chevron" aria-hidden="true"></span>
                        </a>
                        <div class="dropdown">
                            <a href="{{ route('akademik.show', 'magister-hukum') }}">Magister Hukum</a>
                            <a href="{{ route('akademik.show', 'magister-manajemen-pendidikan') }}">Magister Manajemen
                                Pendidikan</a>
                            <a href="{{ route('akademik.show', 'magister-kesehatan-masyarakat') }}">Magister Kesehatan
                                Masyarakat</a>
                            <a href="{{ route('akademik.show', 'magister-keperawatan') }}">Magister Keperawatan</a>
                        </div>
                    </li>

                    <li class="nav-item has-dropdown">
                        <a href="#" class="nav-link dropdown-trigger">
                            <span>Penjaminan Mutu</span>
                            <span class="chevron" aria-hidden="true"></span>
                        </a>
                        <div class="dropdown">
                            <a href="#">Dokumen SPMI</a>
                            <a href="#">Laporan AMI</a>
                            <a href="#">Penjaminan Digital</a>
                        </div>
                    </li>

                    <li class="nav-item has-dropdown">
                        <a href="#" class="nav-link dropdown-trigger">
                            <span>Riset & PDM</span>
                            <span class="chevron" aria-hidden="true"></span>
                        </a>
                        <div class="dropdown">
                            <a href="#">Riset Dosen</a>
                            <a href="#">Publikasi</a>
                            <a href="#">Pengabdian Masyarakat</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="#layanan-mahasiswa" class="nav-link" id="edomNav" data-nav="edom">Edom</a>
                    </li>

                    <li class="nav-item">
                        <a href="https://pmb.unw.ac.id/" class="nav-link">Admisi</a>
                    </li>

                    <li class="nav-item">
                        <a href="https://pmb.unw.ac.id/kontak" class="nav-link">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const siteHeader = document.getElementById('siteHeader');
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        const dropdownTriggers = document.querySelectorAll('.dropdown-trigger');
        const heroSlides = document.querySelectorAll('.hero-slide');
        let lastScrollY = window.scrollY;
        let lastHeroActive = document.querySelector('.hero-slide.active');
        let heroObserverLock = false;

        function isCompactMode() {
            return window.innerWidth <= 992 || siteHeader.classList.contains('nav-collapsed');
        }

        function closeNavMenu() {
            if (!navMenu || !hamburger) return;

            navMenu.classList.remove('show');
            hamburger.setAttribute('aria-expanded', 'false');
            document.querySelectorAll('.nav-item.has-dropdown').forEach((item) => {
                item.classList.remove('open');
            });
        }

        function normalizeHeroSlides() {
            heroSlides.forEach((slide) => {
                slide.classList.remove('slide-out-left', 'slide-ready-right', 'was-active');

                if (slide.classList.contains('active')) {
                    slide.classList.add('was-active');
                    lastHeroActive = slide;
                } else {
                    slide.classList.add('slide-ready-right');
                }
            });
        }

        function handleHeroChange() {
            if (heroObserverLock || !heroSlides.length) return;

            const currentActive = document.querySelector('.hero-slide.active');
            if (!currentActive || currentActive === lastHeroActive) return;

            heroObserverLock = true;

            heroSlides.forEach((slide) => {
                if (slide !== currentActive && slide !== lastHeroActive) {
                    slide.classList.remove('was-active', 'slide-out-left');
                    slide.classList.add('slide-ready-right');
                }
            });

            if (lastHeroActive && lastHeroActive !== currentActive) {
                lastHeroActive.classList.remove('slide-ready-right');
                lastHeroActive.classList.add('was-active', 'slide-out-left');
            }

            currentActive.classList.remove('slide-ready-right', 'slide-out-left');
            currentActive.classList.add('was-active');
            const oldActive = lastHeroActive;
            lastHeroActive = currentActive;

            setTimeout(() => {
                heroSlides.forEach((slide) => {
                    if (slide !== currentActive) {
                        slide.classList.remove('was-active', 'slide-out-left');
                        slide.classList.add('slide-ready-right');
                    }
                });
                heroObserverLock = false;
            }, 780);
        }

        if (heroSlides.length) {
            normalizeHeroSlides();

            const heroObserver = new MutationObserver(handleHeroChange);
            heroSlides.forEach((slide) => {
                heroObserver.observe(slide, {
                    attributes: true,
                    attributeFilter: ['class']
                });
            });
        }

        if (hamburger && navMenu) {
            hamburger.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopImmediatePropagation();
                navMenu.classList.toggle('show');
                hamburger.setAttribute('aria-expanded', navMenu.classList.contains('show') ? 'true' :
                    'false');
            }, true);
        }

        dropdownTriggers.forEach((trigger) => {
            trigger.addEventListener('click', function(event) {
                if (!isCompactMode()) return;

                event.preventDefault();
                event.stopImmediatePropagation();

                const currentItem = trigger.closest('.nav-item');

                document.querySelectorAll('.nav-item.has-dropdown').forEach((item) => {
                    if (item !== currentItem) {
                        item.classList.remove('open');
                    }
                });

                currentItem.classList.toggle('open');
            }, true);
        });

        document.addEventListener('click', function(event) {
            if (!navMenu || !hamburger || !isCompactMode()) return;

            if (!navMenu.contains(event.target) && !hamburger.contains(event.target)) {
                closeNavMenu();
            }
        });

        window.addEventListener('scroll', function() {
            if (!siteHeader || window.innerWidth <= 992) return;

            const currentScrollY = window.scrollY;

            if (currentScrollY > lastScrollY && currentScrollY > 120) {
                siteHeader.classList.add('nav-collapsed');
                closeNavMenu();
            } else if (currentScrollY < lastScrollY) {
                siteHeader.classList.remove('nav-collapsed');
                closeNavMenu();
            }

            lastScrollY = currentScrollY;
        });

        window.addEventListener('resize', function() {
            if (!siteHeader) return;

            if (window.innerWidth <= 992) {
                siteHeader.classList.remove('nav-collapsed');
            }

            closeNavMenu();
        });
    });
</script>
