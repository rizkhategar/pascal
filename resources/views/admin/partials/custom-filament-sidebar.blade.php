<aside class="admin-sidebar">
    <div class="admin-brand">Pascasarjana UNW</div>

    <nav class="admin-nav">
        <a href="/admin" class="admin-nav-link {{ ($activeMenu ?? '') === 'dashboard' ? 'active' : '' }}">
            <span class="admin-nav-icon">⌂</span>
            <span>Dashboard</span>
        </a>

        <div class="admin-nav-group">Beranda</div>
        <a href="/admin/home-hero-slides" class="admin-nav-link {{ ($activeMenu ?? '') === 'hero-campus' ? 'active' : '' }}">
            <span class="admin-nav-icon">▧</span>
            <span>Hero Campus</span>
        </a>

        <div class="admin-nav-group">Profil</div>
        <a href="/admin/tentang-pascasarjanas" class="admin-nav-link {{ ($activeMenu ?? '') === 'tentang' ? 'active' : '' }}">
            <span class="admin-nav-icon">ⓘ</span>
            <span>Tentang Pascasarjana</span>
        </a>
        <a href="/admin/visi-misis" class="admin-nav-link {{ ($activeMenu ?? '') === 'visi-misi' ? 'active' : '' }}">
            <span class="admin-nav-icon">□</span>
            <span>Visi & Misi</span>
        </a>
        <a href="/admin/struktur-organisasis" class="admin-nav-link {{ ($activeMenu ?? '') === 'struktur-organisasi' ? 'active' : '' }}">
            <span class="admin-nav-icon">▦</span>
            <span>Struktur Organisasi</span>
        </a>

        <div class="admin-nav-group">Akademik</div>
        <a href="/admin/academic-programs" class="admin-nav-link {{ ($activeMenu ?? '') === 'academic-programs' ? 'active' : '' }}">
            <span class="admin-nav-icon">▣</span>
            <span>Academic Programs</span>
        </a>
    </nav>
</aside>
