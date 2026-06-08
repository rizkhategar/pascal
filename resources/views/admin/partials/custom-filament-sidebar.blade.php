<aside class="admin-sidebar">
    <div class="admin-brand">
        <img src="{{ asset('logo_unwnobg.png') }}" alt="Logo" class="admin-brand-logo">
        <span>Pascasarjana UNW</span>
    </div>

    <nav class="admin-nav">
        <a href="/admin" class="admin-nav-link {{ ($activeMenu ?? '') === 'dashboard' ? 'active' : '' }}">
            <span class="admin-nav-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 11.5 12 4l9 7.5M5 10v10h14V10M9 20v-6h6v6" />
                </svg>
            </span>
            <span>Dashboard</span>
        </a>

        <div class="admin-nav-group">Beranda</div>
        <a href="/admin/home-hero-slides" class="admin-nav-link {{ ($activeMenu ?? '') === 'hero-campus' ? 'active' : '' }}">
            <span class="admin-nav-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5A2.5 2.5 0 0 1 5.5 5h13A2.5 2.5 0 0 1 21 7.5v9A2.5 2.5 0 0 1 18.5 19h-13A2.5 2.5 0 0 1 3 16.5v-9Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4 16 4.5-4.5a2 2 0 0 1 2.8 0L15 15m-1.5-1.5 1.2-1.2a2 2 0 0 1 2.8 0L20 14.8M8 8.5h.01" />
                </svg>
            </span>
            <span>Hero Campus</span>
        </a>

        <div class="admin-nav-group">Profil</div>
        <a href="/admin/tentang-pascasarjanas" class="admin-nav-link {{ ($activeMenu ?? '') === 'tentang' ? 'active' : '' }}">
            <span class="admin-nav-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 17v-5m0-4h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </span>
            <span>Tentang Pascasarjana</span>
        </a>
        <a href="/admin/visi-misis" class="admin-nav-link {{ ($activeMenu ?? '') === 'visi-misi' ? 'active' : '' }}">
            <span class="admin-nav-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h10M8 12h10M8 18h10M4 6h.01M4 12h.01M4 18h.01" />
                </svg>
            </span>
            <span>Visi & Misi</span>
        </a>
        <a href="/admin/struktur-organisasis" class="admin-nav-link {{ ($activeMenu ?? '') === 'struktur-organisasi' ? 'active' : '' }}">
            <span class="admin-nav-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 20h16M6 20V8l6-4 6 4v12M9 20v-6h6v6M9 10h.01M12 10h.01M15 10h.01" />
                </svg>
            </span>
            <span>Struktur Organisasi</span>
        </a>

        <div class="admin-nav-group">Akademik</div>
        <a href="/admin/academic-programs" class="admin-nav-link {{ ($activeMenu ?? '') === 'academic-programs' ? 'active' : '' }}">
            <span class="admin-nav-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6.5A2.5 2.5 0 0 1 6.5 4H20v15H6.5A2.5 2.5 0 0 1 4 16.5v-10Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 8h8M8 12h8M8 16h5" />
                </svg>
            </span>
            <span>Academic Programs</span>
        </a>
    </nav>
</aside>
