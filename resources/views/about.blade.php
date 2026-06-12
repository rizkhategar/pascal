<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Pascasarjana | Universitas Ngudi Waluyo</title>
    
    <link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
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

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        
        body { 
            font-family: 'Montserrat', sans-serif; 
            background: var(--soft-bg); 
            color: var(--text); 
            overflow-x: hidden; 
        }
        
        a { text-decoration: none; color: inherit; }
        
        .container { 
            width: min(100% - 64px, 1180px); 
            margin: 0 auto; 
        }

        /* ================= HERO STYLE ================= */
        .about-hero {
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

        .about-hero::before {
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

        .about-hero::after {
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

        .hero-shape svg { width: 100%; height: 100%; display: block; }

        .hero-pattern-dots {
            position: absolute; left: 24px; top: 18px; width: 118px; height: 88px;
            background-image: radial-gradient(rgba(255, 255, 255, .7) 2px, transparent 2.5px);
            background-size: 18px 18px; opacity: .55; z-index: 2;
        }

        .hero-orb {
            position: absolute; right: 18%; bottom: 36px; width: 170px; height: 170px;
            border-radius: 50%; border: 1px solid rgba(255, 255, 255, .18);
            background: rgba(255, 255, 255, .05); box-shadow: inset 0 0 42px rgba(255, 255, 255, .08);
            z-index: 1;
        }

        .hero-line {
            position: absolute; right: 90px; top: 0; width: 220px; height: 340px;
            background: linear-gradient(120deg, rgba(255, 255, 255, .05), rgba(255, 255, 255, .18));
            transform: skewX(-32deg); z-index: 1;
        }

        .hero-inner {
            position: relative; z-index: 4; display: grid; grid-template-columns: 1fr auto;
            align-items: center; gap: 38px;
        }

        .hero-badge {
            width: fit-content; display: inline-flex; align-items: center; gap: 10px;
            padding: 9px 15px; margin-bottom: 18px; border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, .22); background: rgba(255, 255, 255, .10);
            backdrop-filter: blur(10px); color: rgba(255, 255, 255, .94);
            font-size: 14px; font-weight: 800; letter-spacing: .2px;
        }

        .hero-badge i { color: #bfe9ff; }

        .about-title {
            margin: 0 0 16px; font-size: clamp(32px, 4.6vw, 52px); line-height: 1.05;
            font-weight: 900; letter-spacing: -1px; color: #fff; max-width: 760px;
        }

        .about-subtitle {
            margin: 0; font-size: clamp(18px, 2.4vw, 21px); line-height: 1.4;
            font-weight: 500; color: rgba(255, 255, 255, .88); max-width: 680px;
        }

        .hero-info-card {
            width: 270px; min-height: 150px; border-radius: 24px; padding: 24px;
            border: 1px solid rgba(255, 255, 255, .22);
            background: linear-gradient(145deg, rgba(255, 255, 255, .18), rgba(255, 255, 255, .07));
            backdrop-filter: blur(16px); box-shadow: var(--shadow-blue);
        }

        .hero-info-icon {
            width: 52px; height: 52px; border-radius: 16px; display: flex;
            align-items: center; justify-content: center; color: #fff; font-size: 24px;
            background: rgba(255, 255, 255, .16); border: 1px solid rgba(255, 255, 255, .20);
            margin-bottom: 18px;
        }

        .hero-info-card h3 {
            margin: 0 0 8px; font-size: 20px; line-height: 1.2; color: #fff; font-weight: 900;
        }

        .hero-info-card p {
            margin: 0; color: rgba(255, 255, 255, .82); font-size: 15px; line-height: 1.5; font-weight: 500;
        }

        /* ================= ABOUT MAIN SECTION ================= */
        .page-section {
            position: relative;
            padding: 60px 0 96px;
            background:
                radial-gradient(circle at 8% 12%, rgba(45, 156, 219, .08), transparent 24%),
                linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: start;
            margin-bottom: 80px;
        }

        .section-heading { margin-bottom: 32px; max-width: 720px; }

        .section-kicker {
            display: inline-flex; align-items: center; gap: 9px; margin-bottom: 12px;
            color: var(--primary); font-size: 14px; font-weight: 900;
            letter-spacing: .6px; text-transform: uppercase;
        }

        .section-kicker::before {
            content: ""; width: 34px; height: 3px; border-radius: 99px;
            background: linear-gradient(90deg, var(--primary), var(--blue-light));
        }

        .section-heading h2 {
            margin: 0 0 20px; font-size: clamp(28px, 3vw, 40px); line-height: 1.25;
            color: #0f172a; font-weight: 900; letter-spacing: -.5px;
        }

        .section-heading .desc {
            margin: 0; color: #4b5563; font-size: 16px; line-height: 1.8;
            font-weight: 500; text-align: justify;
        }

        /* ================= POINT CARDS ================= */
        .about-right {
            display: flex; flex-direction: column; gap: 20px;
        }

        .point-card {
            position: relative; overflow: hidden; display: grid; grid-template-columns: 64px 1fr;
            align-items: center; gap: 20px; min-height: 112px; padding: 22px 24px;
            border-radius: 22px; background: rgba(255, 255, 255, .92);
            border: 1px solid rgba(226, 232, 240, .9);
            box-shadow: 0 14px 34px rgba(15, 23, 42, .08); transition: .25s ease;
        }

        .point-card::before {
            content: ""; position: absolute; inset: 0 auto 0 0; width: 5px;
            background: linear-gradient(180deg, var(--primary), var(--blue-light)); opacity: .95;
        }

        .point-card::after {
            content: ""; position: absolute; right: -38px; top: -38px; width: 92px; height: 92px;
            border-radius: 50%; background: rgba(45, 156, 219, .09); transition: .25s ease;
        }

        .point-card:hover {
            transform: translateY(-5px); box-shadow: 0 22px 48px rgba(15, 23, 42, .12);
            border-color: rgba(45, 156, 219, .35);
        }

        .point-card:hover::after {
            transform: scale(1.45); background: rgba(45, 156, 219, .14);
        }

        .point-icon {
            position: relative; z-index: 1; width: 58px; height: 58px; border-radius: 18px;
            display: flex; align-items: center; justify-content: center; color: #fff;
            font-size: 25px; background: linear-gradient(135deg, var(--primary-dark), var(--blue));
            box-shadow: 0 12px 28px rgba(6, 59, 112, .26);
        }

        .point-icon img {
            width: 32px; height: 32px; object-fit: contain; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }

        .point-text { position: relative; z-index: 1; }
        
        .point-text h3 {
            margin: 0 0 6px; color: #0f3763; font-size: 18px; line-height: 1.2; font-weight: 800;
        }
        
        .point-text p {
            margin: 0; color: #64748b; font-size: 15px; line-height: 1.5; font-weight: 500;
        }

        /* ================= SAMBUTAN DIREKTUR ================= */
        .sambutan-card {
            overflow: hidden; border-radius: 28px; background: #fff;
            border: 1px solid rgba(226, 232, 240, .95); box-shadow: var(--shadow);
            display: flex; margin-top: 20px;
        }

        .sambutan-img { flex: 0 0 35%; position: relative; background: var(--primary-dark); }
        
        .sambutan-img img {
            width: 100%; height: 100%; object-fit: cover; object-position: top center; min-height: 450px;
        }

        .sambutan-content {
            padding: 50px; flex: 1; display: flex; flex-direction: column; justify-content: center;
            background: linear-gradient(135deg, rgba(6, 59, 112, .03), rgba(45, 156, 219, .03)), #ffffff;
        }

        .quote-icon {
            color: var(--blue-light); opacity: 0.3; font-size: 40px; margin-bottom: 20px;
        }

        .sambutan-text {
            font-size: 16px; line-height: 1.8; color: #374151; font-style: italic; margin-bottom: 35px;
        }

        .direktur-info {
            border-left: 4px solid var(--blue-light); padding-left: 18px;
        }

        .direktur-info h4 {
            color: #0f3763; font-size: 22px; font-weight: 900; margin-bottom: 6px; letter-spacing: -0.5px;
        }

        .direktur-info p {
            color: #64748b; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;
        }

        .text-center { text-align: center; margin: 0 auto; display: flex; flex-direction: column; align-items: center; }

        /* ================= RESPONSIVE ================= */
        @media(max-width:992px) {
            .container { width: min(100% - 32px, 1180px); }
            .about-hero { min-height: 250px; padding: 48px 0 72px; }
            .hero-inner { grid-template-columns: 1fr; }
            .hero-info-card { width: 100%; max-width: 420px; }
            .about-grid { grid-template-columns: 1fr; gap: 40px; }
            .sambutan-card { flex-direction: column; }
            .sambutan-img { flex: none; height: 400px; }
            .sambutan-img img { min-height: 400px; }
            .sambutan-content { padding: 40px 30px; }
        }

        @media(max-width:640px) {
            .container { width: min(100% - 28px, 1180px); }
            .about-hero { min-height: 235px; padding: 42px 0 62px; }
            .hero-pattern-dots { width: 90px; height: 70px; background-size: 16px 16px; opacity: .4; }
            .hero-line, .hero-orb { display: none; }
            .hero-badge { font-size: 12px; padding: 8px 12px; margin-bottom: 14px; }
            .about-title { margin-bottom: 12px; font-size: 28px; }
            .about-subtitle { font-size: 16px; }
            .hero-info-card { border-radius: 20px; padding: 20px; min-height: auto; }
            .page-section { padding: 42px 0 76px; }
            .section-heading h2 { font-size: 26px; }
            .point-card { grid-template-columns: 52px 1fr; gap: 16px; min-height: 96px; padding: 18px; border-radius: 18px; }
            .point-icon { width: 50px; height: 50px; border-radius: 16px; font-size: 22px; }
            .point-text h3 { font-size: 16px; }
            .point-text p { font-size: 14px; }
        }
    </style>
</head>

<body>

    @include('component.header')

    <section class="about-hero">
        <div class="hero-pattern-dots"></div>
        <div class="hero-line"></div>
        <div class="hero-orb"></div>

        <div class="container">
            <div class="hero-inner">
                <div class="hero-content">
                    <div class="hero-badge">
                        <i class="fas fa-university"></i>
                        Informasi Tentang Kami
                    </div>
                    <h1 class="about-title">Tentang Pascasarjana</h1>
                    <p class="about-subtitle">
                        Mengenal lebih dekat visi, misi, dan profil Pascasarjana Universitas Ngudi Waluyo.
                    </p>
                </div>

                <div class="hero-info-card">
                    <div class="hero-info-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3>Profil Unggulan</h3>
                    <p>
                        Pusat pendidikan pascasarjana yang berbudaya sehat dan bereputasi global.
                    </p>
                </div>
            </div>
        </div>

        <div class="hero-shape">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path d="M0,72 C220,120 430,20 720,58 C980,92 1180,118 1440,42 L1440,120 L0,120 Z" fill="#f8fafc"></path>
            </svg>
        </div>
    </section>

    <main class="page-section">
        <div class="container">
            
            <div class="about-grid">
                @if($tentang)
                    <div class="section-heading" style="margin-bottom: 0;">
                        <div class="section-kicker">{{ $tentang->subheading ?? 'Tentang Kami' }}</div>
                        <h2>{{ $tentang->heading ?? 'Judul Utama Belum Diisi' }}</h2>
                        <div class="desc">
                            {!! nl2br(e($tentang->description)) !!}
                        </div>
                    </div>

                    <div class="about-right">
                        @if(!empty($tentang->points) && is_array($tentang->points))
                            @foreach($tentang->points as $point)
                                <article class="point-card">
                                    <div class="point-icon">
                                        @if(!empty($point['icon']))
                                            <img src="{{ asset('storage/' . $point['icon']) }}" alt="Icon">
                                        @else
                                            <i class="fas fa-check-circle"></i>
                                        @endif
                                    </div>
                                    <div class="point-text">
                                        <h3>{{ $point['title'] ?? '' }}</h3>
                                        <p>{{ $point['description'] ?? '' }}</p>
                                    </div>
                                </article>
                            @endforeach
                        @else
                            <p style="color: #6b7280;"><em>Belum ada poin fitur yang ditambahkan.</em></p>
                        @endif
                    </div>
                @else
                    <div style="grid-column: 1 / -1; text-align: center; padding: 60px; background: white; border-radius: 20px; box-shadow: var(--shadow);">
                        <i class="fas fa-folder-open" style="font-size: 40px; color: #cbd5e1; margin-bottom: 15px;"></i>
                        <h3 style="color: #475569; font-size: 20px;">Data Tentang Pascasarjana belum diisi.</h3>
                        <p style="color: #94a3b8; margin-top: 10px;">Silakan login ke Admin Panel untuk mengisi data.</p>
                    </div>
                @endif
            </div>

            @if($tentang && (!empty($tentang->direktur_name) || !empty($tentang->direktur_message)))
            <div class="sambutan-section" style="margin-top: 60px;">
                <div class="section-heading text-center">
                    <div class="section-kicker">{{ $tentang->direktur_heading ?? 'Sambutan Direktur' }}</div>
                    <h2>{{ $tentang->direktur_greeting ?? 'Selamat Datang di Pascasarjana Universitas Ngudi Waluyo' }}</h2>
                </div>

                <div class="sambutan-card">
                    <div class="sambutan-img">
                        @if(!empty($tentang->direktur_image))
                            <img src="{{ asset('storage/' . $tentang->direktur_image) }}" alt="{{ $tentang->direktur_name }}">
                        @else
                            <div style="width: 100%; height: 100%; min-height: 400px; display: flex; align-items: center; justify-content: center; background: #e2e8f0; color: #94a3b8;">
                                <i class="fas fa-user-tie" style="font-size: 80px;"></i>
                            </div>
                        @endif
                    </div>

                    <div class="sambutan-content">
                        <i class="fas fa-quote-left quote-icon"></i>
                        
                        <div class="sambutan-text">
                            {!! $tentang->direktur_message ?? '<p>Pesan sambutan pimpinan belum ditambahkan.</p>' !!}
                        </div>
                        
                        <div class="direktur-info">
                            <h4>{{ $tentang->direktur_name ?? 'Nama Direktur Belum Diisi' }}</h4>
                            <p>{{ $tentang->direktur_title ?? 'Direktur Pascasarjana Universitas Ngudi Waluyo' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </main>

    @include('component.footer')

</body>
</html>