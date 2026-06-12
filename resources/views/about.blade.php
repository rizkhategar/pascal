<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Pascasarjana | Universitas Ngudi Waluyo</title>
    <link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #072b57;
            --primary-dark: #052044;
            --yellow: #f7b500;
            --white: #ffffff;
            --light: #f1f6f7;
            --text: #111827;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Montserrat', sans-serif; background: var(--light); color: var(--text); overflow-x: hidden; }
        a { text-decoration: none; color: inherit; }
        
        .container { width: min(1120px, 92%); margin: 0 auto; }

        /* ==========================================
           0. HERO SECTION (BANNER GAMBAR & OVERLAY)
           ========================================== */
        .page-hero {
            position: relative;
            background-color: var(--primary); /* Warna dasar jika gambar tidak ada */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 90px 0 75px; 
            color: white;
            text-align: center;
            z-index: 1;
        }

        /* Overlay gelap transparan di atas gambar */
        .page-hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(5, 32, 68, 0.75); 
            z-index: -1;
        }

        .page-hero h1 { 
            font-size: 2.6rem; 
            font-weight: 800; 
            margin-bottom: 10px; 
            letter-spacing: 0.5px;
        }

        /* ==========================================
           1. BAGIAN TENTANG KAMI UTAMA (ATAS)
           ========================================== */
        .about-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            max-width: 1100px;
            margin: 70px auto 60px;
            padding: 0 20px;
            align-items: start;
        }

        .about-left .subheading {
            color: var(--yellow);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.95rem;
            letter-spacing: 1px;
            display: block;
            margin-bottom: 12px;
        }
        .about-left h2 {
            color: var(--primary);
            font-size: 2.4rem;
            font-weight: 800;
            margin-bottom: 25px;
            line-height: 1.25;
        }
        .about-left .desc {
            color: #4b5563;
            line-height: 1.8;
            font-size: 1.05rem;
            text-align: justify;
        }

        .about-right {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .point-card {
            display: flex;
            gap: 20px;
            background: white;
            padding: 24px;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .point-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.09);
        }
        .point-icon {
            width: 65px;
            height: 65px;
            flex-shrink: 0;
            background: #fdfaf3;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #fce8b2;
        }
        .point-icon img {
            width: 35px;
            height: 35px;
            object-fit: contain;
        }
        .point-text h3 {
            color: var(--primary);
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .point-text p {
            color: #6b7280;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* ==========================================
           2. BAGIAN SAMBUTAN DIREKTUR (BAWAH)
           ========================================== */
        .sambutan-header { 
            text-align: center; 
            margin-bottom: 40px; 
            padding: 0 20px; 
        }
        .sambutan-header h3 { 
            color: var(--yellow); 
            text-transform: uppercase; 
            font-size: 1.1rem; 
            letter-spacing: 2px; 
            margin-bottom: 10px; 
            font-weight: 700; 
        }
        .sambutan-header h2 { 
            color: var(--primary); 
            font-size: 2.2rem; 
            font-weight: 800; 
            line-height: 1.35; 
            max-width: 800px; 
            margin: 0 auto; 
        }

        .sambutan-wrapper { 
            max-width: 1100px; 
            margin: 0 auto 90px; 
            padding: 0 20px; 
        }
        .sambutan-card { 
            background: white; 
            border-radius: 20px; 
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.06); 
            display: flex; 
            overflow: hidden; 
        }
        .sambutan-img { 
            flex: 0 0 35%; 
            background: var(--primary-dark); 
            position: relative; 
        }
        .sambutan-img img { 
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
            object-position: top center; 
            min-height: 400px; 
        }
        .sambutan-content { 
            padding: 50px 50px; 
            flex: 1; 
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            background: url('https://www.transparenttextures.com/patterns/cubes.png'); 
        }
        .quote-icon { 
            color: var(--yellow); 
            opacity: 0.4; 
            width: 45px; 
            height: 45px; 
            margin-bottom: 20px; 
        }
        .sambutan-text { 
            font-size: 1.15rem; 
            line-height: 1.85; 
            color: #374151; 
            font-style: italic; 
            margin-bottom: 35px; 
        }
        .sambutan-text p { 
            margin-bottom: 15px; 
        }
        .direktur-info { 
            border-left: 4px solid var(--yellow); 
            padding-left: 15px; 
        }
        .direktur-info h4 { 
            color: var(--primary); 
            font-size: 1.4rem; 
            font-weight: 800; 
            margin-bottom: 6px; 
            letter-spacing: -0.5px; 
        }
        .direktur-info p { 
            color: #6b7280; 
            font-weight: 600; 
            font-size: 0.95rem; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
        }

        /* ==========================================
           RESPONSIVE UNTUK HP & TABLET
           ========================================== */
        @media (max-width: 992px) {
            .about-wrapper { grid-template-columns: 1fr; gap: 40px; margin: 50px auto; }
            .about-left h2 { font-size: 2rem; }
            .page-hero { padding: 70px 0 55px; }
            .page-hero h1 { font-size: 2rem; }
            
            .sambutan-header h2 { font-size: 1.8rem; }
            .sambutan-card { flex-direction: column; }
            .sambutan-img { flex: none; height: 450px; }
            .sambutan-content { padding: 40px 30px; }
        }
    </style>
</head>

<body>

    @include('component.header')

    <section class="page-hero">
        <div class="container">
            <h1>Tentang Pascasarjana</h1>
        </div>
    </section>

    <div class="about-wrapper">
        @if($tentang)
            <div class="about-left">
                <span class="subheading">{{ $tentang->subheading ?? 'Tentang Kami' }}</span>
                <h2>{{ $tentang->heading ?? 'Judul Utama Belum Diisi' }}</h2>
                <div class="desc">
                    {!! nl2br(e($tentang->description)) !!}
                </div>
            </div>

            <div class="about-right">
                @if(!empty($tentang->points) && is_array($tentang->points))
                    @foreach($tentang->points as $point)
                        <div class="point-card">
                            <div class="point-icon">
                                @if(!empty($point['icon']))
                                    <img src="{{ asset('storage/' . $point['icon']) }}" alt="Icon">
                                @else
                                    <svg width="30" height="30" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" style="color: var(--yellow);"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                @endif
                            </div>
                            <div class="point-text">
                                <h3>{{ $point['title'] ?? '' }}</h3>
                                <p>{{ $point['description'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p style="color: gray;"><em>Belum ada poin fitur yang ditambahkan.</em></p>
                @endif
            </div>
        @else
            <div style="grid-column: 1 / -1; text-align: center; padding: 50px; background: white; border-radius: 12px;">
                <h3 style="color: gray;">Data Tentang Pascasarjana belum diisi.</h3>
                <p>Silakan login ke Admin Panel untuk mengisi data.</p>
            </div>
        @endif
    </div>

    @if($tentang && (!empty($tentang->direktur_name) || !empty($tentang->direktur_message)))
    <div class="sambutan-wrapper">
        
        <div class="sambutan-header">
            <h3>{{ $tentang->direktur_heading ?? 'Sambutan Direktur' }}</h3>
            <h2>{{ $tentang->direktur_greeting ?? 'Selamat Datang di Pascasarjana Universitas Ngudi Waluyo' }}</h2>
        </div>

        <div class="sambutan-card">
            
            <div class="sambutan-img">
                @if(!empty($tentang->direktur_image))
                    <img src="{{ asset('storage/' . $tentang->direktur_image) }}" alt="{{ $tentang->direktur_name }}">
                @else
                    <div style="width: 100%; height: 100%; min-height: 400px; display: flex; align-items: center; justify-content: center; background: #e2e8f0; color: #94a3b8;">
                        <svg width="80" height="80" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    </div>
                @endif
            </div>

            <div class="sambutan-content">
                <svg class="quote-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                </svg>
                
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

    @include('component.footer')

</body>
</html>