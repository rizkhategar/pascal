<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Organisasi - Pascasarjana UNW</title>

    <link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
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
            --bg: #f6f9fc;
            --text: #0f172a;
            --text-soft: #334155;
            --muted: #64748b;
            --border: #e2e8f0;

            --shadow-sm: 0 10px 28px rgba(15, 23, 42, .07);
            --shadow-md: 0 18px 46px rgba(15, 23, 42, .10);
            --shadow-lg: 0 28px 70px rgba(15, 23, 42, .15);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 8% 12%, rgba(45, 156, 219, .08), transparent 25%),
                linear-gradient(180deg, #ffffff 0%, #f8fafc 44%, #eef5fb 100%);
        }

        a {
            color: inherit;
        }

        .so-container {
            width: min(100% - 64px, 1180px);
            margin: 0 auto;
        }

        /* ================= HERO ================= */

        .page-hero {
            position: relative;
            overflow: hidden;
            color: #fff;
            min-height: 330px;
            display: flex;
            align-items: center;
            padding: 58px 0 110px;
            background:
                radial-gradient(circle at 13% 18%, rgba(45, 156, 219, .42), transparent 26%),
                radial-gradient(circle at 82% 18%, rgba(255, 255, 255, .18), transparent 23%),
                linear-gradient(135deg, #031f42 0%, #062f5f 46%, #07457d 75%, #0b6eae 100%);
        }

        .page-hero::before {
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

        .page-hero::after {
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
            width: 100%;
            height: 100%;
            display: block;
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
            font-size: clamp(15px, 2vw, 18px);
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
            font-size: 13px;
            font-weight: 800;
            backdrop-filter: blur(10px);
        }

        .hero-meta i {
            color: var(--yellow);
        }

        /* ================= CONTENT ================= */

        .content-section {
            position: relative;
            z-index: 5;
            margin-top: -58px;
            padding: 0 0 90px;
        }

        .structure-card {
            position: relative;
            overflow: hidden;
            padding: 28px;
            border-radius: 32px;
            background: rgba(255, 255, 255, .96);
            border: 1px solid rgba(226, 232, 240, .95);
            box-shadow: var(--shadow-lg);
        }

        .structure-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 12% 8%, rgba(45, 156, 219, .08), transparent 24%),
                radial-gradient(circle at 92% 10%, rgba(247, 181, 0, .08), transparent 22%);
            pointer-events: none;
        }

        .structure-image-box {
            position: relative;
            z-index: 1;
            overflow: hidden;
            padding: 12px;
            border-radius: 26px;
            background:
                linear-gradient(135deg, rgba(6, 47, 95, .08), rgba(45, 156, 219, .06)),
                #ffffff;
            border: 1px solid rgba(226, 232, 240, .95);
            box-shadow: var(--shadow-sm);
        }

        .structure-image-inner {
            overflow: hidden;
            border-radius: 20px;
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, .95);
        }

        .structure-image {
            width: 100%;
            height: auto;
            display: block;
            background: #ffffff;
        }

        /* ================= EMPTY ================= */

        .empty-card {
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            gap: 13px;
            padding: 52px 24px;
            border-radius: 30px;
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, .95);
            box-shadow: var(--shadow-lg);
        }

        .empty-icon {
            width: 70px;
            height: 70px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 24px;
            color: var(--primary);
            background: rgba(6, 47, 95, .08);
            font-size: 30px;
        }

        .empty-card h2 {
            margin: 0;
            color: var(--primary);
            font-size: 24px;
            line-height: 1.3;
            font-weight: 900;
        }

        .empty-card p {
            max-width: 560px;
            margin: 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
            font-weight: 600;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width: 768px) {
            .so-container {
                width: min(100% - 28px, 1180px);
            }

            .page-hero {
                min-height: 305px;
                padding: 48px 0 96px;
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

            .hero-kicker {
                font-size: 12px;
                padding: 8px 12px;
            }

            .page-title {
                font-size: 32px;
                letter-spacing: -.6px;
            }

            .page-desc {
                font-size: 15px;
            }

            .hero-meta span {
                font-size: 12px;
                padding: 8px 10px;
            }

            .content-section {
                margin-top: -48px;
                padding-bottom: 70px;
            }

            .structure-card {
                padding: 18px;
                border-radius: 24px;
            }

            .structure-image-box {
                padding: 8px;
                border-radius: 20px;
            }

            .structure-image-inner {
                border-radius: 15px;
            }

            .empty-card {
                border-radius: 24px;
                padding: 42px 20px;
            }
        }

        @media(max-width: 480px) {
            .page-hero {
                min-height: 292px;
            }

            .page-title {
                font-size: 30px;
            }

            .hero-meta {
                gap: 8px;
            }

            .structure-card {
                padding: 14px;
            }
        }
    </style>
</head>

<body>
    @include('component.header')

    @php
        $currentOrganizationStructure = $organizationStructure ?? $strukturOrganisasi ?? null;
        $imageUrl = null;
        $imageAlt = 'Struktur Organisasi Pascasarjana UNW';

        if ($currentOrganizationStructure && $currentOrganizationStructure->image_path) {
            $imageUrl = route('organization-structures.image', $currentOrganizationStructure);

            if ($currentOrganizationStructure->updated_at) {
                $imageUrl .= '?v=' . $currentOrganizationStructure->updated_at->timestamp;
            }

            if ($currentOrganizationStructure->title) {
                $imageAlt = $currentOrganizationStructure->title;
            }
        }
    @endphp

    <main>
        <section class="page-hero">
            <div class="hero-dots"></div>
            <div class="hero-line"></div>

            <div class="so-container">
                <div class="hero-inner">
                    <div class="hero-kicker">
                        <i class="fas fa-sitemap"></i>
                        <span>Profil Pascasarjana</span>
                    </div>

                    <h1 class="page-title">Struktur Organisasi</h1>

                    <p class="page-desc">
                        Informasi struktur organisasi Pascasarjana Universitas Ngudi Waluyo.
                    </p>

                    <div class="hero-meta">
                        <span>
                            <i class="fas fa-university"></i>
                            Universitas Ngudi Waluyo
                        </span>

                        <span>
                            <i class="fas fa-users-gear"></i>
                            Tata Kelola Organisasi
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

        <section class="content-section">
            <div class="so-container">
                @if ($currentOrganizationStructure && $currentOrganizationStructure->image_path)
                    <article class="structure-card">
                        <div class="structure-image-box">
                            <div class="structure-image-inner">
                                <img
                                    src="{{ $imageUrl }}"
                                    alt="{{ $imageAlt }}"
                                    class="structure-image">
                            </div>
                        </div>
                    </article>
                @else
                    <div class="empty-card">
                        <div class="empty-icon">
                            <i class="fas fa-folder-open"></i>
                        </div>

                        <h2>Struktur Organisasi Belum Tersedia</h2>

                        <p>
                            Silakan unggah gambar struktur organisasi melalui panel admin Filament terlebih dahulu.
                        </p>
                    </div>
                @endif
            </div>
        </section>
    </main>

    @include('component.footer')
</body>

</html>