<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak PMB - Pascasarjana UNW</title>

    <link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary: #063b70;
            --primary-dark: #032f5b;
            --primary-deep: #021f3f;
            --blue: #0b5f9f;
            --blue-light: #2d9cdb;
            --white: #ffffff;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #e5e7eb;
            --soft-bg: #f8fafc;
            --shadow: 0 18px 45px rgba(15, 23, 42, .12);
            --shadow-blue: 0 20px 60px rgba(3, 47, 91, .28);
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
            background: var(--soft-bg);
            color: var(--text);
        }

        .container {
            width: min(100% - 64px, 1180px);
            margin: 0 auto;
        }

        /* ================= HERO STYLE BARU ================= */

        .contact-hero {
            position: relative;
            min-height: 260px;
            overflow: hidden;
            color: #fff;
            display: flex;
            align-items: center;
            padding: 52px 0 72px;
            background:
                radial-gradient(circle at 12% 18%, rgba(45, 156, 219, .38), transparent 26%),
                radial-gradient(circle at 78% 20%, rgba(255, 255, 255, .16), transparent 24%),
                linear-gradient(135deg, var(--primary-deep) 0%, var(--primary-dark) 42%, var(--primary) 72%, #0b6aa8 100%);
        }

        .contact-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, .06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, .06) 1px, transparent 1px);
            background-size: 44px 44px;
            mask-image: linear-gradient(90deg, rgba(0, 0, 0, .9), transparent 78%);
            opacity: .45;
            z-index: 1;
        }

        .contact-hero::after {
            content: "";
            position: absolute;
            right: -120px;
            top: -150px;
            width: 520px;
            height: 520px;
            border-radius: 50%;
            background:
                radial-gradient(circle, rgba(255, 255, 255, .18), rgba(45, 156, 219, .12) 42%, transparent 68%);
            z-index: 1;
        }

        .hero-shape {
            position: absolute;
            right: 0;
            bottom: -1px;
            width: 100%;
            height: 96px;
            z-index: 2;
            pointer-events: none;
        }

        .hero-shape svg {
            width: 100%;
            height: 100%;
            display: block;
        }

        .hero-pattern-dots {
            position: absolute;
            left: 24px;
            top: 18px;
            width: 118px;
            height: 88px;
            background-image: radial-gradient(rgba(255, 255, 255, .7) 2px, transparent 2.5px);
            background-size: 18px 18px;
            opacity: .55;
            z-index: 2;
        }

        .hero-orb {
            position: absolute;
            right: 18%;
            bottom: 36px;
            width: 170px;
            height: 170px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, .18);
            background: rgba(255, 255, 255, .05);
            box-shadow: inset 0 0 42px rgba(255, 255, 255, .08);
            z-index: 1;
        }

        .hero-line {
            position: absolute;
            right: 90px;
            top: 0;
            width: 220px;
            height: 340px;
            background: linear-gradient(120deg, rgba(255, 255, 255, .05), rgba(255, 255, 255, .18));
            transform: skewX(-32deg);
            z-index: 1;
        }

        .hero-inner {
            position: relative;
            z-index: 4;
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 38px;
        }

        .hero-badge {
            width: fit-content;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 9px 15px;
            margin-bottom: 18px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, .22);
            background: rgba(255, 255, 255, .10);
            backdrop-filter: blur(10px);
            color: rgba(255, 255, 255, .94);
            font-size: 14px;
            font-weight: 800;
            letter-spacing: .2px;
        }

        .hero-badge i {
            color: #bfe9ff;
        }

        .contact-title {
            margin: 0 0 16px;
            font-size: clamp(32px, 4.6vw, 52px);
            line-height: 1.05;
            font-weight: 900;
            letter-spacing: -1px;
            color: #fff;
            max-width: 760px;
        }

        .contact-subtitle {
            margin: 0;
            font-size: clamp(18px, 2.4vw, 25px);
            line-height: 1.4;
            font-weight: 700;
            color: rgba(255, 255, 255, .88);
            max-width: 680px;
        }

        .hero-info-card {
            width: 270px;
            min-height: 150px;
            border-radius: 24px;
            padding: 24px;
            border: 1px solid rgba(255, 255, 255, .22);
            background: linear-gradient(145deg, rgba(255, 255, 255, .18), rgba(255, 255, 255, .07));
            backdrop-filter: blur(16px);
            box-shadow: var(--shadow-blue);
        }

        .hero-info-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 24px;
            background: rgba(255, 255, 255, .16);
            border: 1px solid rgba(255, 255, 255, .20);
            margin-bottom: 18px;
        }

        .hero-info-card h3 {
            margin: 0 0 8px;
            font-size: 20px;
            line-height: 1.2;
            color: #fff;
            font-weight: 900;
        }

        .hero-info-card p {
            margin: 0;
            color: rgba(255, 255, 255, .82);
            font-size: 15px;
            line-height: 1.5;
            font-weight: 600;
        }

        /* ================= CONTACT SECTION ================= */

        .contact-section {
            position: relative;
            padding: 60px 0 96px;
            background:
                radial-gradient(circle at 8% 12%, rgba(45, 156, 219, .08), transparent 24%),
                linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        }

        .section-heading {
            margin-bottom: 32px;
            max-width: 720px;
        }

        .section-kicker {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 12px;
            color: var(--primary);
            font-size: 14px;
            font-weight: 900;
            letter-spacing: .6px;
            text-transform: uppercase;
        }

        .section-kicker::before {
            content: "";
            width: 34px;
            height: 3px;
            border-radius: 99px;
            background: linear-gradient(90deg, var(--primary), var(--blue-light));
        }

        .section-heading h2 {
            margin: 0 0 10px;
            font-size: clamp(28px, 3vw, 40px);
            line-height: 1.15;
            color: #0f172a;
            font-weight: 900;
            letter-spacing: -.5px;
        }

        .section-heading p {
            margin: 0;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.7;
            font-weight: 500;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: minmax(330px, 455px) 1fr;
            gap: 34px;
            align-items: stretch;
        }

        .contact-list {
            display: grid;
            gap: 18px;
        }

        .contact-card {
            position: relative;
            overflow: hidden;
            display: grid;
            grid-template-columns: 64px 1fr;
            align-items: center;
            gap: 20px;
            min-height: 112px;
            padding: 22px 24px;
            border-radius: 22px;
            background: rgba(255, 255, 255, .92);
            border: 1px solid rgba(226, 232, 240, .9);
            box-shadow: 0 14px 34px rgba(15, 23, 42, .08);
            transition: .25s ease;
        }

        .contact-card::before {
            content: "";
            position: absolute;
            inset: 0 auto 0 0;
            width: 5px;
            background: linear-gradient(180deg, var(--primary), var(--blue-light));
            opacity: .95;
        }

        .contact-card::after {
            content: "";
            position: absolute;
            right: -38px;
            top: -38px;
            width: 92px;
            height: 92px;
            border-radius: 50%;
            background: rgba(45, 156, 219, .09);
            transition: .25s ease;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 22px 48px rgba(15, 23, 42, .12);
            border-color: rgba(45, 156, 219, .35);
        }

        .contact-card:hover::after {
            transform: scale(1.45);
            background: rgba(45, 156, 219, .14);
        }

        .contact-icon {
            position: relative;
            z-index: 1;
            width: 58px;
            height: 58px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 25px;
            background: linear-gradient(135deg, var(--primary-dark), var(--blue));
            box-shadow: 0 12px 28px rgba(6, 59, 112, .26);
        }

        .contact-info {
            position: relative;
            z-index: 1;
        }

        .contact-info h2 {
            margin: 0 0 8px;
            color: #0f3763;
            font-size: 19px;
            line-height: 1.1;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .2px;
        }

        .contact-info p,
        .contact-info a {
            margin: 0;
            color: #64748b;
            font-size: 17px;
            line-height: 1.45;
            font-weight: 600;
            text-decoration: none;
            word-break: break-word;
        }

        .contact-info a:hover {
            color: var(--primary);
        }

        .map-card {
            overflow: hidden;
            border-radius: 28px;
            background: #fff;
            border: 1px solid rgba(226, 232, 240, .95);
            box-shadow: var(--shadow);
        }

        .map-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 22px 24px;
            background:
                linear-gradient(135deg, rgba(6, 59, 112, .08), rgba(45, 156, 219, .08)),
                #ffffff;
            border-bottom: 1px solid rgba(226, 232, 240, .9);
        }

        .map-title-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .map-pin {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-dark), var(--blue));
            color: #fff;
            font-size: 20px;
            box-shadow: 0 12px 28px rgba(6, 59, 112, .22);
        }

        .map-top h2 {
            margin: 0 0 4px;
            color: #0f172a;
            font-size: 21px;
            font-weight: 900;
            line-height: 1.2;
        }

        .map-top p {
            margin: 0;
            color: #64748b;
            font-size: 15px;
            line-height: 1.4;
            font-weight: 600;
        }

        .map-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            flex-shrink: 0;
            padding: 12px 16px;
            border-radius: 999px;
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--blue));
            font-size: 14px;
            font-weight: 900;
            text-decoration: none;
            box-shadow: 0 12px 24px rgba(6, 59, 112, .22);
            transition: .22s ease;
        }

        .map-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 30px rgba(6, 59, 112, .28);
        }

        .map-frame {
            width: 100%;
            height: 500px;
            border: 0;
            display: block;
            filter: saturate(1.05) contrast(1.02);
        }

        .wa-floating {
            position: fixed;
            right: 22px;
            bottom: 22px;
            width: 62px;
            height: 62px;
            border-radius: 50%;
            background: #25d366;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            text-decoration: none;
            box-shadow: 0 16px 34px rgba(37, 211, 102, .35);
            z-index: 9999;
            transition: .22s ease;
        }

        .wa-floating::before {
            content: "";
            position: absolute;
            inset: -8px;
            border-radius: inherit;
            background: rgba(37, 211, 102, .20);
            animation: waPulse 1.8s ease-out infinite;
            z-index: -1;
        }

        .wa-floating:hover {
            transform: translateY(-4px) scale(1.03);
            background: #1ebe5d;
        }

        @keyframes waPulse {
            0% {
                transform: scale(.8);
                opacity: .9;
            }

            100% {
                transform: scale(1.35);
                opacity: 0;
            }
        }

        @media(max-width:992px) {
            .container {
                width: min(100% - 32px, 1180px);
            }

            .contact-hero {
                min-height: 250px;
                padding: 48px 0 72px;
            }

            .hero-inner {
                grid-template-columns: 1fr;
            }

            .hero-info-card {
                width: 100%;
                max-width: 420px;
            }

            .contact-grid {
                grid-template-columns: 1fr;
            }

            .map-frame {
                height: 420px;
            }
        }

        @media(max-width:640px) {
            .container {
                width: min(100% - 28px, 1180px);
            }

            .contact-hero {
                min-height: 235px;
                padding: 42px 0 62px;
            }

            .hero-pattern-dots {
                left: 14px;
                top: 10px;
                width: 90px;
                height: 70px;
                background-size: 16px 16px;
                opacity: .4;
            }

            .hero-line,
            .hero-orb {
                display: none;
            }

            .hero-badge {
                font-size: 12px;
                padding: 8px 12px;
                margin-bottom: 14px;
            }

            .contact-title {
                margin-bottom: 12px;
                letter-spacing: -.6px;
            }

            .contact-subtitle {
                font-size: 17px;
            }

            .hero-info-card {
                border-radius: 20px;
                padding: 20px;
                min-height: auto;
            }

            .hero-info-icon {
                width: 46px;
                height: 46px;
                font-size: 21px;
                margin-bottom: 14px;
            }

            .hero-info-card h3 {
                font-size: 18px;
            }

            .hero-info-card p {
                font-size: 14px;
            }

            .contact-section {
                padding: 42px 0 76px;
            }

            .section-heading {
                margin-bottom: 24px;
            }

            .section-heading h2 {
                font-size: 28px;
            }

            .section-heading p {
                font-size: 15px;
            }

            .contact-card {
                grid-template-columns: 52px 1fr;
                gap: 16px;
                min-height: 96px;
                padding: 18px;
                border-radius: 18px;
            }

            .contact-icon {
                width: 50px;
                height: 50px;
                border-radius: 16px;
                font-size: 22px;
            }

            .contact-info h2 {
                font-size: 16px;
                margin-bottom: 6px;
            }

            .contact-info p,
            .contact-info a {
                font-size: 15px;
            }

            .map-card {
                border-radius: 20px;
            }

            .map-top {
                align-items: flex-start;
                flex-direction: column;
                padding: 18px;
            }

            .map-action {
                width: 100%;
            }

            .map-frame {
                height: 330px;
            }

            .wa-floating {
                width: 56px;
                height: 56px;
                font-size: 30px;
                right: 16px;
                bottom: 16px;
            }
        }
    </style>
