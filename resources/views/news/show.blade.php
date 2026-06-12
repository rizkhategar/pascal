<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita - Pascasarjana UNW</title>

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

            --shadow-sm: 0 10px 28px rgba(15, 23, 42, .07);
            --shadow-md: 0 20px 55px rgba(15, 23, 42, .12);
            --shadow-lg: 0 30px 80px rgba(15, 23, 42, .16);
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
                radial-gradient(circle at 8% 12%, rgba(45, 156, 219, .08), transparent 26%),
                linear-gradient(180deg, #ffffff 0%, #f8fafc 44%, #eef5fb 100%);
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
            min-height: 360px;
            display: flex;
            align-items: center;
            color: #fff;
            padding: 58px 0 112px;
            background:
                radial-gradient(circle at 13% 18%, rgba(45, 156, 219, .42), transparent 26%),
                radial-gradient(circle at 82% 16%, rgba(255, 255, 255, .18), transparent 23%),
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
            max-width: 1020px;
        }

        .back-link {
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

        .back-link:hover {
            transform: translateX(-5px);
            background: var(--yellow);
            border-color: var(--yellow);
            color: var(--primary) !important;
        }

        .news-category-pill {
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

        .news-title-page {
            max-width: 1040px;
            margin: 0 0 18px;
            color: #fff;
            font-size: clamp(31px, 4.7vw, 56px);
            line-height: 1.06;
            font-weight: 900;
            letter-spacing: -1px;
        }

        .news-meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .news-meta span {
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

        .news-meta i {
            color: var(--yellow);
        }

        /* ================= CONTENT ================= */

        .news-content-section {
            position: relative;
            z-index: 5;
            margin-top: -58px;
            padding: 0 0 92px;
        }

        .news-detail-shell {
            width: min(100% - 64px, 1120px);
            margin: 0 auto;
        }

        .news-card-detail {
            width: 100%;
            overflow: hidden;
            border-radius: 30px;
            background: var(--white);
            border: 1px solid rgba(226, 232, 240, .95);
            box-shadow: var(--shadow-lg);
        }

        .news-cover-wrap {
            position: relative;
            width: 100%;
            overflow: hidden;
            background:
                linear-gradient(135deg, rgba(6, 47, 95, .10), rgba(45, 156, 219, .10)),
                #eef2f7;
        }

        .news-cover-wrap::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 45%, rgba(3, 31, 66, .26));
            pointer-events: none;
        }

        .news-cover {
            width: 100%;
            height: clamp(280px, 42vw, 520px);
            object-fit: cover;
            object-position: center;
            display: block;
            border: 0 !important;
            outline: 0 !important;
            box-shadow: none !important;
            border-radius: 0 !important;
            margin: 0;
            padding: 0;
        }

        .news-no-cover {
            min-height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                radial-gradient(circle at 25% 22%, rgba(45, 156, 219, .16), transparent 28%),
                linear-gradient(135deg, #eef6ff, #f8fafc);
        }

        .news-no-cover i {
            width: 76px;
            height: 76px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 26px;
            color: var(--primary);
            background: rgba(6, 47, 95, .08);
            font-size: 34px;
        }

        .news-toolbar-detail {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 22px 28px;
            background:
                linear-gradient(135deg, rgba(6, 47, 95, .08), rgba(45, 156, 219, .08)),
                #ffffff;
            border-bottom: 1px solid rgba(226, 232, 240, .95);
        }

        .news-toolbar-title {
            display: flex;
            align-items: center;
            gap: 13px;
            min-width: 0;
        }

        .news-toolbar-icon {
            width: 44px;
            height: 44px;
            flex: 0 0 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--blue));
            box-shadow: 0 12px 26px rgba(6, 47, 95, .22);
        }

        .news-toolbar-title h2 {
            margin: 0 0 4px;
            color: var(--text);
            font-size: 20px;
            line-height: 1.2;
            font-weight: 900;
        }

        .news-toolbar-title p {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.45;
            font-weight: 600;
        }

        .news-toolbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .news-action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 10px 15px;
            border-radius: 999px;
            border: 1px solid rgba(6, 47, 95, .14);
            background: #fff;
            color: var(--primary);
            font-size: 13px;
            font-weight: 900;
            text-decoration: none;
            cursor: pointer;
            transition: .22s ease;
        }

        .news-action-btn:hover {
            color: #fff;
            background: var(--primary);
            transform: translateY(-2px);
        }

        .news-body {
            max-width: 940px;
            margin: 0 auto;
            padding: 46px 50px 62px;
        }

        .news-excerpt-detail {
            position: relative;
            margin: 0 0 32px;
            padding: 24px 26px 24px 70px;
            border-radius: 24px;
            color: #334155;
            background:
                linear-gradient(135deg, rgba(6, 47, 95, .07), rgba(247, 181, 0, .11)),
                #ffffff;
            border: 1px solid rgba(226, 232, 240, .95);
            box-shadow: 0 16px 38px rgba(15, 23, 42, .07);
            font-size: 17px;
            line-height: 1.75;
            font-weight: 800;
        }

        .news-excerpt-detail::before {
            content: "\f10d";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            left: 25px;
            top: 24px;
            color: var(--yellow);
            font-size: 28px;
        }

        /* ================= API HTML CONTENT ================= */

        .news-content-html {
            color: #1f2937;
            font-size: 17px;
            line-height: 1.9;
            word-break: break-word;
        }

        .news-content-html > *:first-child {
            margin-top: 0 !important;
        }

        .news-content-html > *:last-child {
            margin-bottom: 0 !important;
        }

        .news-content-html p {
            margin: 0 0 20px;
            color: #334155;
        }

        .news-content-html a {
            color: var(--blue);
            font-weight: 800;
            text-decoration: none;
            border-bottom: 1px solid rgba(11, 95, 159, .35);
        }

        .news-content-html a:hover {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .news-content-html h1,
        .news-content-html h2,
        .news-content-html h3,
        .news-content-html h4,
        .news-content-html h5,
        .news-content-html h6 {
            color: var(--primary);
            line-height: 1.25;
            font-weight: 900;
            letter-spacing: -.3px;
        }

        .news-content-html h1 {
            font-size: clamp(30px, 3.2vw, 42px);
            margin: 38px 0 18px;
        }

        .news-content-html h2 {
            font-size: clamp(26px, 2.7vw, 34px);
            margin: 36px 0 16px;
        }

        .news-content-html h3 {
            font-size: clamp(22px, 2.3vw, 28px);
            margin: 32px 0 14px;
        }

        .news-content-html h4 {
            position: relative;
            display: inline-flex;
            margin: 32px 0 16px;
            padding-bottom: 10px;
            color: var(--primary);
            font-size: 22px;
        }

        .news-content-html h4::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 82px;
            height: 4px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--yellow), var(--blue));
        }

        .news-content-html ul,
        .news-content-html ol {
            margin: 0 0 24px;
            padding-left: 0;
            list-style: none;
            display: grid;
            gap: 10px;
        }

        .news-content-html li {
            position: relative;
            padding: 12px 14px 12px 44px;
            border-radius: 16px;
            color: #334155;
            background: #f8fafc;
            border: 1px solid #eef2f7;
            line-height: 1.65;
        }

        .news-content-html ul li::before {
            content: "\f00c";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            left: 14px;
            top: 13px;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--blue));
            font-size: 11px;
        }

        .news-content-html ol {
            counter-reset: news-counter;
        }

        .news-content-html ol li {
            counter-increment: news-counter;
        }

        .news-content-html ol li::before {
            content: counter(news-counter);
            position: absolute;
            left: 14px;
            top: 13px;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--blue));
            font-size: 12px;
            font-weight: 900;
        }

        .news-content-html blockquote {
            position: relative;
            margin: 28px 0;
            padding: 24px 26px 24px 68px;
            border-radius: 22px;
            color: #334155;
            background:
                linear-gradient(135deg, rgba(6, 47, 95, .07), rgba(247, 181, 0, .10)),
                #ffffff;
            border: 1px solid rgba(226, 232, 240, .9);
            box-shadow: 0 14px 34px rgba(15, 23, 42, .06);
        }

        .news-content-html blockquote::before {
            content: "\f10d";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            left: 24px;
            top: 24px;
            color: var(--yellow);
            font-size: 26px;
        }

        .news-content-html img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 28px auto;
            border: 0 !important;
            outline: 0 !important;
            border-radius: 22px !important;
            box-shadow: 0 18px 42px rgba(15, 23, 42, .12) !important;
        }

        .news-content-html iframe {
            width: 100%;
            min-height: 420px;
            border: 0;
            border-radius: 22px;
            box-shadow: 0 18px 42px rgba(15, 23, 42, .12);
        }

        .news-content-html table {
            width: 100% !important;
            margin: 28px 0 !important;
            border-collapse: collapse !important;
            border-spacing: 0 !important;
            overflow: hidden;
            border-radius: 18px;
            box-shadow: 0 14px 34px rgba(15, 23, 42, .08);
            background: #fff !important;
        }

        .news-content-html table th {
            color: #fff !important;
            background: linear-gradient(135deg, var(--primary), var(--blue)) !important;
            font-weight: 900 !important;
            text-align: left;
        }

        .news-content-html table th,
        .news-content-html table td {
            padding: 14px 16px !important;
            border: 1px solid #e2e8f0 !important;
            vertical-align: top;
            color: #334155;
            line-height: 1.55;
        }

        .news-content-html table tr:nth-child(even) td {
            background: #f8fafc !important;
        }

        .news-content-html table img {
            width: 100%;
            height: auto;
            margin: 0 !important;
            border-radius: 16px !important;
            box-shadow: none !important;
        }

        .news-content-html hr {
            margin: 34px 0;
            border: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, #cbd5e1, transparent);
        }

        /* ================= STATES ================= */

        .loading-news,
        .empty-news {
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            gap: 14px;
            padding: 42px;
            color: var(--muted);
            background:
                linear-gradient(135deg, rgba(6, 47, 95, .05), rgba(45, 156, 219, .05)),
                #ffffff;
            font-weight: 800;
            line-height: 1.7;
        }

        .detail-loader {
            width: 48px;
            height: 48px;
            border: 4px solid #e5e7eb;
            border-top-color: var(--yellow);
            border-right-color: var(--primary);
            border-radius: 50%;
            animation: spin .8s linear infinite;
        }

        .empty-news i {
            width: 62px;
            height: 62px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 22px;
            background: rgba(6, 47, 95, .08);
            color: var(--primary);
            font-size: 26px;
        }

        .empty-news strong {
            display: block;
            color: var(--text);
            font-size: 20px;
            line-height: 1.3;
        }

        .empty-news span {
            display: block;
            max-width: 540px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width: 768px) {
            .container {
                width: min(100% - 28px, 1180px);
            }

            .news-hero {
                min-height: 330px;
                padding: 44px 0 96px;
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

            .back-link {
                margin-bottom: 18px;
                padding: 10px 14px;
                font-size: 12px;
            }

            .news-category-pill {
                font-size: 12px;
                padding: 8px 12px;
                margin-bottom: 14px;
            }

            .news-title-page {
                letter-spacing: -.6px;
            }

            .news-meta span {
                font-size: 13px;
                padding: 8px 10px;
            }

            .news-content-section {
                margin-top: -48px;
                padding-bottom: 70px;
            }

            .news-detail-shell {
                width: min(100% - 24px, 1180px);
            }

            .news-card-detail {
                border-radius: 24px;
            }

            .news-cover {
                height: 260px;
            }

            .news-toolbar-detail {
                align-items: flex-start;
                flex-direction: column;
                padding: 20px;
            }

            .news-toolbar-actions {
                width: 100%;
            }

            .news-action-btn {
                width: 100%;
            }

            .news-body {
                padding: 30px 20px 44px;
            }

            .news-excerpt-detail {
                padding: 22px 22px 22px 60px;
                font-size: 15px;
                border-radius: 20px;
            }

            .news-excerpt-detail::before {
                left: 22px;
                top: 22px;
                font-size: 23px;
            }

            .news-content-html {
                font-size: 16px;
                line-height: 1.8;
            }

            .news-content-html table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .news-content-html iframe {
                min-height: 320px;
            }
        }

        @media(max-width: 480px) {
            .news-hero {
                min-height: 310px;
            }

            .news-title-page {
                font-size: 30px;
            }

            .news-toolbar-title {
                align-items: flex-start;
            }

            .news-toolbar-icon {
                width: 40px;
                height: 40px;
                flex-basis: 40px;
                border-radius: 14px;
            }

            .news-toolbar-title h2 {
                font-size: 18px;
            }

            .news-toolbar-title p {
                font-size: 13px;
            }

            .news-content-html li {
                padding: 11px 12px 11px 40px;
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
                <a href="{{ route('news.index') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke Berita</span>
                </a>

                <div class="news-category-pill" id="newsCategory">
                    <i class="fas fa-tag"></i>
                    <span>Berita</span>
                </div>

                <h1 class="news-title-page" id="newsTitle">Detail Berita</h1>

                <div class="news-meta" id="newsMeta"></div>
            </div>
        </div>

        <div class="hero-wave">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path d="M0,74 C180,122 384,36 650,62 C930,90 1120,128 1440,44 L1440,120 L0,120 Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

    <main class="news-content-section">
        <div class="news-detail-shell">
            <article class="news-card-detail" id="newsCard">
                <div class="loading-news">
                    <div class="detail-loader"></div>
                    <span>Memuat detail berita...</span>
                </div>
            </article>
        </div>
    </main>

    @include('component.footer')

    <script>
        (function () {
            const slug = @json($slug);
            const API_ORIGIN = 'https://panel-web.unw.ac.id';
            const API_NEWS = API_ORIGIN + '/api/news';

            const newsCard = document.getElementById('newsCard');
            const newsTitle = document.getElementById('newsTitle');
            const newsCategory = document.getElementById('newsCategory');
            const newsMeta = document.getElementById('newsMeta');

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

            function toArray(payload) {
                if (Array.isArray(payload)) return payload;
                if (Array.isArray(payload?.data)) return payload.data;
                if (Array.isArray(payload?.data?.data)) return payload.data.data;
                return [];
            }

            function extractItem(payload) {
                if (payload?.slug || payload?.id) return payload;
                if (payload?.data?.slug || payload?.data?.id) return payload.data;

                const list = toArray(payload);

                return list.find(function (item) {
                    return item?.slug === slug;
                }) || list[0] || null;
            }

            function formatDate(value) {
                if (!value) return '';

                const date = new Date(value);

                if (Number.isNaN(date.getTime())) {
                    return String(value);
                }

                return date.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                });
            }

            function imageUrl(url) {
                if (!url) return '';

                url = String(url);

                if (/^https?:\/\//i.test(url)) {
                    return url;
                }

                if (url.startsWith('/')) {
                    return API_ORIGIN + url;
                }

                return API_ORIGIN + '/' + url.replace(/^\/+/, '');
            }

            async function getJson(url) {
                const response = await fetch(url, {
                    headers: {
                        Accept: 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('API gagal dimuat');
                }

                return response.json();
            }

            async function tryGet(url) {
                try {
                    return await getJson(url);
                } catch (error) {
                    return null;
                }
            }

            async function findNewsBySlug() {
                const encodedSlug = encodeURIComponent(slug);

                const direct = await tryGet(API_NEWS + '/' + encodedSlug);
                const directItem = direct ? extractItem(direct) : null;

                if (directItem && (!directItem.slug || directItem.slug === slug)) {
                    return directItem;
                }

                const byQuery = await tryGet(API_NEWS + '?slug=' + encodedSlug);
                const queryList = toArray(byQuery);
                const queryItem = queryList.find(function (item) {
                    return item?.slug === slug;
                }) || extractItem(byQuery);

                if (queryItem && (!queryItem.slug || queryItem.slug === slug)) {
                    return queryItem;
                }

                for (let page = 1; page <= 12; page++) {
                    const payload = await tryGet(API_NEWS + '?paginate=100&page=' + page);

                    if (!payload) continue;

                    const item = toArray(payload).find(function (news) {
                        return news?.slug === slug;
                    });

                    if (item) return item;

                    const lastPage = Number(payload?.meta?.last_page || 0);

                    if (lastPage && page >= lastPage) break;
                }

                return null;
            }

            function renderNews(news) {
                const title = news?.title || 'Detail Berita';
                const category = (news?.category?.name || 'Berita').trim();

                const rawImage = news?.image || news?.image_thumbnail || '';
                const image = imageUrl(rawImage);

                const excerpt = strip(news?.excerpt || '');
                const body = news?.content || news?.body || news?.description || '';
                const date = news?.publishedAt || news?.published_at || news?.createdAt || news?.created_at || '';
                const author = news?.author?.name || '';
                const views = news?.views;

                document.title = title + ' - Pascasarjana UNW';

                newsCategory.innerHTML = `
                    <i class="fas fa-tag"></i>
                    <span>${esc(category)}</span>
                `;

                newsTitle.textContent = title;

                const meta = [];

                if (date) {
                    meta.push(`
                        <span>
                            <i class="fas fa-calendar-alt"></i>
                            ${esc(formatDate(date))}
                        </span>
                    `);
                }

                if (author) {
                    meta.push(`
                        <span>
                            <i class="fas fa-user"></i>
                            Oleh: ${esc(author)}
                        </span>
                    `);
                }

                if (views !== undefined && views !== null) {
                    meta.push(`
                        <span>
                            <i class="fas fa-eye"></i>
                            ${esc(views)} dibaca
                        </span>
                    `);
                }

                meta.push(`
                    <span>
                        <i class="fas fa-university"></i>
                        Pascasarjana UNW
                    </span>
                `);

                newsMeta.innerHTML = meta.join('');

                const imageHtml = image
                    ? `
                        <div class="news-cover-wrap">
                            <img src="${esc(image)}" alt="${esc(title)}" class="news-cover">
                        </div>
                    `
                    : `
                        <div class="news-cover-wrap news-no-cover">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    `;

                const excerptHtml = excerpt
                    ? `<p class="news-excerpt-detail">${esc(excerpt)}</p>`
                    : '';

                const bodyHtml = body
                    ? body
                    : `<p>${esc(excerpt || 'Isi lengkap berita belum tersedia.')}</p>`;

                newsCard.innerHTML = `
                    ${imageHtml}

                    <div class="news-toolbar-detail">
                        <div class="news-toolbar-title">
                            <div class="news-toolbar-icon">
                                <i class="fas fa-file-lines"></i>
                            </div>

                            <div>
                                <h2>Detail Berita</h2>
                                <p>Informasi resmi Pascasarjana Universitas Ngudi Waluyo</p>
                            </div>
                        </div>

                        <div class="news-toolbar-actions">
                            <button class="news-action-btn" id="copyLinkButton" type="button">
                                <i class="fas fa-link"></i>
                                <span>Salin Link</span>
                            </button>
                        </div>
                    </div>

                    <div class="news-body">
                        ${excerptHtml}

                        <div class="news-content-html">
                            ${bodyHtml}
                        </div>
                    </div>
                `;

                const copyButton = document.getElementById('copyLinkButton');

                copyButton?.addEventListener('click', async function () {
                    try {
                        await navigator.clipboard.writeText(window.location.href);
                        copyButton.innerHTML = '<i class="fas fa-check"></i><span>Link Tersalin</span>';

                        setTimeout(function () {
                            copyButton.innerHTML = '<i class="fas fa-link"></i><span>Salin Link</span>';
                        }, 1800);
                    } catch (error) {
                        copyButton.innerHTML = '<i class="fas fa-triangle-exclamation"></i><span>Gagal</span>';

                        setTimeout(function () {
                            copyButton.innerHTML = '<i class="fas fa-link"></i><span>Salin Link</span>';
                        }, 1800);
                    }
                });
            }

            function renderError() {
                newsTitle.textContent = 'Berita tidak ditemukan';

                newsCategory.innerHTML = `
                    <i class="fas fa-circle-exclamation"></i>
                    <span>Tidak Ditemukan</span>
                `;

                newsMeta.innerHTML = `
                    <span>
                        <i class="fas fa-university"></i>
                        Pascasarjana UNW
                    </span>
                `;

                newsCard.innerHTML = `
                    <div class="empty-news">
                        <i class="fas fa-triangle-exclamation"></i>
                        <strong>Berita belum dapat dimuat</strong>
                        <span>
                            Berita belum dapat dimuat dari API berdasarkan slug:
                            <strong>${esc(slug)}</strong>.
                            Silakan kembali ke daftar berita atau coba muat ulang halaman beberapa saat lagi.
                        </span>
                    </div>
                `;
            }

            findNewsBySlug()
                .then(function (news) {
                    if (news) {
                        renderNews(news);
                    } else {
                        renderError();
                    }
                })
                .catch(renderError);
        })();
    </script>
</body>

</html>