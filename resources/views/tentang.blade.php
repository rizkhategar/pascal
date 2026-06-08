<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Pascasarjana | Universitas Ngudi Waluyo</title>
    <link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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

        .page-hero {
            background-color: var(--primary);
            padding: 70px 0 55px;
            color: white;
            text-align: center;
        }
        .page-hero h1 { font-size: 2.6rem; font-weight: 800; margin-bottom: 10px; }

        /* GRID LAYOUT UNTUK KONTEN */
        .about-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            max-width: 1100px;
            margin: 70px auto;
            padding: 0 20px;
            align-items: start;
        }

        /* BAGIAN KIRI (TEKS UTAMA) */
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

        /* BAGIAN KANAN (POIN FITUR/KEUNGGULAN) */
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
            background: #fdfaf3; /* Warna krem tipis */
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

        /* RESPONSIVE UNTUK HP & TABLET */
        @media (max-width: 992px) {
            .about-wrapper { grid-template-columns: 1fr; gap: 40px; margin: 50px auto; }
            .about-left h2 { font-size: 2rem; }
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

    @include('component.footer')

</body>
</html>