</head>

<body>
    @include('component.header')

    <section class="contact-hero">
        <div class="hero-pattern-dots"></div>
        <div class="hero-line"></div>
        <div class="hero-orb"></div>

        <div class="container">
            <div class="hero-inner">
                <div class="hero-content">
                    <div class="hero-badge">
                        <i class="fas fa-graduation-cap"></i>
                        Informasi Resmi PMB Pascasarjana
                    </div>

                    <h1 class="contact-title">Kontak Pendaftaran Mahasiswa Baru</h1>
                    <p class="contact-subtitle">
                        PMB Universitas Ngudi Waluyo
                    </p>
                </div>

                <div class="hero-info-card">
                    <div class="hero-info-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>Layanan Informasi</h3>
                    <p>
                        Hubungi admin PMB untuk informasi pendaftaran, jadwal, dan layanan akademik.
                    </p>
                </div>
            </div>
        </div>

        <div class="hero-shape">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path d="M0,72 C220,120 430,20 720,58 C980,92 1180,118 1440,42 L1440,120 L0,120 Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

    <main class="contact-section">
        <div class="container">
            <div class="section-heading">
                <div class="section-kicker">Hubungi Kami</div>
                <h2>Informasi Kontak PMB</h2>
                <p>
                    Silakan gunakan kontak resmi berikut untuk mendapatkan informasi pendaftaran mahasiswa baru
                    Universitas Ngudi Waluyo.
                </p>
            </div>

            <div class="contact-grid">
                <div class="contact-list">
                    <article class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-map-location-dot"></i>
                        </div>
                        <div class="contact-info">
                            <h2>Sekretariat</h2>
                            <p>Jl. Diponegoro No. 186 Ungaran</p>
                        </div>
                    </article>

                    <article class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <div class="contact-info">
                            <h2>Email</h2>
                            <a href="mailto:pmb@unw.ac.id">pmb@unw.ac.id</a>
                        </div>
                    </article>

                    <article class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-phone-volume"></i>
                        </div>
                        <div class="contact-info">
                            <h2>Fax</h2>
                            <p>(024)-6925408</p>
                        </div>
                    </article>

                    <article class="contact-card">
                        <div class="contact-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="contact-info">
                            <h2>Whatsapp Admin</h2>
                            <a href="https://wa.me/6285730339469" target="_blank" rel="noopener">
                                +62 857-3033-9469
                            </a>
                        </div>
                    </article>
                </div>

                <article class="map-card">
                    <div class="map-top">
                        <div class="map-title-wrap">
                            <div class="map-pin">
                                <i class="fas fa-location-dot"></i>
                            </div>
                            <div>
                                <h2>PMB Universitas Ngudi Waluyo</h2>
                                <p>Lokasi sekretariat pendaftaran mahasiswa baru.</p>
                            </div>
                        </div>

                        <a
                            class="map-action"
                            href="https://www.google.com/maps/search/?api=1&query=PMB%20Universitas%20Ngudi%20Waluyo"
                            target="_blank"
                            rel="noopener">
                            <i class="fas fa-route"></i>
                            Buka Maps
                        </a>
                    </div>

                    <iframe
                        class="map-frame"
                        src="https://www.google.com/maps?q=PMB%20Universitas%20Ngudi%20Waluyo&output=embed"
                        loading="lazy"
                        allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </article>
            </div>
        </div>
    </main>

    <a
        class="wa-floating"
        href="https://wa.me/6285730339469"
        target="_blank"
        rel="noopener"
        aria-label="Chat WhatsApp Admin PMB">
        <i class="fab fa-whatsapp"></i>
    </a>

    @include('component.footer')
</body>

</html>