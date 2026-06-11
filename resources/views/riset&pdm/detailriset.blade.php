<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $dosen->nama }} - Detail Profil & SINTA Dosen</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Konfigurasi Variabel Warna Sinkron dengan Berita (show.blade.php) */
        :root {
            --primary: #072b57;
            --primary-dark: #052044;
            --yellow: #f7b500;
            --white: #fff;
            --light: #f8fafc;
            --text: #111827;
            --muted: #64748b;
            --border: #e5e7eb;
        }

        html, body {
            margin: 0 !important;
            padding: 0 !important;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            background-color: var(--light);
            color: var(--text);
        }

        /* Hero Banner Utama ala show.blade.php */
        .profile-hero {
            background: linear-gradient(135deg, rgba(7, 43, 87, .98), rgba(5, 32, 68, .94));
            color: var(--white);
            padding: 54px 0 88px;
            position: relative;
            overflow: hidden;
        }

        .profile-hero:after {
            content: "";
            position: absolute;
            right: -120px;
            top: -120px;
            width: 340px;
            height: 340px;
            background: rgba(247, 181, 0, .06);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-container {
            width: min(100% - 40px, 1180px);
            margin: 0 auto;
        }

        /* Style Tombol Kembali Persis Seperti di Show */
        .btn-back {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--white) !important;
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .2);
            text-decoration: none;
            font-weight: 900;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 22px;
            padding: 11px 16px;
            border-radius: 999px;
            box-shadow: 0 12px 26px rgba(0,0,0,.14);
            transition: .25s ease;
            width: fit-content;
        }

        .btn-back:hover {
            transform: translateX(-4px);
            background: var(--yellow) !important;
            color: var(--primary) !important;
            border-color: var(--yellow);
        }

        .btn-back i {
            font-size: 14px;
        }

        /* Gaya Tag Profile */
        .profile-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .2);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            color: var(--yellow);
            text-transform: uppercase;
            margin-bottom: 16px;
            letter-spacing: 0.5px;
        }

        .profile-hero-title {
            font-size: clamp(22px, 4vw, 34px);
            font-weight: 800;
            margin: 0 0 16px;
            line-height: 1.25;
            letter-spacing: -0.5px;
        }

        /* Meta Info Banner */
        .profile-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            font-size: 13.5px;
            color: rgba(255, 255, 255, .8);
            font-weight: 500;
        }

        .profile-meta span {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .profile-meta i {
            color: var(--yellow);
            font-size: 14px;
        }

        /* Konten Utama Overlapping Layout */
        .profile-main-body {
            width: min(100% - 40px, 1180px);
            margin: -45px auto 60px;
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        /* Komponen Utama Card */
        .content-block {
            background: var(--white);
            border-radius: 12px;
            padding: 30px;
            border: 1px solid var(--border);
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
            box-sizing: border-box;
        }

        /* Grid Identitas Atas: Foto Kiri & Biodata Kanan */
        .identity-card-grid {
            display: grid;
            grid-template-columns: 190px 1fr;
            gap: 32px;
            align-items: start;
        }

        /* Bingkai Foto Profil */
        .profile-photo-frame {
            width: 100%;
            aspect-ratio: 3/4;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--border);
        }

        .profile-photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* SINTA Score Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 24px;
        }

        .stat-box {
            background: var(--light);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 14px;
            text-align: center;
            transition: border-color 0.2s ease;
        }
        
        .stat-box:hover {
            border-color: var(--primary);
        }

        .stat-number {
            font-size: 22px;
            font-weight: 800;
            color: var(--primary);
        }

        .stat-desc {
            font-size: 10px;
            color: var(--muted);
            font-weight: 700;
            text-transform: uppercase;
            margin-top: 4px;
            letter-spacing: 0.5px;
        }

        /* Heading Page Style ala Berita */
        .block-title {
            font-size: 16px;
            font-weight: 800;
            color: var(--primary);
            text-transform: uppercase;
            margin: 0 0 24px 0;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--yellow);
            display: inline-block;
            letter-spacing: 0.5px;
        }

        /* Tabel Biodata */
        .table-profile {
            width: 100%;
            border-collapse: collapse;
        }

        .table-profile td {
            padding: 12px 16px;
            font-size: 14px;
            border-bottom: 1px solid var(--border);
        }

        .table-profile tr:last-child td {
            border-bottom: none;
        }

        .table-profile td.label {
            font-weight: 700;
            color: var(--muted);
            width: 20%;
            background: var(--light);
        }

        .table-profile td.value {
            color: var(--text);
            font-weight: 600;
        }

        /* Tabs Navigation Segmented Bar */
        .tabs-container {
            display: flex;
            background: #e2e8f0;
            padding: 5px;
            border-radius: 10px;
            gap: 4px;
            overflow-x: auto;
        }

        .tab-btn {
            flex: 1;
            min-width: 120px;
            padding: 12px 14px;
            border: none;
            background: transparent;
            color: #475569;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 11.5px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border-radius: 8px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .tab-btn:hover {
            color: var(--primary);
            background: rgba(255, 255, 255, 0.4);
        }

        .tab-btn.active {
            background: var(--white);
            color: var(--primary);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        /* Tab Content Animation */
        .tab-content {
            display: none;
            animation: slideUpEffect 0.4s ease-out;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes slideUpEffect {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Grafik Panel Wrapper */
        .card-chart-wrapper {
            margin-bottom: 28px;
            background: var(--light);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 20px;
        }

        .chart-container {
            position: relative;
            height: 230px;
            width: 100%;
        }

        /* Desain Tabel Data Publikasi */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .table-data {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 13.5px;
        }

        .table-data th {
            background-color: var(--light);
            color: var(--muted);
            font-weight: 700;
            padding: 14px 16px;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--border);
        }

        .table-data td {
            padding: 16px;
            border-bottom: 1px solid var(--border);
            vertical-align: top;
            line-height: 1.6;
        }

        .table-data tr:last-child td {
            border-bottom: none;
        }

        .table-data tr:hover td {
            background-color: var(--light);
        }

        .pub-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .pub-link:hover {
            color: var(--yellow);
        }

        .badge-quartile {
            background: var(--yellow);
            color: var(--white);
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: 700;
            font-size: 10px;
        }

        .empty-text {
            font-size: 14px;
            color: var(--muted);
            font-style: italic;
            text-align: center;
            padding: 30px 0;
        }

        .tabs-container::-webkit-scrollbar { height: 4px; }
        .tabs-container::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

        /* Responsive Configuration */
        @media (max-width: 992px) {
            .identity-card-grid { grid-template-columns: 1fr; justify-items: center; }
            .profile-photo-frame { max-width: 170px; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .table-profile td.label { width: 30%; }
        }

        @media (max-width: 640px) {
            .table-profile td { display: block; width: 100% !important; box-sizing: border-box; }
            .table-profile td.label { background: transparent; padding-bottom: 2px; padding-top: 12px; }
            .table-profile td.value { padding-top: 2px; }
        }
    </style>
</head>

<body>

    @include('component.header')

    <div class="profile-hero">
        <div class="hero-container">
            <a href="{{ route('riset.dosen') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i><span>Kembali ke Daftar Dosen</span>
            </a>
            <br>
            <div class="profile-tag">
                <i class="fas fa-user-tie"></i> Profil Resmi Pascasarjana
            </div>
            <h1 class="profile-hero-title">{{ $dosen->nama }}</h1>
            <div class="profile-meta">
                <span><i class="fas fa-id-badge"></i> SINTA ID: <strong>{{ $dosen->sinta_id }}</strong></span>
                <span><i class="fas fa-graduation-cap"></i> {{ $dosen->program_studi }}</span>
                <span><i class="fas fa-university"></i> {{ $dosen->institusi ?? 'Universitas Ngudi Waluyo' }}</span>
            </div>
        </div>
    </div>

    <div class="profile-main-body">
        
        <div class="content-block identity-card-grid">
            <div class="profile-photo-frame">
                @if($dosen->profile_photo)
                    <img src="{{ asset('assets/images/' . $dosen->profile_photo) }}" alt="{{ $dosen->nama }}">
                @else
                    <img src="{{ asset('assets/images/default-user.png') }}" alt="{{ $dosen->nama }}">
                @endif
            </div>

            <div>
                <div class="stats-grid">
                    <div class="stat-box">
                        <div class="stat-number">{{ $dosen->sinta_score_overall ?? 0 }}</div>
                        <div class="stat-desc">Overall Score</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number">{{ $dosen->sinta_score_3yr ?? 0 }}</div>
                        <div class="stat-desc">3 Year Score</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number">{{ $dosen->affil_score ?? 0 }}</div>
                        <div class="stat-desc">Affil Score</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number">{{ $dosen->affil_score_3yr ?? 0 }}</div>
                        <div class="stat-desc">Affil 3Yr</div>
                    </div>
                </div>

                <h3 class="block-title">Biodata Akademik</h3>
                <table class="table-profile">
                    <tr>
                        <td class="label">Nama Lengkap</td>
                        <td class="value" style="color: var(--primary);">{{ $dosen->nama }}</td>
                    </tr>
                    <tr>
                        <td class="label">Program Studi</td>
                        <td class="value">{{ $dosen->program_studi }}</td>
                    </tr>
                    @if($dosen->bidang_minat)
                    <tr>
                        <td class="label">Bidang Minat</td>
                        <td class="value">{{ $dosen->bidang_minat }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>

        <div class="tabs-container">
            <button class="tab-btn active" onclick="switchTab(event, 'scopus')"><i class="fas fa-globe"></i> Scopus</button>
            <button class="tab-btn" onclick="switchTab(event, 'scholar')"><i class="fas fa-graduation-cap"></i> Scholar</button>
            <button class="tab-btn" onclick="switchTab(event, 'garuda')"><i class="fas fa-book-open"></i> Garuda</button>
            <button class="tab-btn" onclick="switchTab(event, 'research')"><i class="fas fa-search"></i> Penelitian</button>
            <button class="tab-btn" onclick="switchTab(event, 'service')"><i class="fas fa-hands-helping"></i> Pengabdian</button>
            <button class="tab-btn" onclick="switchTab(event, 'books')"><i class="fas fa-book"></i> Buku</button>
        </div>

        <div class="bottom-research-layout">

            <div id="scopus" class="tab-content active content-block">
                <h2 class="block-title">Publikasi Internasional Scopus</h2>
                <div class="card-chart-wrapper">
                    <div style="font-size: 12px; font-weight: 700; color: var(--muted); margin-bottom: 12px; text-align: center;">Perkembangan Grafik Publikasi Tahunan (Scopus)</div>
                    <div class="chart-container"><canvas id="scopusChart"></canvas></div>
                </div>
                <div class="table-responsive">
                    <table class="table-data">
                        <thead>
                            <tr>
                                <th style="width: 45px; text-align: center;">No</th>
                                <th>Artikel & Info Jurnal</th>
                                <th style="width: 120px; text-align: center;">Tahun / Q</th>
                                <th style="width: 80px; text-align: center;">Sitasi</th>
                                <th style="width: 90px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dosen->scopusPublications as $index => $scopus)
                                <tr>
                                    <td style="text-align: center; font-weight: 600;">{{ $index + 1 }}</td>
                                    <td>
                                        <div style="font-weight: 700; color: var(--text); margin-bottom: 2px;">{{ $scopus->judul }}</div>
                                        <div style="font-size: 11.5px; color: var(--muted); font-style: italic;">Jurnal: {{ $scopus->journal }}</div>
                                        <div style="font-size: 11px; color: var(--muted);">Penulis ke-{{ $scopus->author_order }} ({{ $scopus->creator ?? '-' }})</div>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style="font-weight: 600;">{{ $scopus->tahun }}</span>
                                        @if($scopus->quartile)<br><span class="badge-quartile" style="margin-top: 4px; display: inline-block;">{{ $scopus->quartile }}</span>@endif
                                    </td>
                                    <td style="text-align: center; font-weight: 700; color: var(--primary);">{{ $scopus->citation }}</td>
                                    <td style="text-align: center;">
                                        @if($scopus->url_artikel)<a href="{{ $scopus->url_artikel }}" target="_blank" class="pub-link"><i class="fas fa-external-link-alt"></i> Link</a>@else - @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="empty-text">Tidak ada data publikasi Scopus.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="scholar" class="tab-content content-block">
                <h2 class="block-title">Publikasi Google Scholar</h2>
                <div class="card-chart-wrapper">
                    <div style="font-size: 12px; font-weight: 700; color: var(--muted); margin-bottom: 12px; text-align: center;">Perkembangan Grafik Publikasi Tahunan (Google Scholar)</div>
                    <div class="chart-container"><canvas id="scholarChart"></canvas></div>
                </div>
                <div class="table-responsive">
                    <table class="table-data">
                        <thead>
                            <tr>
                                <th style="width: 45px; text-align: center;">No</th>
                                <th>Judul Dokumen & Sumber</th>
                                <th style="width: 80px; text-align: center;">Tahun</th>
                                <th style="width: 80px; text-align: center;">Sitasi</th>
                                <th style="width: 90px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dosen->scholarPublications as $index => $scholar)
                                <tr>
                                    <td style="text-align: center; font-weight: 600;">{{ $index + 1 }}</td>
                                    <td>
                                        <div style="font-weight: 700; color: var(--text); margin-bottom: 2px;">{{ $scholar->judul }}</div>
                                        <div style="font-size: 11.5px; color: var(--muted);">Penulis: {{ $scholar->authors }}</div>
                                        @if($scholar->source)<div style="font-size: 11px; color: var(--muted);">Sumber: {{ $scholar->source }}</div>@endif
                                    </td>
                                    <td style="text-align: center; font-weight: 600;">{{ $scholar->tahun }}</td>
                                    <td style="text-align: center; font-weight: 700; color: var(--primary);">{{ $scholar->citation }}</td>
                                    <td style="text-align: center;">
                                        @if($scholar->url_scholar)<a href="{{ $scholar->url_scholar }}" target="_blank" class="pub-link"><i class="fas fa-external-link-alt"></i> Link</a>@else - @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="empty-text">Tidak ada data publikasi Google Scholar.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="garuda" class="tab-content content-block">
                <h2 class="block-title">Publikasi Nasional Garuda</h2>
                <div class="card-chart-wrapper">
                    <div style="font-size: 12px; font-weight: 700; color: var(--muted); margin-bottom: 12px; text-align: center;">Perkembangan Grafik Publikasi Tahunan (Garuda)</div>
                    <div class="chart-container"><canvas id="garudaChart"></canvas></div>
                </div>
                <div class="table-responsive">
                    <table class="table-data">
                        <thead>
                            <tr>
                                <th style="width: 45px; text-align: center;">No</th>
                                <th>Judul Jurnal & Penerbit</th>
                                <th style="width: 80px; text-align: center;">Tahun</th>
                                <th style="width: 100px; text-align: center;">Akreditasi</th>
                                <th style="width: 90px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dosen->garudaPublications as $index => $garuda)
                                <tr>
                                    <td style="text-align: center; font-weight: 600;">{{ $index + 1 }}</td>
                                    <td>
                                        <div style="font-weight: 700; color: var(--text); margin-bottom: 2px;">{{ $garuda->judul }}</div>
                                        <div style="font-size: 11.5px; color: var(--muted);">Jurnal: {{ $garuda->journal }}</div>
                                        <div style="font-size: 11px; color: var(--muted);">Penerbit: {{ $garuda->publisher ?? '-' }}</div>
                                    </td>
                                    <td style="text-align: center; font-weight: 600;">{{ $garuda->tahun }}</td>
                                    <td style="text-align: center;">
                                        <span style="background: #e2e8f0; color: var(--primary); padding: 3px 8px; border-radius: 4px; font-weight: 700; font-size: 10.5px;">{{ $garuda->accreditation ?? '-' }}</span>
                                    </td>
                                    <td style="text-align: center;">
                                        @if($garuda->url_artikel)<a href="{{ $garuda->url_artikel }}" target="_blank" class="pub-link"><i class="fas fa-external-link-alt"></i> Link</a>@else - @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="empty-text">Tidak ada data publikasi Garuda.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="research" class="tab-content content-block">
                <h2 class="block-title">Histori Proyek Penelitian</h2>
                <div class="card-chart-wrapper">
                    <div style="font-size: 12px; font-weight: 700; color: var(--muted); margin-bottom: 12px; text-align: center;">Grafik Perkembangan Proyek Penelitian Pertahun</div>
                    <div class="chart-container"><canvas id="researchChart"></canvas></div>
                </div>
                <div class="table-responsive">
                    <table class="table-data">
                        <thead>
                            <tr>
                                <th style="width: 45px; text-align: center;">No</th>
                                <th>Judul Penelitian & Skema</th>
                                <th style="width: 80px; text-align: center;">Tahun</th>
                                <th>Pendanaan</th>
                                <th style="width: 100px; text-align: center;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dosen->researches as $index => $res)
                                <tr>
                                    <td style="text-align: center; font-weight: 600;">{{ $index + 1 }}</td>
                                    <td>
                                        <div style="font-weight: 700; color: var(--text); margin-bottom: 2px;">{{ $res->judul }}</div>
                                        <div style="font-size: 11.5px; color: var(--primary); font-weight: 600;">Skema: {{ $res->skema ?? '-' }}</div>
                                        <div style="font-size: 11px; color: var(--muted);">Ketua: {{ $res->leader }} | Personil: {{ $res->personils ?? '-' }}</div>
                                    </td>
                                    <td style="text-align: center; font-weight: 600;">{{ $res->tahun }}</td>
                                    <td><span style="color: #10b981; font-weight: 700;">{{ $res->dana ?? '-' }}</span></td>
                                    <td style="text-align: center;">
                                        <span style="background: #f0fdf4; color: #16a34a; padding: 3px 8px; border-radius: 4px; font-weight: 700; font-size: 11px;">{{ $res->status ?? 'Selesai' }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="empty-text">Tidak ada data histori penelitian.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="service" class="tab-content content-block">
                <h2 class="block-title">Histori Pengabdian Masyarakat</h2>
                <div class="card-chart-wrapper">
                    <div style="font-size: 12px; font-weight: 700; color: var(--muted); margin-bottom: 12px; text-align: center;">Grafik Perkembangan Proyek Pengabdian Pertahun</div>
                    <div class="chart-container"><canvas id="serviceChart"></canvas></div>
                </div>
                <div class="table-responsive">
                    <table class="table-data">
                        <thead>
                            <tr>
                                <th style="width: 45px; text-align: center;">No</th>
                                <th>Judul Pengabdian & Kegiatan</th>
                                <th style="width: 80px; text-align: center;">Tahun</th>
                                <th>Pendanaan</th>
                                <th style="width: 100px; text-align: center;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dosen->services as $index => $serv)
                                <tr>
                                    <td style="text-align: center; font-weight: 600;">{{ $index + 1 }}</td>
                                    <td>
                                        <div style="font-weight: 700; color: var(--text); margin-bottom: 2px;">{{ $serv->judul }}</div>
                                        <div style="font-size: 11.5px; color: var(--primary); font-weight: 600;">Skema: {{ $serv->skema ?? '-' }}</div>
                                        <div style="font-size: 11px; color: var(--muted);">Ketua: {{ $serv->leader }} | Personil: {{ $serv->personils ?? '-' }}</div>
                                    </td>
                                    <td style="text-align: center; font-weight: 600;">{{ $serv->tahun }}</td>
                                    <td><span style="color: #10b981; font-weight: 700;">{{ $serv->dana ?? '-' }}</span></td>
                                    <td style="text-align: center;">
                                        <span style="background: #f0fdf4; color: #16a34a; padding: 3px 8px; border-radius: 4px; font-weight: 700; font-size: 11px;">{{ $serv->status ?? 'Selesai' }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="empty-text">Tidak ada data histori pengabdian masyarakat.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="books" class="tab-content content-block">
                <h2 class="block-title">Buku Karya Dosen Terdaftar</h2>
                <div class="table-responsive">
                    <table class="table-data">
                        <thead>
                            <tr>
                                <th style="width: 45px; text-align: center;">No</th>
                                <th>Judul & Kategori Buku</th>
                                <th style="width: 80px; text-align: center;">Tahun</th>
                                <th>Penerbit</th>
                                <th style="width: 140px; text-align: center;">ISBN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dosen->books as $index => $book)
                                <tr>
                                    <td style="text-align: center; font-weight: 600;">{{ $index + 1 }}</td>
                                    <td>
                                        <div style="font-weight: 700; color: var(--text); margin-bottom: 4px;">{{ $book->judul }}</div>
                                        <span style="font-size: 10px; background: #fffbeb; color: #b45309; padding: 3px 6px; border-radius: 4px; font-weight: 600;">{{ $book->kategori ?? 'Umum' }}</span>
                                    </td>
                                    <td style="text-align: center; font-weight: 600;">{{ $book->tahun }}</td>
                                    <td>
                                        <div style="font-weight: 600; color: var(--text);">{{ $book->penerbit }}</div>
                                        <div style="font-size: 11px; color: var(--muted);">{{ $book->kota ?? '-' }}</div>
                                    </td>
                                    <td style="text-align: center; font-weight: 700; color: var(--muted); font-family: monospace; font-size: 12px;">{{ $book->isbn ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="empty-text">Tidak ada data buku terdaftar.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    @include('component.footer')

    <script>
        let activeCharts = {};

        const premiumAnimationConfig = {
            duration: 1200,
            easing: 'easeOutQuart',
            y: {
                from: 260,
                duration: 900
            }
        };

        function switchTab(evt, tabId) {
            const tabContents = document.getElementsByClassName("tab-content");
            for (let i = 0; i < tabContents.length; i++) {
                tabContents[i].classList.remove("active");
            }

            const tabBtns = document.getElementsByClassName("tab-btn");
            for (let i = 0; i < tabBtns.length; i++) {
                tabBtns[i].classList.remove("active");
            }

            document.getElementById(tabId).classList.add("active");
            evt.currentTarget.classList.add("active");

            initSpecificChart(tabId);
        }

        function initSpecificChart(tabId) {
            if(activeCharts[tabId]) {
                activeCharts[tabId].destroy();
            }

            if (tabId === 'scopus') {
                const ctx = document.getElementById('scopusChart');
                if(!ctx) return;
                activeCharts['scopus'] = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($dosen->scopusYearlyStats ? $dosen->scopusYearlyStats->pluck('tahun') : []) !!},
                        datasets: [{
                            label: 'Jumlah Publikasi',
                            data: {!! json_encode($dosen->scopusYearlyStats ? $dosen->scopusYearlyStats->pluck('jumlah') : []) !!},
                            borderColor: '#ef4444',
                            backgroundColor: 'rgba(239, 68, 68, 0.04)',
                            fill: true, tension: 0.3, borderWidth: 3, pointBackgroundColor: '#ef4444', pointRadius: 4
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, animation: premiumAnimationConfig }
                });
            } 
            else if (tabId === 'scholar') {
                const ctx = document.getElementById('scholarChart');
                if(!ctx) return;
                activeCharts['scholar'] = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($dosen->scholarYearlyStats ? $dosen->scholarYearlyStats->pluck('tahun') : []) !!},
                        datasets: [
                            {
                                label: 'Jumlah Publikasi',
                                data: {!! json_encode($dosen->scholarYearlyStats ? $dosen->scholarYearlyStats->pluck('publications') : []) !!},
                                borderColor: '#072b57',
                                backgroundColor: 'rgba(7, 43, 87, 0.04)',
                                fill: true, tension: 0.3, borderWidth: 3, pointBackgroundColor: '#072b57', pointRadius: 4
                            },
                            {
                                label: 'Jumlah Sitasi',
                                data: {!! json_encode($dosen->scholarYearlyStats ? $dosen->scholarYearlyStats->pluck('citations') : []) !!},
                                borderColor: '#f7b500',
                                backgroundColor: 'rgba(247, 181, 0, 0.04)',
                                fill: true, tension: 0.3, borderWidth: 3, pointBackgroundColor: '#f7b500', pointRadius: 4
                            }
                        ]
                    },
                    options: { responsive: true, maintainAspectRatio: false, animation: premiumAnimationConfig }
                });
            } 
            else if (tabId === 'garuda') {
                const ctx = document.getElementById('garudaChart');
                if(!ctx) return;
                activeCharts['garuda'] = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($dosen->garudaYearlyStats ? $dosen->garudaYearlyStats->pluck('tahun') : []) !!},
                        datasets: [{
                            label: 'Jumlah Artikel',
                            data: {!! json_encode($dosen->garudaYearlyStats ? $dosen->garudaYearlyStats->pluck('articles') : []) !!},
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.04)',
                            fill: true, tension: 0.3, borderWidth: 3, pointBackgroundColor: '#10b981', pointRadius: 4
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, animation: premiumAnimationConfig }
                });
            }
            else if (tabId === 'research') {
                const ctx = document.getElementById('researchChart');
                if(!ctx) return;
                activeCharts['research'] = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($dosen->researchYearlies ? $dosen->researchYearlies->pluck('tahun') : []) !!},
                        datasets: [{
                            label: 'Proyek Penelitian',
                            data: {!! json_encode($dosen->researchYearlies ? $dosen->researchYearlies->pluck('jumlah') : []) !!},
                            borderColor: '#3b82f6',
                            backgroundColor: 'rgba(59, 130, 246, 0.04)',
                            fill: true, tension: 0.3, borderWidth: 3, pointBackgroundColor: '#3b82f6', pointRadius: 4
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, animation: premiumAnimationConfig }
                });
            }
            else if (tabId === 'service') {
                const ctx = document.getElementById('serviceChart');
                if(!ctx) return;
                activeCharts['service'] = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($dosen->serviceYearlies ? $dosen->serviceYearlies->pluck('tahun') : []) !!},
                        datasets: [{
                            label: 'Proyek Pengabdian',
                            data: {!! json_encode($dosen->serviceYearlies ? $dosen->serviceYearlies->pluck('jumlah') : []) !!},
                            borderColor: '#f59e0b',
                            backgroundColor: 'rgba(245, 158, 11, 0.04)',
                            fill: true, tension: 0.3, borderWidth: 3, pointBackgroundColor: '#f59e0b', pointRadius: 4
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, animation: premiumAnimationConfig }
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            initSpecificChart('scopus');
        });
    </script>
</body>
</html>