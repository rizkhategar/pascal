<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Profil & SINTA Dosen - Pascasarjana UNW</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
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
            gap: 25px;
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
            margin-bottom: 5px;
        }
        .btn-back:hover {
            color: #f7b500;
        }

        /* ==========================================
           TATA LETAK BARU (STRUKTUR LAYOUT ATAS & BAWAH)
           ========================================== */
        
        /* Tata Letak Atas: Foto (Kiri) vs Sinta & Biodata (Kanan) */
        .top-profile-layout {
            display: grid;
            grid-template-columns: 220px 1fr; /* Kolom foto lebih ringkas, kolom data dominan */
            gap: 25px;
            align-items: flex-start;
        }

        .photo-sidebar {
            display: flex;
            flex-direction: column;
        }

        .profile-info-details {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Tata Letak Bawah: Riset Mengular ke Bawah Full Lebar */
        .bottom-research-layout {
            display: flex;
            flex-direction: column;
            gap: 25px;
            width: 100%;
        }

        /* Komponen Card Blok Utama */
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

        /* Frame Komponen Foto Profil Kiri */
        .photo-card {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .profile-photo-frame {
            width: 100%;
            aspect-ratio: 3/4;
            max-width: 170px;
            overflow: hidden;
            border-radius: 6px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .profile-photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Grid Kotak Skor SINTA Kanan Atas */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        .stat-box {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 12px;
            text-align: center;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
        }

        .stat-number {
            font-size: 20px;
            font-weight: 800;
            color: #072b57;
        }

        .stat-desc {
            font-size: 10px;
            color: #6b7280;
            font-weight: 700;
            text-transform: uppercase;
            margin-top: 4px;
            letter-spacing: 0.3px;
        }

        /* Desain Tabel Detail Profil Dosen */
        .table-profile {
            width: 100%;
            border-collapse: collapse;
        }

        .table-profile td {
            padding: 12px 15px;
            font-size: 14px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        .table-profile tr:last-child td {
            border-bottom: none;
        }

        .table-profile td.label {
            font-weight: 700;
            color: #4b5563;
            width: 25%;
            background: #f9fafb;
        }

        .table-profile td.value {
            color: #111827;
            font-weight: 500;
        }

        /* Pembungkus Grafik didalam Card */
        .card-chart-wrapper {
            margin-bottom: 25px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 15px;
        }

        .chart-container {
            position: relative;
            height: 180px;
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
            font-size: 13px;
        }

        .table-data th {
            background-color: #072b57;
            color: #ffffff;
            font-weight: 700;
            padding: 12px;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
        }

        .table-data td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
            line-height: 1.5;
        }

        .table-data tr:hover td {
            background-color: #f8fafc;
        }

        .pub-link {
            color: #072b57;
            text-decoration: none;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .pub-link:hover {
            color: #f7b500;
        }

        .badge-quartile {
            background: #f7b500;
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 700;
            font-size: 10px;
        }

        .empty-text {
            font-size: 13px;
            color: #9ca3af;
            font-style: italic;
            text-align: center;
            padding: 20px 0;
        }

        /* Responsive Breakpoints */
        @media (max-width: 992px) {
            .top-profile-layout {
                grid-template-columns: 1fr;
            }
            .photo-card {
                max-width: 100%;
            }
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .table-profile td {
                display: block;
                width: 100% !important;
                box-sizing: border-box;
            }
            .table-profile td.label {
                background: transparent;
                padding-bottom: 2px;
            }
            .table-profile td.value {
                padding-top: 2px;
                font-weight: 600;
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

        <div class="top-profile-layout">
            
            <div class="photo-sidebar">
                <div class="content-block photo-card">
                    <div class="profile-photo-frame">
                        @if($dosen->profile_photo)
                            <img src="{{ asset('assets/images/' . $dosen->profile_photo) }}" alt="{{ $dosen->nama }}">
                        @else
                            <img src="{{ asset('assets/images/default-user.png') }}" alt="{{ $dosen->nama }}">
                        @endif
                    </div>
                </div>
            </div>

            <div class="profile-info-details">
                
                <div class="content-block">
                    <h3 class="block-title" style="font-size: 14px; margin-bottom: 15px;"><i class="fas fa-star"></i> SINTA Score Overview</h3>
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

                <div class="content-block">
                    <h3 class="block-title" style="font-size: 14px; margin-bottom: 15px;"><i class="fas fa-id-card"></i> Biodata Resmi Dosen</h3>
                    <table class="table-profile">
                        <tr>
                            <td class="label">Nama Lengkap</td>
                            <td class="value" style="font-weight: 700; color: #072b57; font-size: 16px;">{{ $dosen->nama }}</td>
                        </tr>
                        <tr>
                            <td class="label">SINTA ID</td>
                            <td class="value"><strong>{{ $dosen->sinta_id }}</strong></td>
                        </tr>
                        <tr>
                            <td class="label">Institusi</td>
                            <td class="value">{{ $dosen->institusi ?? 'Universitas Ngudi Waluyo' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Program Studi</td>
                            <td class="value">{{ $dosen->program_studi }}</td>
                        </tr>
                        @if(isset($dosen->jurusan))
                        <tr>
                            <td class="label">Jurusan</td>
                            <td class="value">{{ $dosen->jurusan }}</td>
                        </tr>
                        @endif
                        @if($dosen->bidang_minat)
                        <tr>
                            <td class="label">Bidang Minat</td>
                            <td class="value">{{ $dosen->bidang_minat }}</td>
                        </tr>
                        @endif
                    </table>
                </div>

            </div>

        </div>


        <div class="bottom-research-layout">
            
            <div class="content-block">
                <h2 class="block-title"><i class="fas fa-globe"></i> Publikasi Scopus</h2>
                
                <div class="card-chart-wrapper">
                    <div style="font-size: 12px; font-weight: 700; color: #4b5563; margin-bottom: 8px; text-align: center;">Perkembangan Tahunan (Scopus)</div>
                    <div class="chart-container">
                        <canvas id="scopusChart"></canvas>
                    </div>
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
                                        <div style="font-weight: 700; color: #111827; margin-bottom: 2px;">{{ $scopus->judul }}</div>
                                        <div style="font-size: 11px; color: #4b5563; font-style: italic;">Jurnal: {{ $scopus->journal }}</div>
                                        <div style="font-size: 11px; color: #6b7280;">Penulis ke-{{ $scopus->author_order }} ({{ $scopus->creator ?? '-' }})</div>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style="font-weight: 600;">{{ $scopus->tahun }}</span>
                                        @if($scopus->quartile)
                                            <br><span class="badge-quartile" style="margin-top: 4px; display: inline-block;">{{ $scopus->quartile }}</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center; font-weight: 700; color: #072b57;">{{ $scopus->citation }}</td>
                                    <td style="text-align: center;">
                                        @if($scopus->url_artikel)
                                            <a href="{{ $scopus->url_artikel }}" target="_blank" class="pub-link"><i class="fas fa-external-link-alt"></i> Link</a>
                                        @else - @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="empty-text">Tidak ada data publikasi Scopus.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="content-block">
                <h2 class="block-title"><i class="fas fa-graduation-cap"></i> Publikasi Google Scholar</h2>
                
                <div class="card-chart-wrapper">
                    <div style="font-size: 12px; font-weight: 700; color: #4b5563; margin-bottom: 8px; text-align: center;">Perkembangan Tahunan (Google Scholar)</div>
                    <div class="chart-container">
                        <canvas id="scholarChart"></canvas>
                    </div>
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
                                        <div style="font-weight: 700; color: #111827; margin-bottom: 2px;">{{ $scholar->judul }}</div>
                                        <div style="font-size: 11px; color: #4b5563;">Penulis: {{ $scholar->authors }}</div>
                                        @if($scholar->source)<div style="font-size: 11px; color: #6b7280;">Sumber: {{ $scholar->source }}</div>@endif
                                    </td>
                                    <td style="text-align: center; font-weight: 600;">{{ $scholar->tahun }}</td>
                                    <td style="text-align: center; font-weight: 700; color: #072b57;">{{ $scholar->citation }}</td>
                                    <td style="text-align: center;">
                                        @if($scholar->url_scholar)
                                            <a href="{{ $scholar->url_scholar }}" target="_blank" class="pub-link"><i class="fas fa-external-link-alt"></i> Link</a>
                                        @else - @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="empty-text">Tidak ada data publikasi Google Scholar.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="content-block">
                <h2 class="block-title"><i class="fas fa-book-open"></i> Publikasi Garuda</h2>
                
                <div class="card-chart-wrapper">
                    <div style="font-size: 12px; font-weight: 700; color: #4b5563; margin-bottom: 8px; text-align: center;">Perkembangan Tahunan (Garuda)</div>
                    <div class="chart-container">
                        <canvas id="garudaChart"></canvas>
                    </div>
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
                                        <div style="font-weight: 700; color: #111827; margin-bottom: 2px;">{{ $garuda->judul }}</div>
                                        <div style="font-size: 11px; color: #4b5563;">Jurnal: {{ $garuda->journal }}</div>
                                        <div style="font-size: 11px; color: #6b7280;">Penerbit: {{ $garuda->publisher ?? '-' }}</div>
                                    </td>
                                    <td style="text-align: center; font-weight: 600;">{{ $garuda->tahun }}</td>
                                    <td style="text-align: center;">
                                        <span style="background: #eef4f5; color: #072b57; padding: 2px 6px; border-radius: 4px; font-weight: 700; font-size: 10px;">
                                                {{ $garuda->accreditation ?? '-' }}
                                        </span>
                                    </td>
                                    <td style="text-align: center;">
                                        @if($garuda->url_artikel)
                                            <a href="{{ $garuda->url_artikel }}" target="_blank" class="pub-link"><i class="fas fa-external-link-alt"></i> Link</a>
                                        @else - @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="empty-text">Tidak ada data publikasi Garuda.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="content-block">
                <h2 class="block-title"><i class="fas fa-book"></i> Buku Resmi Terdaftar</h2>
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
                                        <div style="font-weight: 700; color: #111827; margin-bottom: 3px;">{{ $book->judul }}</div>
                                        <span style="font-size: 10px; background: #fffbeb; color: #b45309; padding: 2px 6px; border-radius: 4px; font-weight: 600;">
                                            {{ $book->kategori ?? 'Umum' }}
                                        </span>
                                    </td>
                                    <td style="text-align: center; font-weight: 600;">{{ $book->tahun }}</td>
                                    <td>
                                        <div style="font-weight: 600; color: #4b5563;">{{ $book->penerbit }}</div>
                                        <div style="font-size: 11px; color: #9ca3af;">{{ $book->kota ?? '-' }}</div>
                                    </td>
                                    <td style="text-align: center; font-weight: 700; color: #4b5563; font-family: monospace; font-size: 12px;">
                                        {{ $book->isbn ?? '-' }}
                                    </td>
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
        document.addEventListener('DOMContentLoaded', function () {
            
            // --- 1. SCOPUS LINE CHART ---
            const scopusLabels = {!! json_encode($dosen->scopusYearlyStats ? $dosen->scopusYearlyStats->pluck('tahun') : []) !!};
            const scopusData = {!! json_encode($dosen->scopusYearlyStats ? $dosen->scopusYearlyStats->pluck('jumlah') : []) !!};
            
            new Chart(document.getElementById('scopusChart'), {
                type: 'line',
                data: {
                    labels: scopusLabels,
                    datasets: [{
                        label: 'Jumlah Publikasi',
                        data: scopusData,
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.06)',
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

            // --- 2. GOOGLE SCHOLAR LINE CHART ---
            const scholarLabels = {!! json_encode($dosen->scholarYearlyStats ? $dosen->scholarYearlyStats->pluck('tahun') : []) !!};
            const scholarData = {!! json_encode($dosen->scholarYearlyStats ? $dosen->scholarYearlyStats->pluck('publications') : []) !!};
            
            new Chart(document.getElementById('scholarChart'), {
                type: 'line',
                data: {
                    labels: scholarLabels,
                    datasets: [{
                        label: 'Jumlah Publikasi',
                        data: scholarData,
                        borderColor: '#072b57',
                        backgroundColor: 'rgba(7, 43, 87, 0.06)',
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

            // --- 3. GARUDA LINE CHART ---
            const garudaLabels = {!! json_encode($dosen->garudaYearlyStats ? $dosen->garudaYearlyStats->pluck('tahun') : []) !!};
            const garudaData = {!! json_encode($dosen->garudaYearlyStats ? $dosen->garudaYearlyStats->pluck('articles') : []) !!};
            
            new Chart(document.getElementById('garudaChart'), {
                type: 'line',
                data: {
                    labels: garudaLabels,
                    datasets: [{
                        label: 'Jumlah Artikel',
                        data: garudaData,
                        borderColor: '#78927a',
                        backgroundColor: 'rgba(120, 146, 122, 0.06)',
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