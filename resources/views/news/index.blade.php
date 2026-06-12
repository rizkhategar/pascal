<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita - Pascasarjana UNW</title>

    <link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png" sizes="64x64">
    <link rel="shortcut icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('logo_unwnobg.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary: #062f5f;
            --primary-dark: #031f42;
            --primary-soft: #07457d;
            --blue: #0b5f9f;
            --blue-light: #2d9cdb;
            --yellow: #f7b500;

            --white: #ffffff;
            --light: #f8fafc;
            --text: #0f172a;
            --text-soft: #334155;
            --muted: #64748b;
            --border: #e2e8f0;
            --green: #14532d;

            --shadow-sm: 0 10px 28px rgba(15, 23, 42, .07);
            --shadow-md: 0 18px 46px rgba(15, 23, 42, .10);
            --shadow-lg: 0 28px 70px rgba(15, 23, 42, .15);
            --shadow-blue: 0 24px 70px rgba(6, 47, 95, .25);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background:
                radial-gradient(circle at 8% 12%, rgba(45, 156, 219, .08), transparent 25%),
                linear-gradient(180deg, #ffffff 0%, #f8fafc 45%, #eef5fb 100%);
            color: var(--text);
        }

        a {
            color: inherit;
        }

        .container {
            width: min(100% - 64px, 1180px);
            margin: 0 auto;
        }

        /* ================= HERO ================= */

        .news-hero {
            position: relative;
            overflow: hidden;
            min-height: 335px;
            color: #fff;
            display: flex;
            align-items: center;
            padding: 62px 0 112px;
            background:
                radial-gradient(circle at 13% 18%, rgba(45, 156, 219, .42), transparent 26%),
                radial-gradient(circle at 82% 18%, rgba(255, 255, 255, .18), transparent 23%),
                linear-gradient(135deg, #031f42 0%, #062f5f 46%, #07457d 75%, #0b6eae 100%);
        }

        .news-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, .055) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, .055) 1px, transparent 1px);
            background-size: 46px 46px;
            opacity: .42;
            mask-image: linear-gradient(90deg, #000 0%, transparent 84%);
            z-index: 1;
        }

        .news-hero::after {
            content: "";
            position: absolute;
            right: -170px;
            top: -185px;
            width: 570px;
            height: 570px;
            border-radius: 50%;
            background:
                radial-gradient(circle, rgba(255, 255, 255, .20) 0%, rgba(45, 156, 219, .16) 36%, transparent 68%);
            z-index: 1;
        }

        .hero-dots {
            position: absolute;
            left: 24px;
            top: 18px;
            width: 120px;
            height: 92px;
            background-image: radial-gradient(rgba(255, 255, 255, .72) 2px, transparent 2.6px);
            background-size: 18px 18px;
            opacity: .48;
            z-index: 2;
        }

        .hero-line {
            position: absolute;
            right: 110px;
            top: -36px;
            width: 230px;
            height: 440px;
            background: linear-gradient(120deg, rgba(255, 255, 255, .04), rgba(255, 255, 255, .18));
            transform: skewX(-32deg);
            z-index: 1;
        }

        .hero-wave {
            position: absolute;
            left: 0;
            right: 0;
            bottom: -1px;
            width: 100%;
            height: 92px;
            z-index: 3;
            pointer-events: none;
        }

        .hero-wave svg {
            display: block;
            width: 100%;
            height: 100%;
        }

        .hero-inner {
            position: relative;
            z-index: 4;
            max-width: 900px;
        }

        .hero-kicker {
            width: fit-content;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            margin-bottom: 18px;
            border-radius: 999px;
            color: #ffe8a1;
            background: rgba(247, 181, 0, .12);
            border: 1px solid rgba(247, 181, 0, .34);
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .7px;
            backdrop-filter: blur(10px);
        }

        .page-title {
            margin: 0 0 18px;
            color: #fff;
            font-size: clamp(34px, 5vw, 58px);
            line-height: 1.05;
            font-weight: 900;
            letter-spacing: -1.1px;
        }

        .page-desc {
            max-width: 760px;
            margin: 0;
            color: rgba(255, 255, 255, .86);
            font-size: clamp(16px, 2vw, 20px);
            line-height: 1.75;
            font-weight: 600;
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 24px;
        }

        .hero-meta span {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 12px;
            border-radius: 999px;
            color: rgba(255, 255, 255, .88);
            background: rgba(255, 255, 255, .11);
            border: 1px solid rgba(255, 255, 255, .16);
            font-size: 14px;
            font-weight: 800;
            backdrop-filter: blur(10px);
        }

        .hero-meta i {
            color: var(--yellow);
        }

        /* ================= SECTION & TOOLBAR ================= */

        .news-section {
            position: relative;
            z-index: 5;
            margin-top: -56px;
            padding: 0 0 90px;
        }

        .news-panel {
            border-radius: 30px;
            background: rgba(255, 255, 255, .94);
            border: 1px solid rgba(226, 232, 240, .95);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }

        .news-toolbar {
            display: flex;
            flex-wrap: nowrap; 
            gap: 24px;
            align-items: center; 
            justify-content: space-between;
            padding: 22px 26px;
            background:
                linear-gradient(135deg, rgba(6, 47, 95, .05), rgba(45, 156, 219, .05)),
                #ffffff;
            border-bottom: 1px solid rgba(226, 232, 240, .95);
        }

        .filter-wrap {
            display: flex;
            flex-wrap: nowrap;
            gap: 16px;
            flex: 0 0 auto; 
        }

        .dropdown-group {
            display: flex;
            flex-direction: row; 
            align-items: center;
            gap: 10px;
            flex: 0 0 auto;
        }

        /* Ikon Membulat */
        .toolbar-label {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--blue));
            box-shadow: 0 10px 22px rgba(6, 47, 95, .20);
            font-size: 14px;
            flex-shrink: 0;
            margin-bottom: 0;
            cursor: pointer;
        }

        /* Dropdown Membulat (Pill Shape) */
        .styled-select {
            width: 170px; 
            height: 44px;
            border: 1px solid rgba(6, 47, 95, .15);
            border-radius: 999px;
            background: #fff;
            color: var(--primary);
            font-weight: 800;
            font-size: 14px;
            padding: 0 32px 0 16px;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(15, 23, 42, .04);
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2307457d' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 16px;
            transition: .22s ease;
            flex-shrink: 0;
            /* Mencegah teks kepanjangan melar ke luar batas */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .styled-select:focus,
        .styled-select:hover {
            border-color: var(--blue);
            box-shadow: 0 12px 24px rgba(6, 47, 95, .12);
            outline: none;
        }

        /* Pembungkus Kolom Pencarian */
        .news-search-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px;
            border-radius: 999px;
            background: #fff;
            border: 1px solid rgba(6, 47, 95, .15);
            box-shadow: 0 12px 30px rgba(15, 23, 42, .06);
            flex: 1 1 auto; 
            max-width: 320px; 
            transition: .22s ease;
        }

        .news-search-wrap:focus-within {
            border-color: var(--blue);
            box-shadow: 0 12px 24px rgba(6, 47, 95, .12);
        }

        /* Input Pencarian */
        .search-box {
            width: 100%;
            height: 34px;
            min-width: 0;
            border: 0;
            border-radius: 999px;
            background: transparent;
            padding: 0 10px 0 16px;
            outline: none;
            color: var(--primary);
            font-size: 14px;
            font-weight: 800;
        }

        .search-box::placeholder {
            color: #94a3b8;
        }

        /* Tombol Pencarian */
        .search-icon-btn {
            width: 36px;
            height: 36px;
            flex: 0 0 36px;
            border: 0;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--blue));
            color: #fff;
            font-size: 15px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(7, 43, 87, .18);
            transition: .22s ease;
        }

        .search-icon-btn:hover {
            background: var(--yellow);
            color: var(--primary);
            transform: translateY(-2px);
        }

        .news-content {
            padding: 26px;
        }

        .news-page-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
        }

        /* ================= NEWS CARD ================= */

        .news-page-card {
            position: relative;
            overflow: hidden;
            min-height: 100%;
            display: flex;
            flex-direction: column;
            border-radius: 24px;
            background: #fff;
            border: 1px solid rgba(226, 232, 240, .95);
            box-shadow: var(--shadow-sm);
            text-decoration: none;
            color: inherit;
            transition: .26s ease;
        }

        .news-page-card:hover {
            transform: translateY(-7px);
            border-color: rgba(45, 156, 219, .35);
            box-shadow: var(--shadow-md);
        }

        .news-page-thumb {
            position: relative;
            width: 100%;
            aspect-ratio: 16 / 10;
            background:
                linear-gradient(135deg, rgba(6, 47, 95, .10), rgba(45, 156, 219, .10)),
                #eef2f7;
            overflow: hidden;
            flex-shrink: 0;
        }

        .news-page-thumb::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 45%, rgba(3, 31, 66, .72));
            z-index: 2;
            opacity: .88;
            pointer-events: none;
        }

        .news-page-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
            transition: .42s ease;
        }

        .news-page-card:hover .news-page-thumb img {
            transform: scale(1.06);
        }

        .news-page-thumb.no-image {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .news-page-thumb.no-image i {
            position: relative;
            z-index: 1;
            color: rgba(6, 47, 95, .22);
            font-size: 54px;
        }

        .news-page-category {
            position: absolute;
            left: 16px;
            bottom: 15px;
            z-index: 3;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            max-width: calc(100% - 32px);
            padding: 8px 11px;
            border-radius: 999px;
            color: #fff;
            background: rgba(255, 255, 255, .16);
            border: 1px solid rgba(255, 255, 255, .26);
            backdrop-filter: blur(10px);
            font-weight: 900;
            font-size: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .news-page-category i {
            color: var(--yellow);
            flex-shrink: 0;
        }

        .news-page-body {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 20px;
        }

        .news-page-title {
            margin: 0 0 12px;
            color: var(--primary);
            font-size: 19px;
            line-height: 1.42;
            font-weight: 900;
            letter-spacing: -.2px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: .22s ease;
        }

        .news-page-card:hover .news-page-title {
            color: var(--blue);
        }

        .news-page-excerpt {
            margin: 0 0 18px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }

        .news-page-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding-top: 14px;
            border-top: 1px solid #eef2f7;
        }

        .news-page-date {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #64748b;
            font-weight: 900;
            font-size: 12px;
        }

        .news-page-date i {
            color: var(--yellow);
        }

        .read-more {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: var(--primary);
            font-size: 12px;
            font-weight: 900;
            white-space: nowrap;
        }

        .read-more i {
            transition: .22s ease;
        }

        .news-page-card:hover .read-more i {
            transform: translateX(4px);
        }

        /* ================= PAGINATION ================= */

        .pagination {
            margin-top: 34px;
            padding-top: 24px;
            border-top: 1px solid #eef2f7;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            flex-wrap: wrap;
        }

        .page-btn {
            height: 42px;
            min-width: 42px;
            border: 1px solid rgba(6, 47, 95, .14);
            border-radius: 13px;
            background: #fff;
            color: var(--primary);
            font-weight: 900;
            cursor: pointer;
            padding: 0 13px;
            transition: .2s ease;
            box-shadow: 0 8px 18px rgba(15, 23, 42, .04);
            flex-shrink: 0;
        }

        .page-btn.active,
        .page-btn:hover {
            background: linear-gradient(135deg, var(--primary), var(--blue));
            border-color: transparent;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(6, 47, 95, .18);
        }

        .page-btn[disabled] {
            opacity: .45;
            cursor: not-allowed;
            background: #f1f5f9;
            color: #94a3b8;
            transform: none;
            box-shadow: none;
        }

        .page-dots {
            font-weight: 900;
            color: #94a3b8;
            margin: 0 2px;
        }

        .page-jump {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: 8px;
            border-left: 1px solid rgba(6, 47, 95, .12);
            padding-left: 14px;
        }

        .page-jump input {
            width: 76px;
            height: 42px;
            border: 1px solid rgba(6, 47, 95, .14);
            border-radius: 13px;
            padding: 0 10px;
            color: var(--primary);
            font-weight: 900;
            outline: none;
            box-shadow: 0 8px 18px rgba(15, 23, 42, .04);
            text-align: center;
        }

        .page-jump input:focus {
            border-color: var(--blue);
        }

        .page-jump button {
            height: 42px;
            border: 0;
            border-radius: 13px;
            background: var(--primary);
            color: #fff;
            font-size: 12px;
            font-weight: 900;
            padding: 0 14px;
            cursor: pointer;
            transition: .2s ease;
        }

        .page-jump button:hover {
            background: var(--yellow);
            color: var(--primary);
            transform: translateY(-2px);
        }

        /* ================= STATES ================= */

        .loading,
        .empty {
            grid-column: 1 / -1;
            min-height: 260px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 14px;
            background:
                linear-gradient(135deg, rgba(6, 47, 95, .05), rgba(45, 156, 219, .05)),
                #ffffff;
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 38px;
            text-align: center;
            color: var(--muted);
            font-weight: 800;
        }

        .loader {
            width: 46px;
            height: 46px;
            border: 4px solid #e5e7eb;
            border-top-color: var(--yellow);
            border-right-color: var(--primary);
            border-radius: 50%;
            animation: spin .8s linear infinite;
        }

        .empty i {
            width: 58px;
            height: 58px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            background: rgba(6, 47, 95, .08);
            color: var(--primary);
            font-size: 24px;
        }

        .empty strong {
            display: block;
            color: var(--text);
            font-size: 19px;
            line-height: 1.3;
        }

        .empty span {
            display: block;
            max-width: 460px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width: 1024px) {
            .news-page-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media(max-width: 768px) {
            .container {
                width: min(100% - 28px, 1180px);
            }
            .news-hero {
                min-height: 315px;
                padding: 48px 0 96px;
            }
            .news-section {
                margin-top: -48px;
                padding-bottom: 70px;
            }
            .news-toolbar {
                padding: 18px 22px;
            }
            .news-search-wrap {
                max-width: 250px; 
            }
            .news-content {
                padding: 20px;
            }
            .news-page-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }
        }

        /* --- PERBAIKAN TAMPILAN KHUSUS HP (MOBILE) --- */
        @media(max-width: 480px) {
            .news-hero {
                min-height: 280px;
            }

            .page-title {
                font-size: 26px;
            }

            .news-toolbar {
                padding: 16px;
                flex-direction: column;
                align-items: stretch;
                gap: 14px;
            }

            /* Memaksa Dropdown selalu 2 Kolom bersebelahan yang presisi */
            .filter-wrap {
                grid-template-columns: 1fr 1fr; 
                gap: 10px; 
                display: grid;
                width: 100%;
            }

            .dropdown-group {
                width: 100%;
                gap: 0;
            }

            /* Menyembunyikan seluruh Ikon agar Dropdown masuk rata kiri-kanan sempurna */
            .toolbar-label {
                display: none;
            }

            /* Ukuran dropdown di HP */
            .styled-select {
                width: 100%;
                height: 42px; 
                font-size: 13px; 
                padding: 0 28px 0 14px; 
                background-size: 14px; 
                border-radius: 12px;
            }

            /* Mengecilkan Kotak Pencarian */
            .news-search-wrap {
                width: 100%;
                max-width: 100%;
                height: 44px; 
                padding: 4px; 
                gap: 6px; 
                border-radius: 12px;
            }

            .search-box {
                height: 34px; 
                font-size: 13px; 
            }

            .search-icon-btn {
                width: 34px; 
                height: 34px; 
                flex: 0 0 34px; 
                font-size: 14px; 
                border-radius: 10px;
            }

            .news-content {
                padding: 16px;
            }

            .news-page-card {
                border-radius: 18px;
            }

            .news-page-body {
                padding: 16px;
            }

            .news-page-title {
                font-size: 16px;
            }

            /* Pagination dipaksa menjadi mutlak 1 Baris dengan menu lompat ke bawahnya */
            .pagination {
                flex-wrap: wrap !important;
                gap: 6px;
                justify-content: center;
                padding-bottom: 4px;
            }

            .page-btn {
                height: 36px;
                min-width: 36px;
                padding: 0 8px;
                font-size: 13px;
                border-radius: 10px;
            }

            .page-dots {
                margin: 0;
            }

            /* Menu Lompat Halaman agar rapi di HP */
            .page-jump {
                width: 100%; /* Memaksa turun ke baris baru */
                justify-content: center;
                margin-left: 0;
                border-left: 0;
                padding-left: 0;
                margin-top: 8px;
                border-top: 1px solid rgba(6, 47, 95, .12);
                padding-top: 14px;
            }

            .page-jump input {
                height: 38px;
                width: 60px;
                border-radius: 10px;
                font-size: 13px;
            }

            .page-jump button {
                height: 38px;
                border-radius: 10px;
            }
        }
    </style>
</head>

<body>
    @include('component.header')

    <section class="news-hero">
        <div class="hero-dots"></div>
        <div class="hero-line"></div>

        <div class="container">
            <div class="hero-inner">
                <div class="hero-kicker">
                    <i class="fas fa-newspaper"></i>
                    <span>Berita Pascasarjana</span>
                </div>

                <h1 class="page-title">Berita Terkini & Agenda</h1>

                <p class="page-desc">
                    Kumpulan berita, agenda, pengumuman, dan informasi terbaru Pascasarjana Universitas Ngudi Waluyo.
                </p>

                <div class="hero-meta">
                    <span>
                        <i class="fas fa-bullhorn"></i>
                        Informasi Resmi
                    </span>
                    <span>
                        <i class="fas fa-university"></i>
                        Universitas Ngudi Waluyo
                    </span>
                </div>
            </div>
        </div>

        <div class="hero-wave">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path d="M0,74 C180,122 384,36 650,62 C930,90 1120,128 1440,44 L1440,120 L0,120 Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

    <main class="news-section">
        <div class="container">
            <section class="news-panel">
                <div class="news-toolbar">
                    <div class="filter-wrap">
                        
                        <div class="dropdown-group">
                            <label class="toolbar-label" for="newsCategorySelect" title="Kategori Berita">
                                <i class="fas fa-layer-group"></i>
                            </label>
                            <select id="newsCategorySelect" class="styled-select" aria-label="Pilih Kategori">
                                <option value="all">Memuat Kategori...</option>
                            </select>
                        </div>

                        <div class="dropdown-group">
                            <label class="toolbar-label" for="newsSortSelect" title="Urutkan Berita">
                                <i class="fas fa-sort-amount-down"></i>
                            </label>
                            <select id="newsSortSelect" class="styled-select" aria-label="Urutkan Berita">
                                <option value="desc">Terbaru</option>
                                <option value="asc">Terlama</option>
                            </select>
                        </div>

                    </div>

                    <div class="news-search-wrap">
                        <input
                            class="search-box"
                            id="newsSearch"
                            type="search"
                            placeholder="Cari berita atau agenda...">

                        <button
                            class="search-icon-btn"
                            id="newsSearchButton"
                            type="button"
                            title="Cari Berita"
                            aria-label="Cari berita">
                            <i class="fas fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>

                <div class="news-content">
                    <div class="news-page-grid" id="newsGrid">
                        <div class="loading">
                            <div class="loader"></div>
                            <span>Memuat berita...</span>
                        </div>
                    </div>

                    <div class="pagination" id="newsPagination"></div>
                </div>
            </section>
        </div>
    </main>

    @include('component.footer')

    <script>
        (function () {
            const API_ORIGIN = 'https://panel-web.unw.ac.id';

            const API = {
                search: @json(route('news.search')),
                category: API_ORIGIN + '/api/category'
            };

            const PAGE_SIZE = 9;

            const state = {
                page: 1,
                lastPage: 1,
                category: 'all',
                sort: 'desc',
                q: ''
            };

            let searchTimer = null;
            let activeRequestId = 0;

            const grid = document.getElementById('newsGrid');
            const categorySelect = document.getElementById('newsCategorySelect');
            const sortSelect = document.getElementById('newsSortSelect');
            const pagination = document.getElementById('newsPagination');
            const search = document.getElementById('newsSearch');
            const searchButton = document.getElementById('newsSearchButton');

            function esc(value) {
                return String(value ?? '').replace(/[&<>'"]/g, function (char) {
                    return {
                        '&': '&amp;',
                        '<': '&lt;',
                        '>': '&gt;',
                        "'": '&#039;',
                        '"': '&quot;'
                    }[char];
                });
            }

            function strip(value) {
                return String(value ?? '')
                    .replace(/<[^>]*>/g, '')
                    .replace(/\s+/g, ' ')
                    .trim();
            }

            function arr(payload) {
                if (Array.isArray(payload)) return payload;
                if (Array.isArray(payload?.data)) return payload.data;
                if (Array.isArray(payload?.data?.data)) return payload.data.data;
                return [];
            }

            function date(value) {
                if (!value) return '';
                const d = new Date(value);
                if (Number.isNaN(d.getTime())) return String(value);
                return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
            }

            function img(url) {
                if (!url) return '';
                url = String(url);
                if (/^https?:\/\//i.test(url)) return url;
                if (url.startsWith('/')) return API_ORIGIN + url;
                return API_ORIGIN + '/' + url.replace(/^\/+/, '');
            }

            async function get(url) {
                const response = await fetch(url, { headers: { Accept: 'application/json' } });
                if (!response.ok) throw new Error('failed');
                return response.json();
            }

            function normalize(item) {
                const category = item?.category || {};
                return {
                    title: String(item?.title ?? 'Tanpa Judul'),
                    slug: String(item?.slug ?? ''),
                    image: String(item?.image_thumbnail || item?.image || ''),
                    excerpt: String(item?.excerpt ?? item?.body ?? ''),
                    date: String(item?.publishedAt || item?.published_at || item?.createdAt || item?.created_at || ''),
                    categoryId: String(category?.id ?? item?.category_id ?? ''),
                    categorySlug: String(category?.slug ?? ''),
                    categoryName: String(category?.name ?? 'Artikel')
                };
            }

            function buildUrl(page) {
                const params = new URLSearchParams({
                    paginate: String(PAGE_SIZE),
                    page: String(page),
                    sort: state.sort
                });

                if (state.q.trim() !== '') {
                    params.set('q', state.q.trim());
                }

                if (state.category !== 'all') {
                    params.set('category_id', state.category);
                }

                return API.search + '?' + params.toString();
            }

            function render(items) {
                if (!items.length) {
                    grid.innerHTML = `
                        <div class="empty">
                            <i class="fas fa-magnifying-glass"></i>
                            <strong>Berita tidak ditemukan</strong>
                            <span>Belum ada berita yang sesuai dengan pencarian Anda.</span>
                        </div>
                    `;
                    return;
                }

                grid.innerHTML = items.map(function (news) {
                    const title = esc(news.title);
                    const url = '/berita/' + encodeURIComponent(news.slug);
                    const imageUrl = img(news.image);
                    const excerpt = esc(strip(news.excerpt));
                    const categoryName = esc(news.categoryName);
                    const newsDate = esc(date(news.date));

                    const imageHtml = imageUrl
                        ? `<div class="news-page-thumb">
                                <img src="${esc(imageUrl)}" alt="${title}">
                                <div class="news-page-category">
                                    <i class="fas fa-tag"></i>
                                    ${categoryName}
                                </div>
                           </div>`
                        : `<div class="news-page-thumb no-image">
                                <i class="fas fa-newspaper"></i>
                                <div class="news-page-category">
                                    <i class="fas fa-tag"></i>
                                    ${categoryName}
                                </div>
                           </div>`;

                    return `
                        <a class="news-page-card" href="${url}">
                            ${imageHtml}
                            <div class="news-page-body">
                                <h2 class="news-page-title">${title}</h2>
                                <p class="news-page-excerpt">${excerpt}</p>
                                <div class="news-page-footer">
                                    <div class="news-page-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        ${newsDate || 'Tanggal belum tersedia'}
                                    </div>
                                    <div class="read-more">Baca <i class="fas fa-arrow-right"></i></div>
                                </div>
                            </div>
                        </a>
                    `;
                }).join('');
            }

            function renderPages() {
                const last = Math.max(1, state.lastPage);
                const current = Math.min(state.page, last);

                if (last <= 1) {
                    pagination.innerHTML = '';
                    return;
                }

                // Pada layar HP hanya memunculkan 3 tombol angka agar muat 1 baris
                const isMobile = window.innerWidth <= 480;
                const visiblePages = isMobile ? 3 : 5; 

                let start = Math.max(1, current - Math.floor(visiblePages / 2));
                let end = Math.min(last, start + visiblePages - 1);

                if (end - start < visiblePages - 1) {
                    start = Math.max(1, end - visiblePages + 1);
                }

                let html = `<button class="page-btn" data-page="${current - 1}" ${current <= 1 ? 'disabled' : ''}>‹</button>`;

                for (let page = start; page <= end; page++) {
                    html += `<button class="page-btn ${page === current ? 'active' : ''}" data-page="${page}">${page}</button>`;
                }

                if (end < last) {
                    html += `<span class="page-dots">...</span><button class="page-btn" data-page="${last}">${last}</button>`;
                }

                html += `<button class="page-btn" data-page="${current + 1}" ${current >= last ? 'disabled' : ''}>›</button>
                         <div class="page-jump">
                             <input type="number" min="1" max="${last}" value="${current}" aria-label="Pilih halaman">
                             <button type="button">Go</button>
                         </div>`;

                pagination.innerHTML = html;

                pagination.querySelectorAll('[data-page]').forEach(function (button) {
                    button.onclick = function () {
                        const page = Number(button.dataset.page);
                        if (page >= 1 && page <= last && page !== current) {
                            state.page = page;
                            load();
                        }
                    };
                });

                const input = pagination.querySelector('.page-jump input');
                const button = pagination.querySelector('.page-jump button');

                function jump() {
                    const page = Number(input.value);
                    if (page >= 1 && page <= last && page !== current) {
                        state.page = page;
                        load();
                    }
                }

                button?.addEventListener('click', jump);
                input?.addEventListener('keydown', function (event) { if (event.key === 'Enter') jump(); });
            }

            async function load() {
                const requestId = ++activeRequestId;
                grid.innerHTML = `<div class="loading"><div class="loader"></div><span>Memuat berita...</span></div>`;

                try {
                    const payload = await get(buildUrl(state.page));
                    if (requestId !== activeRequestId) return;

                    state.lastPage = Number(payload?.meta?.last_page || 1);
                    state.page = Number(payload?.meta?.current_page || state.page);

                    render(arr(payload).map(normalize));
                    renderPages();
                } catch (error) {
                    if (requestId === activeRequestId) {
                        grid.innerHTML = `
                            <div class="empty">
                                <i class="fas fa-triangle-exclamation"></i>
                                <strong>Berita belum dapat dimuat</strong>
                                <span>Silakan coba muat ulang halaman atau periksa koneksi internet Anda.</span>
                            </div>
                        `;
                        pagination.innerHTML = '';
                    }
                }
            }

            async function loadFilters() {
                try {
                    const payload = await get(API.category);
                    
                    categorySelect.innerHTML = '<option value="all">Kategori (Semua)</option>' + 
                        arr(payload).map(function (category) {
                            return `<option value="${esc(category.id)}">${esc(category.name)}</option>`;
                        }).join('');

                    categorySelect.addEventListener('change', function () {
                        state.category = this.value;
                        state.page = 1;
                        load();
                    });
                } catch (error) {
                    categorySelect.innerHTML = '<option value="all">Kategori (Semua)</option>';
                }
            }

            sortSelect?.addEventListener('change', function () {
                state.sort = this.value;
                state.page = 1;
                load();
            });

            search.addEventListener('input', function () {
                clearTimeout(searchTimer);
                state.q = search.value;
                state.page = 1;
                searchTimer = setTimeout(load, 400);
            });

            searchButton?.addEventListener('click', function () {
                state.q = search.value;
                state.page = 1;
                search.focus();
                load();
            });

            loadFilters();
            load();

            // Handle Resize Window agar Paginasi menyesuaikan otomatis
            window.addEventListener('resize', function() {
                clearTimeout(window.resizeTimer);
                window.resizeTimer = setTimeout(renderPages, 200);
            });
        })();
    </script>
</body>

</html>