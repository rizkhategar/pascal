@php
    $academicProgramsNav = \App\Http\Controllers\AcademicController::getNavigationData();
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Dosen & Riset - Pascasarjana UNW</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/risetdosen.css') }}">

    <style>
        /* Base Page Setup untuk menyatukan Header, Konten, & Footer tanpa celah */
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

        .rd-wrapper {
            flex: 1 0 auto;
            display: flex;
            flex-direction: column;
            width: 100%;
            font-family: 'Montserrat', sans-serif;
            background: #f1f6f7;
        }

        /* Hero Section diselaraskan dengan banner Home */
        .rd-hero {
            position: relative;
            min-height: 280px;
            overflow: hidden;
            background: #052044; 
            display: flex;
            align-items: center;
        }

        .rd-hero-slide {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
        }

        .rd-hero-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(1.15);
        }

        .rd-hero-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            background: linear-gradient(90deg, rgba(7, 43, 87, 0.50), rgba(7, 43, 87, 0.35), rgba(7, 43, 87, 0.55));
            z-index: 2;
        }

        .rd-hero-title {
            color: #ffffff;
            font-size: 36px;
            line-height: 1.25;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0;
            width: min(1120px, 92%);
            margin: 0 auto;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        /* Konten Container utama */
        .rd-container {
            width: min(1120px, 92%);
            margin: 0 auto;
            padding: 45px 0 52px;
        }

        /* Filter Box */
        .rd-filter-box {
            background: #ffffff;
            padding: 24px;
            border-radius: 6px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.10);
            margin-bottom: 32px;
            border: 1px solid #e5e7eb;
        }

        .rd-form {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            align-items: flex-end;
        }

        .rd-form-group {
            display: flex;
            flex-direction: column;
            flex: 1 1 260px;
        }

        .rd-form-group label {
            font-size: 12px;
            font-weight: 800;
            color: #072b57;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .rd-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 600;
            outline: none;
            transition: all 0.25s ease;
            background: #ffffff;
            color: #111827;
            font-family: inherit;
        }

        .rd-input:focus {
            border-color: #072b57;
            box-shadow: 0 0 0 3px rgba(7, 43, 87, 0.12);
        }

        .rd-btn-group {
            display: flex;
            gap: 10px;
            flex: 0 0 auto;
        }

        .rd-btn {
            height: 44px;
            padding: 0 24px;
            border-radius: 5px;
            font-weight: 800;
            font-size: 13px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.25s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            text-decoration: none;
        }

        .rd-btn-reset {
            background-color: #ffffff;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .rd-btn-reset:hover {
            background-color: #f3f4f6;
            border-color: #072b57;
            color: #072b57;
        }

        /* Grid Layout & Cards Dosen */
        .rd-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }

        /* Mengubah komponen pembungkus menjadi tautan blok aktif */
        .rd-list-item {
            display: flex;
            align-items: flex-start;
            gap: 24px;
            padding: 24px;
            border-radius: 8px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.25s ease;
            text-decoration: none; /* Menghilangkan underline default link */
            color: inherit; /* Menjaga warna teks agar tidak berubah biru */
            cursor: pointer;
        }

        .rd-list-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 22px rgba(7, 43, 87, 0.12);
            border-color: rgba(7, 43, 87, 0.2);
        }

        .rd-list-photo {
            width: 120px;
            height: 150px;
            flex-shrink: 0;
            overflow: hidden;
            border-radius: 6px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .rd-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .rd-list-item:hover .rd-photo {
            transform: scale(1.05);
        }

        .rd-list-content {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .rd-name {
            margin: 0;
            font-size: 18px;
            line-height: 1.35;
            font-weight: 800;
            color: #072b57;
        }

        .rd-department {
            margin-top: 6px;
            font-size: 13px;
            color: #78927a; 
            font-weight: 800;
            text-transform: uppercase;
        }

        .rd-sinta-id {
            margin-top: 8px;
            font-size: 11px;
            color: #374151;
            background: #f3f4f6;
            padding: 4px 10px;
            border-radius: 4px;
            display: inline-block;
            width: fit-content;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        /* Kotak Stat Nilai Sinta */
        .rd-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-top: 16px;
            background: #f1f6f7;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
        }

        .rd-stat {
            text-align: center;
        }

        .rd-stat-value {
            font-size: 16px;
            font-weight: 800;
            color: #072b57;
        }

        .rd-stat-label {
            font-size: 10px;
            color: #6b7280;
            margin-top: 2px;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.2px;
        }

        /* Bagian Kosong (Empty State) */
        .rd-empty {
            text-align: center;
            padding: 54px 20px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .rd-empty svg {
            width: 48px;
            height: 48px;
            color: #9ca3af;
            margin: 0 auto 14px auto;
        }

        .rd-empty h3 {
            font-size: 18px;
            font-weight: 800;
            color: #072b57;
            margin: 0 0 6px 0;
            text-transform: uppercase;
        }

        .rd-empty p {
            font-size: 13px;
            color: #6b7280;
            margin: 0;
            font-weight: 500;
        }

        /* Pagination */
        .rd-pagination {
            margin-top: 40px;
            display: flex;
            justify-content: center;
        }

        /* --- Pengaturan Responsif Layar --- */
        @media (min-width: 993px) {
            .rd-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .rd-hero {
                min-height: 320px;
            }
            .rd-hero-title {
                font-size: 42px;
            }
        }

        @media (max-width: 768px) {
            .rd-hero {
                min-height: 240px;
            }
            .rd-hero-title {
                font-size: 26px;
                text-align: center;
            }
            .rd-list-item {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 16px;
            }
            .rd-list-content {
                align-items: center;
                width: 100%;
            }
            .rd-stats {
                grid-template-columns: repeat(2, 1fr);
                width: 100%;
                gap: 12px;
            }
            .rd-btn-group {
                width: 100%;
            }
            .rd-btn {
                flex: 1;
            }
        }
    </style>
</head>

<body>

    @include('component.header')

    <div class="rd-wrapper">

        <section class="rd-hero">
            @if (isset($heroSlides) && count($heroSlides) > 0)
                <div>
                    @foreach ($heroSlides as $slide)
                        <div class="rd-hero-slide">
                            <img src="{{ asset('storage/' . $slide->image_path) }}" class="rd-hero-img" alt="Hero">
                            <div class="rd-hero-overlay">
                                <h1 class="rd-hero-title">{{ $slide->title ?? 'Data Dosen & Riset' }}</h1>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="rd-hero-overlay">
                    <h1 class="rd-hero-title">Daftar Riset Dosen</h1>
                </div>
            @endif
        </section>

        <main class="rd-container">

            <section class="rd-filter-box">
                <form method="GET" action="{{ url()->current() }}" class="rd-form" id="filterForm">

                    <div class="rd-form-group">
                        <label>Pencarian</label>
                        <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                            placeholder="Cari Nama Dosen atau ID Sinta..." class="rd-input" autocomplete="off">
                    </div>

                    <div class="rd-form-group">
                        <label>Filter Jurusan</label>
                        <select name="jurusan" id="jurusanSelect" class="rd-input">
                            <option value="">-- Semua Jurusan --</option>
                            @foreach ($academicProgramsNav as $jurusan)
                                <option value="{{ $jurusan['slug'] }}"
                                    {{ request('jurusan') == $jurusan['slug'] ? 'selected' : '' }}>
                                    {{ $jurusan['display_name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="rd-btn-group">
                        @if (request('search') || request('jurusan'))
                            <a href="{{ url()->current() }}" class="rd-btn rd-btn-reset">Reset</a>
                        @endif
                    </div>
                </form>
            </section>

            <section class="rd-grid">
                @forelse($dosens as $dosen)
                    <a href="{{ route('riset.detail', $dosen->sinta_id) }}" class="rd-list-item">

                        <div class="rd-list-photo">
                            @if ($dosen->profile_photo)
                                <img src="{{ asset('assets/images/' . $dosen->profile_photo) }}"
                                    alt="{{ $dosen->nama }}" class="rd-photo">
                            @else
                                <img src="{{ asset('assets/images/default-user.png') }}" alt="{{ $dosen->nama }}"
                                    class="rd-photo">
                            @endif
                        </div>

                        <div class="rd-list-content">

                            <h3 class="rd-name">{{ $dosen->nama }}</h3>

                            <div class="rd-department">
                                {{ $dosen->program_studi }}
                            </div>

                            <div class="rd-sinta-id">
                                SINTA ID : {{ $dosen->sinta_id }}
                            </div>

                            <div class="rd-stats">
                                <div class="rd-stat">
                                    <div class="rd-stat-value">{{ number_format($dosen->sinta_score_overall ?? 0) }}</div>
                                    <div class="rd-stat-label">Overall Score</div>
                                </div>

                                <div class="rd-stat">
                                    <div class="rd-stat-value">{{ number_format($dosen->sinta_score_3yr ?? 0) }}</div>
                                    <div class="rd-stat-label">3 Year Score</div>
                                </div>

                                <div class="rd-stat">
                                    <div class="rd-stat-value">{{ number_format($dosen->affil_score ?? 0) }}</div>
                                    <div class="rd-stat-label">Affil Score</div>
                                </div>

                                <div class="rd-stat">
                                    <div class="rd-stat-value">{{ number_format($dosen->affil_score_3yr ?? 0) }}</div>
                                    <div class="rd-stat-label">Affil 3Yr</div>
                                </div>
                            </div>

                        </div>

                    </a>
                @empty
                    <div class="rd-empty">
                        <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <h3>Data Tidak Ditemukan</h3>
                        <p>Tidak ada data dosen yang sesuai dengan kriteria pencarian Anda.</p>
                    </div>
                @endforelse
            </section>

            <div class="rd-pagination">
                {{ $dosens->withQueryString()->links() }}
            </div>

        </main>
    </div>

    @include('component.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('filterForm');
            const searchInput = document.getElementById('searchInput');
            const jurusanSelect = document.getElementById('jurusanSelect');

            // 1. Filter Otomatis untuk Dropdown Jurusan ketika dipilih (langsung submit)
            jurusanSelect.addEventListener('change', function () {
                form.submit();
            });

            // 2. Filter Otomatis untuk Input Pencarian menggunakan Debounce
            let debounceTimer;
            searchInput.addEventListener('input', function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function () {
                    form.submit();
                }, 700); 
            });

            if (searchInput.value.length > 0) {
                searchInput.focus();
                const val = searchInput.value;
                searchInput.value = '';
                searchInput.value = val;
            }
        });
    </script>

</body>
</html>