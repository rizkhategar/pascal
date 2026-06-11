<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Riset & Publikasi Dosen - Pascasarjana UNW</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Base Setup & Gaya Global Pascasarjana UNW */
        html, body {
            margin: 0 !important;
            padding: 0 !important;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            background: #f1f6f7;
            color: #111827;
        }

        .rd-detail-wrapper {
            flex: 1 0 auto;
            width: min(1120px, 92%);
            margin: 40px auto;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        /* Tombol Kembali */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #072b57;
            font-weight: 700;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
            width: fit-content;
        }
        .btn-back:hover {
            color: #f7b500;
        }

        /* Profil Card Utama Dosen */
        .profile-card {
            background: #ffffff;
            border-radius: 8px;
            padding: 30px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            display: flex;
            gap: 30px;
            align-items: flex-start;
        }

        .profile-photo-frame {
            width: 140px;
            height: 180px;
            overflow: hidden;
            border-radius: 6px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            flex-shrink: 0;
        }

        .profile-photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info {
            flex: 1;
        }

        .profile-info h1 {
            margin: 0 0 6px 0;
            font-size: 24px;
            font-weight: 800;
            color: #072b57;
        }

        .profile-meta {
            font-size: 14px;
            color: #6b7280;
            font-weight: 500;
            margin-bottom: 4px;
        }
        .profile-meta strong {
            color: #111827;
        }

        .profile-department {
            display: inline-block;
            margin-top: 8px;
            font-size: 12px;
            color: #78927a;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Grid Kotak Skor Sinta */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-top: 20px;
        }

        .stat-box {
            background: #f1f6f7;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 15px;
            text-align: center;
        }

        .stat-number {
            font-size: 22px;
            font-weight: 800;
            color: #072b57;
        }

        .stat-desc {
            font-size: 11px;
            color: #6b7280;
            font-weight: 700;
            text-transform: uppercase;
            margin-top: 4px;
            letter-spacing: 0.3px;
        }

        /* Layout Dua Kolom: Diagram & Data Tabular */
        .detail-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }

        /* Komponen Blok Visual/Card */
        .content-block {
            background: #ffffff;
            border-radius: 8px;
            padding: 24px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .block-title {
            font-size: 16px;
            font-weight: 800;
            color: #072b57;
            text-transform: uppercase;
            margin: 0 0 20px 0;
            padding-bottom: 10px;
            border-bottom: 2px solid #072b57;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .block-title i {
            color: #f7b500;
        }

        /* Gaya Container Grafik Diagram */
        .charts-section-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }

        .chart-container {
            position: relative;
            height: 260px;
            width: 100%;
        }

        /* List Publikasi / Tabel Data Rapi */
        .publication-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
            max-height: 400px;
            overflow-y: auto;
            padding-right: 5px;
        }

        .publication-list::-webkit-scrollbar {
            width: 6px;
        }
        .publication-list::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 10px;
        }

        .pub-item {
            padding: 16px;
            border-radius: 6px;
            background: #f8fafc;
            border-left: 4px solid #072b57;
            border-top: 1px solid #e2e8f0;
            border-right: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }

        .pub-title {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
            line-height: 1.4;
            margin-bottom: 6px;
        }

        .pub-authors {
            font-size: 12px;
            color: #4b5563;
            margin-bottom: 4px;
        }

        .pub-meta {
            font-size: 11px;
            color: #9ca3af;
            font-weight: 600;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .pub-meta span i {
            margin-right: 4px;
        }

        .pub-link {
            color: #072b57;
            text-decoration: none;
            font-weight: 700;
        }
        .pub-link:hover {
            color: #f7b500;
        }

        .badge-quartile {
            background: #f7b500;
            color: white;
            padding: 1px 6px;
            border-radius: 3px;
            font-weight: 700;
        }

        .empty-text {
            font-size: 13px;
            color: #9ca3af;
            font-style: italic;
            text-align: center;
            padding: 20px 0;
        }

        /* Responsif Screen */
        @media (max-width: 768px) {
            .profile-card {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                width: 100%;
            }
            .charts-section-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    @include('component.header')

    <div class="rd-detail-wrapper">
        
        <a href="{{ route('riset.dosen') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Dosen
        </a>

        <section class="profile-card">
            <div class="profile-photo-frame">
                @if($dosen->profile_photo)
                    <img src="{{ asset('assets/images/' . $dosen->profile_photo) }}" alt="{{ $dosen->nama }}">
                @else
                    <img src="{{ asset('assets/images/default-user.png') }}" alt="{{ $dosen->nama }}">
                @endif
            </div>
            
            <div class="profile-info">
                <h1>{{ $dosen->nama }}</h1>
                <div class="profile-meta">Institusi: <strong>{{ $dosen->institusi ?? 'Universitas Ngudi Waluyo' }}</strong></div>
                <div class="profile-meta">Program Studi Asal: <strong>{{ $dosen->program_studi }}</strong></div>
                <div class="profile-meta">SINTA ID: <strong>{{ $dosen->sinta_id }}</strong></div>
                @if($dosen->bidang_minat)
                    <div class="profile-meta">Bidang Minat: <strong>{{ $dosen->bidang_minat }}</strong></div>
                @endif
                
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
            </div>
        </section>

        <section class="content-block">
            <h2 class="block-title"><i class="fas fa-chart-line"></i> Grafik Perkembangan Publikasi Tahunan</h2>
            <div class="charts-section-grid">
                
                <div>
                    <h3 style="font-size: 13px; text-align: center; margin-bottom: 10px; color: #4b5563;">Google Scholar Stats</h3>
                    <div class="chart-container">
                        <canvas id="scholarChart"></canvas>
                    </div>
                </div>

                <div>
                    <h3 style="font-size: 13px; text-align: center; margin-bottom: 10px; color: #4b5563;">Scopus Stats</h3>
                    <div class="chart-container">
                        <canvas id="scopusChart"></canvas>
                    </div>
                </div>

                <div>
                    <h3 style="font-size: 13px; text-align: center; margin-bottom: 10px; color: #4b5563;">Garuda Stats</h3>
                    <div class="chart-container">
                        <canvas id="garudaChart"></canvas>
                    </div>
                </div>

            </div>
        </section>

        <div class="detail-layout">
            
            <section class="content-block">
                <h2 class="block-title"><i class="fas fa-globe"></i> Publikasi Scopus</h2>
                <div class="publication-list">
                    @forelse($dosen->scopusPublications as $scopus)
                        <div class="pub-item">
                            <div class="pub-title">{{ $scopus->judul }}</div>
                            <div class="pub-authors">Creator/Penulis: {{ $scopus->creator ?? '-' }} (Urutan: {{ $scopus->author_order }})</div>
                            <div class="pub-meta">
                                <span><i class="fas fa-calendar-alt"></i> {{ $scopus->tahun }}</span>
                                <span><i class="fas fa-bookmark"></i> Jurnal: {{ $scopus->journal }}</span>
                                @if($scopus->quartile)
                                    <span><i class="fas fa-award"></i> Quartile: <span class="badge-quartile">{{ $scopus->quartile }}</span></span>
                                @endif
                                <span><i class="fas fa-quote-right"></i> Sitasi: {{ $scopus->citation }}</span>
                                @if($scopus->url_artikel)
                                    <span><i class="fas fa-external-link-alt"></i> <a href="{{ $scopus->url_artikel }}" target="_blank" class="pub-link">Lihat Artikel</a></span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="empty-text">Tidak ada data publikasi Scopus.</div>
                    @endforelse
                </div>
            </section>

            <section class="content-block">
                <h2 class="block-title"><i class="fas fa-graduation-cap"></i> Publikasi Google Scholar</h2>
                <div class="publication-list">
                    @forelse($dosen->scholarPublications as $scholar)
                        <div class="pub-item">
                            <div class="pub-title">{{ $scholar->judul }}</div>
                            <div class="pub-authors">Penulis: {{ $scholar->authors }}</div>
                            <div class="pub-meta">
                                <span><i class="fas fa-calendar-alt"></i> {{ $scholar->tahun }}</span>
                                <span><i class="fas fa-book"></i> Sumber: {{ $scholar->source }}</span>
                                <span><i class="fas fa-quote-right"></i> Sitasi: {{ $scholar->citation }}</span>
                                @if($scholar->url_scholar)
                                    <span><i class="fas fa-external-link-alt"></i> <a href="{{ $scholar->url_scholar }}" target="_blank" class="pub-link">Lihat Scholar</a></span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="empty-text">Tidak ada data publikasi Google Scholar.</div>
                    @endforelse
                </div>
            </section>

            <section class="content-block">
                <h2 class="block-title"><i class="fas fa-book-open"></i> Publikasi Garuda</h2>
                <div class="publication-list">
                    @forelse($dosen->garudaPublications as $garuda)
                        <div class="pub-item">
                            <div class="pub-title">{{ $garuda->judul }}</div>
                            <div class="pub-authors">Penulis: {{ $garuda->authors ?? $dosen->nama }} (Urutan: {{ $garuda->author_order }})</div>
                            <div class="pub-meta">
                                <span><i class="fas fa-calendar-alt"></i> {{ $garuda->tahun }}</span>
                                <span><i class="fas fa-journal-whills"></i> Jurnal: {{ $garuda->journal }}</span>
                                <span><i class="fas fa-building"></i> Penerbit: {{ $garuda->publisher }}</span>
                                <span><i class="fas fa-certificate"></i> Akreditasi: {{ $garuda->accreditation }}</span>
                                @if($garuda->url_artikel)
                                    <span><i class="fas fa-external-link-alt"></i> <a href="{{ $garuda->url_artikel }}" target="_blank" class="pub-link">Lihat Artikel</a></span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="empty-text">Tidak ada data publikasi Garuda.</div>
                    @endforelse
                </div>
            </section>

            <section class="content-block">
                <h2 class="block-title"><i class="fas fa-book"></i> Buku Resmi Terdaftar</h2>
                <div class="publication-list">
                    @forelse($dosen->books as $book)
                        <div class="pub-item" style="border-left-color: #f7b500;">
                            <div class="pub-title">{{ $book->judul }}</div>
                            <div class="pub-authors">Penulis: {{ $book->penulis }}</div>
                            <div class="pub-meta">
                                <span><i class="fas fa-calendar-alt"></i> Tahun: {{ $book->tahun }}</span>
                                <span><i class="fas fa-tags"></i> Kategori: {{ $book->kategori }}</span>
                                <span><i class="fas fa-print"></i> Penerbit: {{ $book->penerbit }} ({{ $book->kota ?? '-' }})</span>
                                <span><i class="fas fa-barcode"></i> ISBN: {{ $book->isbn }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="empty-text">Tidak ada data buku terdaftar.</div>
                    @endforelse
                </div>
            </section>

        </div>
    </div>

    @include('component.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // --- 1. SETUP DATA GOOGLE SCHOLAR ---
            const scholarLabels = {!! json_encode($dosen->scholarYearlyStats->pluck('tahun')) !!};
            const scholarData = {!! json_encode($dosen->scholarYearlyStats->pluck('publications')) !!};
            
            new Chart(document.getElementById('scholarChart'), {
                type: 'line',
                data: {
                    labels: scholarLabels,
                    datasets: [{
                        label: 'Jumlah Publikasi',
                        data: scholarData,
                        borderColor: '#072b57',
                        backgroundColor: 'rgba(7, 43, 87, 0.25)', // Fill Color Biru UNW
                        fill: true,
                        tension: 0.3,
                        borderWidth: 2,
                        pointBackgroundColor: '#072b57'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
                }
            });

            // --- 2. SETUP DATA SCOPUS ---
            const scopusLabels = {!! json_encode($dosen->scopusYearlyStats->pluck('tahun')) !!};
            const scopusData = {!! json_encode($dosen->scopusYearlyStats->pluck('jumlah')) !!};
            
            new Chart(document.getElementById('scopusChart'), {
                type: 'line',
                data: {
                    labels: scopusLabels,
                    datasets: [{
                        label: 'Jumlah Publikasi',
                        data: scopusData,
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.25)', // Fill Color Merah
                        fill: true,
                        tension: 0.3,
                        borderWidth: 2,
                        pointBackgroundColor: '#ef4444'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
                }
            });

            // --- 3. SETUP DATA GARUDA ---
            const garudaLabels = {!! json_encode($dosen->garudaYearlyStats->pluck('tahun')) !!};
            const garudaData = {!! json_encode($dosen->garudaYearlyStats->pluck('articles')) !!};
            
            new Chart(document.getElementById('garudaChart'), {
                type: 'line',
                data: {
                    labels: garudaLabels,
                    datasets: [{
                        label: 'Jumlah Artikel',
                        data: garudaData,
                        borderColor: '#78927a',
                        backgroundColor: 'rgba(120, 146, 122, 0.25)', // Fill Color Hijau Tema Home
                        fill: true,
                        tension: 0.3,
                        borderWidth: 2,
                        pointBackgroundColor: '#78927a'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
                }
            });

        });
    </script>
</body>
</html>