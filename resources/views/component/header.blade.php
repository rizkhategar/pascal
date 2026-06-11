@php
    $academicProgramsNav = \App\Http\Controllers\AcademicController::getNavigationData();
    $isHome = request()->routeIs('home');
    $isProfile = request()->routeIs('tentang') || request()->routeIs('visi-misi') || request()->routeIs('profil.*');
    $isAcademic = request()->routeIs('akademik.*');
    $isNews = request()->routeIs('news.*');
    $isResearch = request()->routeIs('riset.*');
    $isContact = request()->routeIs('contact.*');
@endphp

<link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
<link rel="shortcut icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">

<style>
    :root {
        --primary: #072b57;
        --primary-dark: #052044;
        --yellow: #f7b500;
        --white: #ffffff;
        --light: #eef4f5;
        --text: #111827;
    }

    .site-header {
        position: sticky;
        top: 0;
        width: 100%;
        z-index: 9999;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
    }

    .top-header {
        width: 100%;
        background: var(--light);
        padding: 12px 0;
    }

    .container {
        width: min(100% - 32px, 1120px);
        margin: 0 auto;
    }

    .brand-wrapper,
    .brand-unw {
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }

    .brand-wrapper {
        gap: 16px;
        width: 100%;
    }

    .brand-unw {
        gap: 14px;
        min-width: 0;
    }

    .brand-logo {
        width: 70px;
        height: 70px;
        object-fit: contain;
        flex-shrink: 0;
    }

    .brand-main {
        font-size: 44px;
        line-height: 1;
        font-weight: 900;
        color: var(--primary);
        letter-spacing: 1px;
    }

    .brand-sub {
        margin-top: 4px;
        font-size: 8px;
        line-height: 1.2;
        font-weight: 800;
        color: var(--primary);
        text-transform: uppercase;
    }

    .brand-divider {
        width: 2px;
        height: 46px;
        background: var(--primary);
        opacity: .75;
        flex-shrink: 0;
    }

    .brand-school {
        color: var(--primary);
        font-weight: 900;
        font-size: 16px;
        line-height: 1.25;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .navbar {
        background: var(--primary) !important;
        min-height: 64px;
        position: relative;
        z-index: 1000;
    }

    .nav-content {
        display: flex;
        align-items: stretch;
        min-height: 64px;
        position: relative;
        overflow: visible;
    }

    .nav-menu {
        display: flex;
        align-items: stretch;
        height: 64px;
        min-height: 64px;
        list-style: none;
        padding: 0;
        margin: 0;
        overflow: visible;
        background: transparent !important;
    }

    .nav-item {
        position: relative;
        height: 64px;
        display: flex;
        flex-direction: column;
        background: transparent !important;
    }

    .nav-link {
        height: 64px;
        padding: 0 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 800;
        color: var(--white) !important;
        text-transform: uppercase;
        text-decoration: none;
        transition: .25s ease;
        white-space: nowrap;
        border: none;
        background: transparent !important;
        cursor: pointer;
    }

    .nav-link:hover,
    .nav-link.nav-click-active,
    .nav-link.nav-route-active,
    .nav-item.route-active > .nav-link,
    .nav-item:hover > .nav-link,
    .nav-item.open > .nav-link {
        background: var(--yellow) !important;
        color: var(--white) !important;
    }

    .nav-item.route-active::after,
    .nav-item.home-active.route-active::after {
        content: "";
        position: absolute;
        left: 16px;
        right: 16px;
        bottom: 0;
        height: 5px;
        border-radius: 8px 8px 0 0;
        background: var(--yellow);
        pointer-events: none;
    }

    .nav-item:hover::after,
    .nav-item.open::after,
    .nav-item.home-active.hide-indicator::after {
        display: none !important;
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
        transition: transform .25s ease;
    }

    .nav-item:hover .chevron,
    .nav-item.open .chevron {
        transform: rotate(225deg) translateY(-1px);
    }

    .dropdown {
        position: absolute;
        top: 64px;
        left: 0;
        min-width: 255px;
        background: #ffffff !important;
        border-radius: 0 0 6px 6px;
        box-shadow: 0 8px 18px rgba(0, 0, 0, .18);
        padding: 8px 0;
        opacity: 0;
        visibility: hidden;
        transform: translateY(8px);
        transition: .25s ease;
        z-index: 99999;
    }

    .nav-item:hover .dropdown,
    .nav-item.open .dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown a {
        display: block;
        width: 100%;
        min-width: 255px;
        padding: 11px 18px;
        font-size: 12px;
        font-weight: 700;
        color: #111827 !important;
        text-decoration: none;
        transition: .2s ease;
        white-space: nowrap;
        background: #ffffff !important;
    }

    .dropdown a:hover,
    .dropdown a:focus,
    .dropdown a.dropdown-route-active {
        background: var(--yellow) !important;
        color: var(--white) !important;
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
    }

    .hamburger span {
        display: block;
        width: 28px;
        height: 3px;
        background: var(--primary);
        border-radius: 10px;
        margin: 0;
    }

    @media (min-width: 993px) {
        .site-header.nav-collapsed .navbar {
            position: absolute;
            top: 14px;
            right: 24px;
            width: auto;
            min-height: 0;
            background: transparent !important;
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
            background: var(--primary) !important;
        }

        .site-header.nav-collapsed .nav-menu.show { display: flex; }
        .site-header.nav-collapsed .nav-item { width: 100%; height: auto; }
        .site-header.nav-collapsed .nav-link { width: 100%; height: 48px; justify-content: space-between; }
        .site-header.nav-collapsed .nav-item::after { display: none !important; }
        .site-header.nav-collapsed .dropdown { position: static; min-width: 100%; box-shadow: none; padding: 5px 0; transform: none; opacity: 1; visibility: visible; display: none; }
        .site-header.nav-collapsed .nav-item:hover .dropdown { display: none; }
        .site-header.nav-collapsed .nav-item.open .dropdown { display: block; }
    }

    @media (max-width: 1200px) {
        .nav-link { padding: 0 10px; font-size: 11px; }
    }

    @media (max-width: 992px) {
        .site-header { background: var(--light); }
        .top-header { padding: 10px 74px 10px 0; }
        .brand-logo { width: 62px; height: 62px; }
        .brand-main { font-size: 34px; }
        .brand-school { font-size: 13px; }
        .navbar { position: absolute; top: 12px; right: 14px; width: auto; min-height: 0; background: transparent !important; box-shadow: none; }
        .navbar .container { width: auto; margin: 0; }
        .nav-content { min-height: 0; justify-content: flex-end; }
        .hamburger { display: flex; width: 46px; height: 46px; margin-left: 0; }
        .nav-menu { display: none; position: fixed; top: 82px; left: 0; right: 0; width: 100%; height: auto; max-height: calc(100vh - 82px); overflow-y: auto; flex-direction: column; align-items: stretch; padding: 0 0 12px; background: var(--primary) !important; z-index: 10050; }
        .nav-menu.show { display: flex; }
        .nav-item { width: 100%; height: auto; }
        .nav-link { width: 100%; height: 50px; padding: 0 18px; justify-content: space-between; font-size: 12px; }
        .nav-item::after { display: none !important; }
        .nav-item:hover .dropdown { display: none; }
        .nav-item.open .dropdown { display: block; }
        .dropdown { position: static; min-width: 100%; width: 100%; box-shadow: none; border-radius: 0; opacity: 1; visibility: visible; transform: none; display: none; padding: 5px 0; }
        .dropdown a { min-width: 100%; padding: 12px 24px; white-space: normal; }
    }

    @media (max-width: 640px) {
        .container { width: min(100% - 28px, 1120px); }
        .top-header { padding: 9px 70px 9px 0; }
        .brand-logo { width: 54px; height: 54px; }
        .brand-unw { gap: 8px; }
        .brand-main { font-size: 28px; }
        .brand-sub { font-size: 6.5px; }
        .brand-divider, .brand-school { display: none; }
        .navbar { top: 9px; right: 14px; }
        .hamburger { width: 42px; height: 42px; gap: 6px; }
        .hamburger span { width: 26px; }
        .nav-menu { top: 72px; max-height: calc(100vh - 72px); }
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
                        <div class="brand-sub">Universitas Ngudi Waluyo<br>Pasca Sarjana</div>
                    </div>
                    <div class="brand-divider"></div>
                    <div class="brand-school">Postgraduate School<br>Pascasarjana</div>
                </div>
            </div>
        </div>
    </header>

    <nav class="navbar">
        <div class="container">
            <div class="nav-content">
                <button class="hamburger" id="hamburger" type="button" aria-label="Menu" aria-expanded="false">
                    <span></span><span></span><span></span>
                </button>

                <ul class="nav-menu" id="navMenu">
                    <li class="nav-item home-active {{ $isHome ? 'route-active' : '' }}" id="homeNavItem">
                        <a href="{{ route('home') }}" class="nav-link {{ $isHome ? 'nav-route-active' : '' }}" data-nav="home">Beranda</a>
                    </li>

                    <li class="nav-item has-dropdown {{ $isProfile ? 'route-active' : '' }}">
                        <a href="#" class="nav-link dropdown-trigger {{ $isProfile ? 'nav-route-active' : '' }}"><span>Profil</span><span class="chevron" aria-hidden="true"></span></a>
                        <div class="dropdown">
                            <a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'dropdown-route-active' : '' }}">Tentang Pascasarjana</a>
                            <a href="{{ route('visi-misi') }}" class="{{ request()->routeIs('visi-misi') ? 'dropdown-route-active' : '' }}">Visi dan Misi</a>
                            <a href="{{ route('profil.struktur-organisasi') }}" class="{{ request()->routeIs('profil.struktur-organisasi') ? 'dropdown-route-active' : '' }}">Struktur Organisasi</a>
                        </div>
                    </li>

                    <li class="nav-item has-dropdown {{ $isAcademic ? 'route-active' : '' }}">
                        <a href="#" class="nav-link dropdown-trigger {{ $isAcademic ? 'nav-route-active' : '' }}"><span>Akademik</span><span class="chevron" aria-hidden="true"></span></a>
                        <div class="dropdown">
                            @forelse($academicProgramsNav as $program)
                                <a href="{{ route('akademik.show', $program['slug']) }}" class="{{ request()->is('akademik/' . $program['slug']) ? 'dropdown-route-active' : '' }}">{{ $program['display_name'] }}</a>
                            @empty
                                <a href="#">Data tidak tersedia</a>
                            @endforelse
                        </div>
                    </li>

                    <li class="nav-item {{ $isNews ? 'route-active' : '' }}">
                        <a href="{{ route('news.index') }}" class="nav-link {{ $isNews ? 'nav-route-active' : '' }}">Berita</a>
                    </li>

                    <li class="nav-item has-dropdown">
                        <a href="{{ route('riset.dosen') }}" class="nav-link dropdown-trigger">
                            <span>Riset Dosen</span>
                        </a>
                    </li>

                    <li class="nav-item"><a href="{{ route('home') }}#layanan-mahasiswa" class="nav-link" id="edomNav" data-nav="edom">Edom</a></li>
                    <li class="nav-item"><a href="https://pmb.unw.ac.id/" class="nav-link">Admisi</a></li>
                    <li class="nav-item {{ $isContact ? 'route-active' : '' }}"><a href="{{ route('contact.index') }}" class="nav-link {{ $isContact ? 'nav-route-active' : '' }}">Kontak</a></li>
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
        const navLinks = document.querySelectorAll('.nav-link');
        let lastScrollY = window.scrollY;

        function isCompactMode() {
            return window.innerWidth <= 992 || siteHeader.classList.contains('nav-collapsed');
        }

        function closeNavMenu() {
            if (!navMenu || !hamburger) return;
            navMenu.classList.remove('show');
            hamburger.setAttribute('aria-expanded', 'false');
            document.querySelectorAll('.nav-item.has-dropdown').forEach((item) => item.classList.remove('open'));
        }

        navLinks.forEach((link) => {
            link.addEventListener('click', function() {
                navLinks.forEach((item) => item.classList.remove('nav-click-active'));
                link.classList.add('nav-click-active');
            });
        });

        if (hamburger && navMenu) {
            hamburger.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopImmediatePropagation();
                navMenu.classList.toggle('show');
                hamburger.setAttribute('aria-expanded', navMenu.classList.contains('show') ? 'true' : 'false');
            }, true);
        }

        dropdownTriggers.forEach((trigger) => {
            trigger.addEventListener('click', function(event) {
                if (!isCompactMode()) return;
                event.preventDefault();
                event.stopImmediatePropagation();
                const currentItem = trigger.closest('.nav-item');
                document.querySelectorAll('.nav-item.has-dropdown').forEach((item) => {
                    if (item !== currentItem) item.classList.remove('open');
                });
                currentItem.classList.toggle('open');
            }, true);
        });

        document.addEventListener('click', function(event) {
            if (!navMenu || !hamburger || !isCompactMode()) return;
            if (!navMenu.contains(event.target) && !hamburger.contains(event.target)) closeNavMenu();
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
            if (window.innerWidth <= 992) siteHeader.classList.remove('nav-collapsed');
            closeNavMenu();
        });
    });
</script>
