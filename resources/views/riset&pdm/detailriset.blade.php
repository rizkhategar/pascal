<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $dosen->nama }} - Detail Profil & SINTA Dosen</title>

    <link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary: #062f5f;
            --primary-dark: #031f42;
            --primary-soft: #07457d;
            --blue: #0b5f9f;
            --blue-light: #2d9cdb;
            --yellow: #f7b500;

            --white: #ffffff;
            --bg: #f6f9fc;
            --text: #0f172a;
            --text-soft: #334155;
            --muted: #64748b;
            --border: #e2e8f0;

            --success: #16a34a;
            --success-bg: #f0fdf4;
            --warning-bg: #fffbeb;
            --warning-text: #b45309;

            --shadow-sm: 0 10px 28px rgba(15, 23, 42, .07);
            --shadow-md: 0 18px 46px rgba(15, 23, 42, .10);
            --shadow-lg: 0 28px 70px rgba(15, 23, 42, .15);
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0 !important;
            padding: 0 !important;
            min-height: 100vh;
        }

        body {
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
            background:
                radial-gradient(circle at 8% 12%, rgba(45, 156, 219, .08), transparent 25%),
                linear-gradient(180deg, #ffffff 0%, #f8fafc 44%, #eef5fb 100%);
            color: var(--text);
        }

        a {
            color: inherit;
        }

        .profile-page {
            width: 100%;
            min-height: 100vh;
            background: transparent;
        }

        .profile-container {
            width: min(100% - 64px, 1180px);
            margin: 0 auto;
        }

        /* ================= HERO ================= */

        .profile-hero {
            position: relative;
            overflow: hidden;
            color: #fff;
            min-height: 335px;
            display: flex;
            align-items: center;
            padding: 58px 0 110px;
            background:
                radial-gradient(circle at 13% 18%, rgba(45, 156, 219, .42), transparent 26%),
                radial-gradient(circle at 82% 18%, rgba(255, 255, 255, .18), transparent 23%),
                linear-gradient(135deg, #031f42 0%, #062f5f 46%, #07457d 75%, #0b6eae 100%);
        }

        .profile-hero::before {
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

        .profile-hero::after {
            content: "";
            position: absolute;
            right: -170px;
            top: -185px;
            width: 570px;
            height: 570px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 255, 255, .20) 0%, rgba(45, 156, 219, .16) 36%, transparent 68%);
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
            max-width: 980px;
        }

        .btn-back {
            width: fit-content;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
            padding: 11px 16px;
            border-radius: 999px;
            color: #fff !important;
            background: rgba(255, 255, 255, .11);
            border: 1px solid rgba(255, 255, 255, .22);
            text-decoration: none;
            font-size: 13px;
            font-weight: 900;
            letter-spacing: .5px;
            text-transform: uppercase;
            backdrop-filter: blur(12px);
            box-shadow: 0 12px 26px rgba(0, 0, 0, .14);
            transition: .24s ease;
        }

        .btn-back:hover {
            transform: translateX(-5px);
            background: var(--yellow);
            border-color: var(--yellow);
            color: var(--primary) !important;
        }

        .profile-tag {
            width: fit-content;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 9px 15px;
            margin-bottom: 17px;
            border-radius: 999px;
            color: #ffe8a1;
            background: rgba(247, 181, 0, .12);
            border: 1px solid rgba(247, 181, 0, .34);
            font-size: 13px;
            font-weight: 900;
            letter-spacing: .4px;
            text-transform: uppercase;
            backdrop-filter: blur(10px);
        }

        .profile-hero-title {
            max-width: 980px;
            margin: 0 0 18px;
            color: #fff;
            font-size: clamp(31px, 4.7vw, 54px);
            line-height: 1.06;
            font-weight: 900;
            letter-spacing: -1px;
        }

        .profile-meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .profile-meta span {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 12px;
            border-radius: 999px;
            color: rgba(255, 255, 255, .88);
            background: rgba(255, 255, 255, .11);
            border: 1px solid rgba(255, 255, 255, .16);
            font-size: 13px;
            font-weight: 800;
            backdrop-filter: blur(10px);
        }

        .profile-meta i {
            color: var(--yellow);
        }

        /* ================= MAIN ================= */

        .profile-main-body {
            position: relative;
            z-index: 5;
            width: min(100% - 64px, 1180px);
            margin: -58px auto 90px;
            display: grid;
            gap: 28px;
        }

        .content-block {
            background: rgba(255, 255, 255, .98);
            border: 1px solid rgba(226, 232, 240, .95);
            border-radius: 30px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }

        /* ================= IDENTITY ================= */

        .identity-card-grid {
            display: grid;
            grid-template-columns: 230px 1fr;
            gap: 0;
        }

        .profile-photo-section {
            padding: 28px;
            background:
                radial-gradient(circle at 18% 18%, rgba(45, 156, 219, .12), transparent 34%),
                linear-gradient(180deg, #f8fafc, #eef5fb);
            border-right: 1px solid rgba(226, 232, 240, .95);
        }

        .profile-photo-frame {
            width: 100%;
            aspect-ratio: 3 / 4;
            overflow: hidden;
            border-radius: 24px;
            background: #eaf1f8;
            box-shadow: 0 18px 42px rgba(15, 23, 42, .13);
        }

        .profile-photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .profile-photo-caption {
            margin-top: 16px;
            display: grid;
            gap: 8px;
        }

        .profile-photo-caption span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 9px 12px;
            border-radius: 999px;
            color: var(--primary);
            background: #fff;
            border: 1px solid #eef2f7;
            font-size: 11px;
            line-height: 1.2;
            font-weight: 900;
            text-align: center;
        }

        .profile-photo-caption i {
            color: var(--yellow);
        }

        .profile-identity-content {
            padding: 30px;
        }

        .profile-content-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 24px;
        }

        .profile-heading-title {
            display: flex;
            align-items: center;
            gap: 13px;
            min-width: 0;
        }

        .profile-heading-icon {
            width: 48px;
            height: 48px;
            flex: 0 0 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 17px;
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--blue));
            box-shadow: 0 12px 26px rgba(6, 47, 95, .22);
        }

        .profile-heading-title h2 {
            margin: 0 0 5px;
            color: var(--text);
            font-size: 22px;
            line-height: 1.25;
            font-weight: 900;
        }

        .profile-heading-title p {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.55;
            font-weight: 600;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 26px;
        }

        .stat-box {
            position: relative;
            overflow: hidden;
            padding: 18px 12px;
            border-radius: 20px;
            background: #f8fafc;
            border: 1px solid #eef2f7;
            text-align: center;
            transition: .24s ease;
        }

        .stat-box::before {
            content: "";
            position: absolute;
            inset: 0 auto 0 0;
            width: 4px;
            background: linear-gradient(180deg, var(--primary), var(--blue-light));
        }

        .stat-box:hover {
            transform: translateY(-4px);
            background: #fff;
            border-color: rgba(45, 156, 219, .35);
            box-shadow: var(--shadow-sm);
        }

        .stat-number {
            color: var(--primary);
            font-size: 23px;
            line-height: 1.1;
            font-weight: 900;
        }

        .stat-desc {
            margin-top: 6px;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.35;
            text-transform: uppercase;
            font-weight: 900;
            letter-spacing: .35px;
        }

        .block-title {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin: 0 0 20px;
            padding-bottom: 10px;
            color: var(--primary);
            font-size: 18px;
            line-height: 1.25;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .45px;
        }

        .block-title::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 82px;
            height: 4px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--yellow), var(--blue));
        }

        .table-profile {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .table-profile td {
            padding: 15px 17px;
            font-size: 14px;
            line-height: 1.55;
        }

        .table-profile td.label {
            width: 210px;
            color: var(--muted);
            background: #f8fafc;
            border: 1px solid #eef2f7;
            border-right: 0;
            border-radius: 16px 0 0 16px;
            font-weight: 900;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: .35px;
        }

        .table-profile td.value {
            color: var(--text);
            background: #fff;
            border: 1px solid #eef2f7;
            border-left: 0;
            border-radius: 0 16px 16px 0;
            font-weight: 700;
        }

        .table-profile td.value.highlight {
            color: var(--primary);
            font-weight: 900;
        }

        /* ================= TABS ================= */

        .tabs-container-wrap {
            position: sticky;
            top: 0;
            z-index: 20;
            padding: 12px;
            border-radius: 24px;
            background: rgba(255, 255, 255, .88);
            border: 1px solid rgba(226, 232, 240, .95);
            box-shadow: var(--shadow-sm);
            backdrop-filter: blur(14px);
        }

        .tabs-container {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding: 4px;
            scrollbar-width: none;
        }

        .tabs-container::-webkit-scrollbar {
            display: none;
        }

        .tab-btn {
            flex: 1;
            min-width: 150px;
            min-height: 46px;
            padding: 12px 16px;
            border: 1px solid rgba(6, 47, 95, .12);
            border-radius: 999px;
            background: #fff;
            color: var(--primary);
            font-family: 'Montserrat', sans-serif;
            font-weight: 900;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .25px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            white-space: nowrap;
            transition: .22s ease;
        }

        .tab-btn i {
            color: var(--yellow);
        }

        .tab-btn:hover,
        .tab-btn.active {
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--blue));
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(6, 47, 95, .22);
        }

        .tab-btn:hover i,
        .tab-btn.active i {
            color: var(--yellow);
        }

        .tab-content {
            display: none;
            animation: slideUpEffect .35s ease-out;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes slideUpEffect {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .research-card {
            padding: 28px;
        }

        .tab-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 24px;
        }

        .tab-header p {
            margin: 6px 0 0;
            max-width: 740px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.65;
            font-weight: 600;
        }

        .tab-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 999px;
            color: var(--primary);
            background: #f8fafc;
            border: 1px solid #eef2f7;
            font-size: 12px;
            font-weight: 900;
            white-space: nowrap;
        }

        .tab-badge i {
            color: var(--yellow);
        }

        /* ================= CHART ================= */

        .card-chart-wrapper {
            margin-bottom: 26px;
            padding: 22px;
            border-radius: 24px;
            background:
                linear-gradient(135deg, rgba(6, 47, 95, .05), rgba(45, 156, 219, .05)),
                #f8fafc;
            border: 1px solid #eef2f7;
        }

        .chart-title {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 16px;
            color: var(--primary);
            font-size: 13px;
            line-height: 1.4;
            font-weight: 900;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: .35px;
        }

        .chart-title i {
            color: var(--yellow);
        }

        .chart-container {
            position: relative;
            width: 100%;
            height: 260px;
        }

        /* ================= TABLE ================= */

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            border-radius: 22px;
            border: 1px solid #eef2f7;
            box-shadow: var(--shadow-sm);
        }

        .table-data {
            width: 100%;
            min-width: 780px;
            border-collapse: collapse;
            text-align: left;
            font-size: 13.5px;
            background: #fff;
        }

        .table-data th {
            padding: 15px 16px;
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--blue));
            font-weight: 900;
            text-transform: uppercase;
            font-size: 11px;
            line-height: 1.45;
            letter-spacing: .5px;
            white-space: nowrap;
        }

        .table-data td {
            padding: 16px;
            border-bottom: 1px solid #eef2f7;
            vertical-align: top;
            color: var(--text-soft);
            line-height: 1.65;
        }

        .table-data tr:last-child td {
            border-bottom: none;
        }

        .table-data tr:hover td {
            background: #f8fafc;
        }

        .table-number {
            text-align: center;
            color: var(--primary);
            font-weight: 900;
        }

        .pub-title {
            margin-bottom: 4px;
            color: var(--text);
            font-weight: 900;
            line-height: 1.5;
        }

        .pub-muted {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .pub-primary {
            color: var(--primary);
            font-size: 12px;
            font-weight: 800;
            line-height: 1.6;
        }

        .pub-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 8px 11px;
            border-radius: 999px;
            color: var(--primary);
            background: #f8fafc;
            border: 1px solid #eef2f7;
            text-decoration: none;
            font-size: 12px;
            font-weight: 900;
            transition: .22s ease;
        }

        .pub-link:hover {
            color: #fff;
            background: var(--primary);
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .badge-quartile,
        .badge-soft,
        .badge-success,
        .badge-book {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 5px 9px;
            border-radius: 999px;
            font-weight: 900;
            font-size: 11px;
            line-height: 1.2;
            white-space: nowrap;
        }

        .badge-quartile {
            color: var(--primary);
            background: var(--yellow);
        }

        .badge-soft {
            color: var(--primary);
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
        }

        .badge-success {
            color: var(--success);
            background: var(--success-bg);
            border: 1px solid rgba(22, 163, 74, .16);
        }

        .badge-book {
            color: var(--warning-text);
            background: var(--warning-bg);
            border: 1px solid rgba(180, 83, 9, .12);
        }

        .money-text {
            color: var(--success);
            font-weight: 900;
        }

        .isbn-text {
            color: var(--muted);
            font-family: monospace;
            font-size: 12px;
            font-weight: 900;
        }

        .empty-text {
            padding: 42px 18px !important;
            text-align: center;
            color: var(--muted);
            font-size: 14px;
            font-style: italic;
            font-weight: 700;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width: 1024px) {
            .identity-card-grid {
                grid-template-columns: 1fr;
            }

            .profile-photo-section {
                border-right: 0;
                border-bottom: 1px solid rgba(226, 232, 240, .95);
                display: flex;
                align-items: center;
                gap: 22px;
            }

            .profile-photo-frame {
                width: 190px;
                flex: 0 0 190px;
            }

            .profile-photo-caption {
                flex: 1;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media(max-width: 768px) {
            .profile-container,
            .profile-main-body {
                width: min(100% - 28px, 1180px);
            }

            .profile-hero {
                min-height: 320px;
                padding: 46px 0 96px;
            }

            .hero-dots {
                left: 14px;
                top: 12px;
                width: 90px;
                height: 70px;
                background-size: 16px 16px;
                opacity: .34;
            }

            .hero-line {
                display: none;
            }

            .btn-back {
                margin-bottom: 18px;
                padding: 10px 14px;
                font-size: 12px;
            }

            .profile-tag {
                font-size: 12px;
                padding: 8px 12px;
            }

            .profile-hero-title {
                font-size: 31px;
                letter-spacing: -.6px;
            }

            .profile-meta span {
                font-size: 12px;
                padding: 8px 10px;
            }

            .profile-main-body {
                margin-top: -48px;
                margin-bottom: 70px;
                gap: 22px;
            }

            .content-block {
                border-radius: 24px;
            }

            .profile-photo-section {
                flex-direction: column;
                text-align: center;
                padding: 24px;
            }

            .profile-photo-frame {
                width: 170px;
                flex-basis: auto;
            }

            .profile-identity-content {
                padding: 24px;
            }

            .profile-content-heading {
                flex-direction: column;
            }

            .profile-heading-title {
                align-items: flex-start;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .table-profile,
            .table-profile tbody,
            .table-profile tr,
            .table-profile td {
                display: block;
                width: 100% !important;
            }

            .table-profile {
                border-spacing: 0;
            }

            .table-profile tr {
                margin-bottom: 12px;
                border-radius: 18px;
                overflow: hidden;
                border: 1px solid #eef2f7;
            }

            .table-profile td.label,
            .table-profile td.value {
                border: 0;
                border-radius: 0;
            }

            .table-profile td.label {
                padding-bottom: 4px;
            }

            .table-profile td.value {
                padding-top: 4px;
            }

            .tabs-container-wrap {
                border-radius: 20px;
                padding: 10px;
            }

            .tab-btn {
                min-width: 138px;
            }

            .research-card {
                padding: 22px;
            }

            .tab-header {
                flex-direction: column;
            }

            .chart-container {
                height: 230px;
            }
        }

        @media(max-width: 480px) {
            .profile-hero {
                min-height: 310px;
            }

            .profile-hero-title {
                font-size: 29px;
            }

            .profile-heading-icon {
                width: 42px;
                height: 42px;
                flex-basis: 42px;
                border-radius: 14px;
            }

            .profile-heading-title h2 {
                font-size: 19px;
            }

            .profile-heading-title p {
                font-size: 13px;
            }

            .stats-grid {
                gap: 9px;
            }

            .stat-box {
                padding: 16px 8px;
            }

            .stat-number {
                font-size: 20px;
            }

            .research-card {
                padding: 18px;
            }

            .card-chart-wrapper {
                padding: 18px;
                border-radius: 20px;
            }
        }
    </style>
</head>

<body>

    @include('component.header')

    <main class="profile-page">

        <section class="profile-hero">
            <div class="hero-dots"></div>
            <div class="hero-line"></div>

            <div class="profile-container">
                <div class="hero-inner">
                    <a href="{{ route('riset.dosen') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali ke Daftar Dosen</span>
                    </a>

                    <div class="profile-tag">
                        <i class="fas fa-user-tie"></i>
                        <span>Profil Resmi Pascasarjana</span>
                    </div>

                    <h1 class="profile-hero-title">{{ $dosen->nama }}</h1>

                    <div class="profile-meta">
                        <span>
                            <i class="fas fa-id-badge"></i>
                            SINTA ID: <strong>{{ $dosen->sinta_id }}</strong>
                        </span>

                        <span>
                            <i class="fas fa-graduation-cap"></i>
                            {{ $dosen->program_studi }}
                        </span>

                        <span>
                            <i class="fas fa-university"></i>
                            {{ $dosen->institusi ?? 'Universitas Ngudi Waluyo' }}
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

        <section class="profile-main-body">

            <article class="content-block identity-card-grid">
                <div class="profile-photo-section">
                    <div class="profile-photo-frame">
                        @if($dosen->profile_photo)
                            <img src="{{ asset('assets/images/' . $dosen->profile_photo) }}" alt="{{ $dosen->nama }}">
                        @else
                            <img src="{{ asset('assets/images/default-user.png') }}" alt="{{ $dosen->nama }}">
                        @endif
                    </div>

                    <div class="profile-photo-caption">
                        <span>
                            <i class="fas fa-user-check"></i>
                            Data Profil Dosen
                        </span>

                        <span>
                            <i class="fas fa-chart-line"></i>
                            Rekap Kinerja SINTA
                        </span>
                    </div>
                </div>

                <div class="profile-identity-content">
                    <div class="profile-content-heading">
                        <div class="profile-heading-title">
                            <div class="profile-heading-icon">
                                <i class="fas fa-address-card"></i>
                            </div>

                            <div>
                                <h2>Identitas Akademik</h2>
                                <p>Informasi dosen, program studi, dan ringkasan skor SINTA.</p>
                            </div>
                        </div>
                    </div>

                    <div class="stats-grid">
                        <div class="stat-box">
                            <div class="stat-number">{{ number_format($dosen->sinta_score_overall ?? 0) }}</div>
                            <div class="stat-desc">Overall Score</div>
                        </div>

                        <div class="stat-box">
                            <div class="stat-number">{{ number_format($dosen->sinta_score_3yr ?? 0) }}</div>
                            <div class="stat-desc">3 Year Score</div>
                        </div>

                        <div class="stat-box">
                            <div class="stat-number">{{ number_format($dosen->affil_score ?? 0) }}</div>
                            <div class="stat-desc">Affil Score</div>
                        </div>

                        <div class="stat-box">
                            <div class="stat-number">{{ number_format($dosen->affil_score_3yr ?? 0) }}</div>
                            <div class="stat-desc">Affil 3Yr</div>
                        </div>
                    </div>

                    <h3 class="block-title">Biodata Akademik</h3>

                    <table class="table-profile">
                        <tr>
                            <td class="label">Nama Lengkap</td>
                            <td class="value highlight">{{ $dosen->nama }}</td>
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
            </article>

            <div class="tabs-container-wrap">
                <div class="tabs-container">
                    <button class="tab-btn active" type="button" onclick="switchTab(event, 'scopus')">
                        <i class="fas fa-globe"></i>
                        Scopus
                    </button>

                    <button class="tab-btn" type="button" onclick="switchTab(event, 'scholar')">
                        <i class="fas fa-graduation-cap"></i>
                        Scholar
                    </button>

                    <button class="tab-btn" type="button" onclick="switchTab(event, 'garuda')">
                        <i class="fas fa-book-open"></i>
                        Garuda
                    </button>

                    <button class="tab-btn" type="button" onclick="switchTab(event, 'research')">
                        <i class="fas fa-search"></i>
                        Penelitian
                    </button>

                    <button class="tab-btn" type="button" onclick="switchTab(event, 'service')">
                        <i class="fas fa-hands-helping"></i>
                        Pengabdian
                    </button>

                    <button class="tab-btn" type="button" onclick="switchTab(event, 'books')">
                        <i class="fas fa-book"></i>
                        Buku
                    </button>
                </div>
            </div>

            <section class="research-layout">

                <div id="scopus" class="tab-content active content-block research-card">
                    <div class="tab-header">
                        <div>
                            <h2 class="block-title">Publikasi Internasional Scopus</h2>
                            <p>Daftar publikasi internasional terindeks Scopus beserta jurnal, tahun, quartile, dan jumlah sitasi.</p>
                        </div>

                        <div class="tab-badge">
                            <i class="fas fa-database"></i>
                            {{ $dosen->scopusPublications->count() ?? 0 }} Data
                        </div>
                    </div>

                    <div class="card-chart-wrapper">
                        <div class="chart-title">
                            <i class="fas fa-chart-line"></i>
                            Perkembangan Publikasi Tahunan Scopus
                        </div>
                        <div class="chart-container">
                            <canvas id="scopusChart"></canvas>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th style="width: 52px; text-align: center;">No</th>
                                    <th>Artikel & Info Jurnal</th>
                                    <th style="width: 130px; text-align: center;">Tahun / Q</th>
                                    <th style="width: 90px; text-align: center;">Sitasi</th>
                                    <th style="width: 100px; text-align: center;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($dosen->scopusPublications as $index => $scopus)
                                    <tr>
                                        <td class="table-number">{{ $index + 1 }}</td>

                                        <td>
                                            <div class="pub-title">{{ $scopus->judul }}</div>
                                            <div class="pub-muted">Jurnal: {{ $scopus->journal }}</div>
                                            <div class="pub-muted">Penulis ke-{{ $scopus->author_order }} atau {{ $scopus->creator ?? '-' }}</div>
                                        </td>

                                        <td style="text-align: center;">
                                            <strong>{{ $scopus->tahun }}</strong>
                                            @if($scopus->quartile)
                                                <br>
                                                <span class="badge-quartile" style="margin-top: 6px;">{{ $scopus->quartile }}</span>
                                            @endif
                                        </td>

                                        <td style="text-align: center; font-weight: 900; color: var(--primary);">
                                            {{ $scopus->citation }}
                                        </td>

                                        <td style="text-align: center;">
                                            @if($scopus->url_artikel)
                                                <a href="{{ $scopus->url_artikel }}" target="_blank" class="pub-link">
                                                    <i class="fas fa-external-link-alt"></i>
                                                    Link
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="empty-text">Tidak ada data publikasi Scopus.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="scholar" class="tab-content content-block research-card">
                    <div class="tab-header">
                        <div>
                            <h2 class="block-title">Publikasi Google Scholar</h2>
                            <p>Daftar publikasi yang terindeks Google Scholar beserta penulis, sumber, tahun, dan sitasi.</p>
                        </div>

                        <div class="tab-badge">
                            <i class="fas fa-database"></i>
                            {{ $dosen->scholarPublications->count() ?? 0 }} Data
                        </div>
                    </div>

                    <div class="card-chart-wrapper">
                        <div class="chart-title">
                            <i class="fas fa-chart-line"></i>
                            Perkembangan Publikasi Tahunan Google Scholar
                        </div>
                        <div class="chart-container">
                            <canvas id="scholarChart"></canvas>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th style="width: 52px; text-align: center;">No</th>
                                    <th>Judul Dokumen & Sumber</th>
                                    <th style="width: 90px; text-align: center;">Tahun</th>
                                    <th style="width: 90px; text-align: center;">Sitasi</th>
                                    <th style="width: 100px; text-align: center;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($dosen->scholarPublications as $index => $scholar)
                                    <tr>
                                        <td class="table-number">{{ $index + 1 }}</td>

                                        <td>
                                            <div class="pub-title">{{ $scholar->judul }}</div>
                                            <div class="pub-muted">Penulis: {{ $scholar->authors }}</div>
                                            @if($scholar->source)
                                                <div class="pub-muted">Sumber: {{ $scholar->source }}</div>
                                            @endif
                                        </td>

                                        <td style="text-align: center; font-weight: 900;">{{ $scholar->tahun }}</td>

                                        <td style="text-align: center; font-weight: 900; color: var(--primary);">
                                            {{ $scholar->citation }}
                                        </td>

                                        <td style="text-align: center;">
                                            @if($scholar->url_scholar)
                                                <a href="{{ $scholar->url_scholar }}" target="_blank" class="pub-link">
                                                    <i class="fas fa-external-link-alt"></i>
                                                    Link
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="empty-text">Tidak ada data publikasi Google Scholar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="garuda" class="tab-content content-block research-card">
                    <div class="tab-header">
                        <div>
                            <h2 class="block-title">Publikasi Nasional Garuda</h2>
                            <p>Daftar publikasi nasional terindeks Garuda beserta jurnal, penerbit, tahun, dan akreditasi.</p>
                        </div>

                        <div class="tab-badge">
                            <i class="fas fa-database"></i>
                            {{ $dosen->garudaPublications->count() ?? 0 }} Data
                        </div>
                    </div>

                    <div class="card-chart-wrapper">
                        <div class="chart-title">
                            <i class="fas fa-chart-line"></i>
                            Perkembangan Publikasi Tahunan Garuda
                        </div>
                        <div class="chart-container">
                            <canvas id="garudaChart"></canvas>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th style="width: 52px; text-align: center;">No</th>
                                    <th>Judul Jurnal & Penerbit</th>
                                    <th style="width: 90px; text-align: center;">Tahun</th>
                                    <th style="width: 120px; text-align: center;">Akreditasi</th>
                                    <th style="width: 100px; text-align: center;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($dosen->garudaPublications as $index => $garuda)
                                    <tr>
                                        <td class="table-number">{{ $index + 1 }}</td>

                                        <td>
                                            <div class="pub-title">{{ $garuda->judul }}</div>
                                            <div class="pub-muted">Jurnal: {{ $garuda->journal }}</div>
                                            <div class="pub-muted">Penerbit: {{ $garuda->publisher ?? '-' }}</div>
                                        </td>

                                        <td style="text-align: center; font-weight: 900;">{{ $garuda->tahun }}</td>

                                        <td style="text-align: center;">
                                            <span class="badge-soft">{{ $garuda->accreditation ?? '-' }}</span>
                                        </td>

                                        <td style="text-align: center;">
                                            @if($garuda->url_artikel)
                                                <a href="{{ $garuda->url_artikel }}" target="_blank" class="pub-link">
                                                    <i class="fas fa-external-link-alt"></i>
                                                    Link
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="empty-text">Tidak ada data publikasi Garuda.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="research" class="tab-content content-block research-card">
                    <div class="tab-header">
                        <div>
                            <h2 class="block-title">Histori Proyek Penelitian</h2>
                            <p>Riwayat penelitian dosen berdasarkan judul, skema, pendanaan, tahun, dan status kegiatan.</p>
                        </div>

                        <div class="tab-badge">
                            <i class="fas fa-database"></i>
                            {{ $dosen->researches->count() ?? 0 }} Data
                        </div>
                    </div>

                    <div class="card-chart-wrapper">
                        <div class="chart-title">
                            <i class="fas fa-chart-line"></i>
                            Grafik Perkembangan Proyek Penelitian Pertahun
                        </div>
                        <div class="chart-container">
                            <canvas id="researchChart"></canvas>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th style="width: 52px; text-align: center;">No</th>
                                    <th>Judul Penelitian & Skema</th>
                                    <th style="width: 90px; text-align: center;">Tahun</th>
                                    <th>Pendanaan</th>
                                    <th style="width: 110px; text-align: center;">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($dosen->researches as $index => $res)
                                    <tr>
                                        <td class="table-number">{{ $index + 1 }}</td>

                                        <td>
                                            <div class="pub-title">{{ $res->judul }}</div>
                                            <div class="pub-primary">Skema: {{ $res->skema ?? '-' }}</div>
                                            <div class="pub-muted">Ketua: {{ $res->leader }} | Personil: {{ $res->personils ?? '-' }}</div>
                                        </td>

                                        <td style="text-align: center; font-weight: 900;">{{ $res->tahun }}</td>

                                        <td>
                                            <span class="money-text">{{ $res->dana ?? '-' }}</span>
                                        </td>

                                        <td style="text-align: center;">
                                            <span class="badge-success">{{ $res->status ?? 'Selesai' }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="empty-text">Tidak ada data histori penelitian.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="service" class="tab-content content-block research-card">
                    <div class="tab-header">
                        <div>
                            <h2 class="block-title">Histori Pengabdian Masyarakat</h2>
                            <p>Riwayat kegiatan pengabdian masyarakat berdasarkan judul, skema, pendanaan, tahun, dan status kegiatan.</p>
                        </div>

                        <div class="tab-badge">
                            <i class="fas fa-database"></i>
                            {{ $dosen->services->count() ?? 0 }} Data
                        </div>
                    </div>

                    <div class="card-chart-wrapper">
                        <div class="chart-title">
                            <i class="fas fa-chart-line"></i>
                            Grafik Perkembangan Proyek Pengabdian Pertahun
                        </div>
                        <div class="chart-container">
                            <canvas id="serviceChart"></canvas>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th style="width: 52px; text-align: center;">No</th>
                                    <th>Judul Pengabdian & Kegiatan</th>
                                    <th style="width: 90px; text-align: center;">Tahun</th>
                                    <th>Pendanaan</th>
                                    <th style="width: 110px; text-align: center;">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($dosen->services as $index => $serv)
                                    <tr>
                                        <td class="table-number">{{ $index + 1 }}</td>

                                        <td>
                                            <div class="pub-title">{{ $serv->judul }}</div>
                                            <div class="pub-primary">Skema: {{ $serv->skema ?? '-' }}</div>
                                            <div class="pub-muted">Ketua: {{ $serv->leader }} | Personil: {{ $serv->personils ?? '-' }}</div>
                                        </td>

                                        <td style="text-align: center; font-weight: 900;">{{ $serv->tahun }}</td>

                                        <td>
                                            <span class="money-text">{{ $serv->dana ?? '-' }}</span>
                                        </td>

                                        <td style="text-align: center;">
                                            <span class="badge-success">{{ $serv->status ?? 'Selesai' }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="empty-text">Tidak ada data histori pengabdian masyarakat.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="books" class="tab-content content-block research-card">
                    <div class="tab-header">
                        <div>
                            <h2 class="block-title">Buku Karya Dosen Terdaftar</h2>
                            <p>Daftar buku karya dosen beserta kategori, tahun terbit, penerbit, kota, dan ISBN.</p>
                        </div>

                        <div class="tab-badge">
                            <i class="fas fa-database"></i>
                            {{ $dosen->books->count() ?? 0 }} Data
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th style="width: 52px; text-align: center;">No</th>
                                    <th>Judul & Kategori Buku</th>
                                    <th style="width: 90px; text-align: center;">Tahun</th>
                                    <th>Penerbit</th>
                                    <th style="width: 150px; text-align: center;">ISBN</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($dosen->books as $index => $book)
                                    <tr>
                                        <td class="table-number">{{ $index + 1 }}</td>

                                        <td>
                                            <div class="pub-title">{{ $book->judul }}</div>
                                            <span class="badge-book">{{ $book->kategori ?? 'Umum' }}</span>
                                        </td>

                                        <td style="text-align: center; font-weight: 900;">{{ $book->tahun }}</td>

                                        <td>
                                            <div class="pub-title" style="margin-bottom: 0;">{{ $book->penerbit }}</div>
                                            <div class="pub-muted">{{ $book->kota ?? '-' }}</div>
                                        </td>

                                        <td style="text-align: center;">
                                            <span class="isbn-text">{{ $book->isbn ?? '-' }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="empty-text">Tidak ada data buku terdaftar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
        </section>
    </main>

    @include('component.footer')

    <script>
        let activeCharts = {};

        const chartDefaultOptions = {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 1000,
                easing: 'easeOutQuart'
            },
            interaction: {
                mode: 'index',
                intersect: false
            },
            plugins: {
                legend: {
                    labels: {
                        usePointStyle: true,
                        boxWidth: 8,
                        color: '#334155',
                        font: {
                            family: 'Montserrat',
                            weight: '700'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: '#031f42',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    padding: 12,
                    cornerRadius: 12
                }
            },
            scales: {
                x: {
                    grid: {
                        color: 'rgba(148, 163, 184, .18)'
                    },
                    ticks: {
                        color: '#64748b',
                        font: {
                            family: 'Montserrat',
                            weight: '700'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(148, 163, 184, .18)'
                    },
                    ticks: {
                        precision: 0,
                        color: '#64748b',
                        font: {
                            family: 'Montserrat',
                            weight: '700'
                        }
                    }
                }
            }
        };

        function createLineChart(canvasId, tabId, labels, datasets) {
            const canvas = document.getElementById(canvasId);

            if (!canvas) {
                return;
            }

            if (activeCharts[tabId]) {
                activeCharts[tabId].destroy();
            }

            activeCharts[tabId] = new Chart(canvas, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: chartDefaultOptions
            });
        }

        function buildDataset(label, data, color) {
            return {
                label: label,
                data: data,
                borderColor: color,
                backgroundColor: color.replace('1)', '.08)').replace('rgb', 'rgba'),
                fill: true,
                tension: 0.35,
                borderWidth: 3,
                pointBackgroundColor: color,
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            };
        }

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
            if (tabId === 'scopus') {
                createLineChart(
                    'scopusChart',
                    'scopus',
                    {!! json_encode($dosen->scopusYearlyStats ? $dosen->scopusYearlyStats->pluck('tahun') : []) !!},
                    [
                        buildDataset(
                            'Jumlah Publikasi',
                            {!! json_encode($dosen->scopusYearlyStats ? $dosen->scopusYearlyStats->pluck('jumlah') : []) !!},
                            'rgb(239, 68, 68)'
                        )
                    ]
                );
            }

            if (tabId === 'scholar') {
                createLineChart(
                    'scholarChart',
                    'scholar',
                    {!! json_encode($dosen->scholarYearlyStats ? $dosen->scholarYearlyStats->pluck('tahun') : []) !!},
                    [
                        buildDataset(
                            'Jumlah Publikasi',
                            {!! json_encode($dosen->scholarYearlyStats ? $dosen->scholarYearlyStats->pluck('publications') : []) !!},
                            'rgb(7, 43, 87)'
                        ),
                        buildDataset(
                            'Jumlah Sitasi',
                            {!! json_encode($dosen->scholarYearlyStats ? $dosen->scholarYearlyStats->pluck('citations') : []) !!},
                            'rgb(247, 181, 0)'
                        )
                    ]
                );
            }

            if (tabId === 'garuda') {
                createLineChart(
                    'garudaChart',
                    'garuda',
                    {!! json_encode($dosen->garudaYearlyStats ? $dosen->garudaYearlyStats->pluck('tahun') : []) !!},
                    [
                        buildDataset(
                            'Jumlah Artikel',
                            {!! json_encode($dosen->garudaYearlyStats ? $dosen->garudaYearlyStats->pluck('articles') : []) !!},
                            'rgb(16, 185, 129)'
                        )
                    ]
                );
            }

            if (tabId === 'research') {
                createLineChart(
                    'researchChart',
                    'research',
                    {!! json_encode($dosen->researchYearlies ? $dosen->researchYearlies->pluck('tahun') : []) !!},
                    [
                        buildDataset(
                            'Proyek Penelitian',
                            {!! json_encode($dosen->researchYearlies ? $dosen->researchYearlies->pluck('jumlah') : []) !!},
                            'rgb(59, 130, 246)'
                        )
                    ]
                );
            }

            if (tabId === 'service') {
                createLineChart(
                    'serviceChart',
                    'service',
                    {!! json_encode($dosen->serviceYearlies ? $dosen->serviceYearlies->pluck('tahun') : []) !!},
                    [
                        buildDataset(
                            'Proyek Pengabdian',
                            {!! json_encode($dosen->serviceYearlies ? $dosen->serviceYearlies->pluck('jumlah') : []) !!},
                            'rgb(245, 158, 11)'
                        )
                    ]
                );
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            initSpecificChart('scopus');
        });
    </script>
</body>

</html>