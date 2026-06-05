<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi, Misi, Tujuan & Sasaran | Pascasarjana Universitas Ngudi Waluyo</title>
    <link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary: #072b57;
            --primary-dark: #052044;
            --yellow: #f7b500;
            --white: #ffffff;
            --light: #f1f6f7;
            --text: #111827;
            --gold: #d9a935;
            --green: #78927a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        button {
            font-family: inherit;
        }

        .container {
            width: min(1120px, 92%);
            margin: 0 auto;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--light);
            color: var(--text);
            overflow-x: hidden;
        }

        /* --- PERUBAHAN CSS UNTUK BANNER GAMBAR & OVERLAY --- */
        .page-hero {
            position: relative;
            background-color: var(--primary); /* Warna dasar jika gambar tidak ada */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 90px 0 75px; /* Ditambah sedikit padding agar gambar lebih terlihat */
            color: white;
            text-align: center;
            z-index: 1;
        }

        /* Overlay gelap transparant di atas gambar latar belakang */
        .page-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(5, 32, 68, 0.75); /* Warna biru gelap transparan */
            z-index: -1;
        }

        .page-hero h1 {
            font-size: 2.6rem;
            font-weight: 800;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        .page-hero p {
            font-size: 1.15rem;
            opacity: 0.95;
            max-width: 800px;
            margin: 0 auto;
        }
        /* -------------------------------------------------- */

        .content-wrapper {
            max-width: 1100px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .visi-misi-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            padding: 2.2rem 2.5rem;
            margin-bottom: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .visi-misi-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 1.4rem;
        }

        .card-header h2 {
            font-size: 1.85rem;
            font-weight: 800;
            color: var(--primary);
            margin: 0;
        }

        .card-content {
            font-size: 1.05rem;
            line-height: 1.85;
            color: #374151;
        }

        .card-content p {
            margin-bottom: 1rem;
        }

        .card-content ul {
            padding-left: 1.3rem;
        }

        .card-content li {
            margin-bottom: 0.55rem;
        }

        @media (max-width: 1200px) {
            .container {
                width: min(100% - 40px, 1120px);
            }
        }

        @media (max-width: 640px) {
            .container {
                width: min(100% - 28px, 1120px);
            }
            .page-hero {
                padding: 70px 0 55px;
            }
            .page-hero h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>

    @include('component.header')

    <section class="page-hero" style="background-image: url('{{ !empty($visiMisi->hero_image) ? asset('storage/' . $visiMisi->hero_image) : '' }}');">
        <div class="container">
            <h1>{{ $visiMisi->hero_title ?? 'Visi & Misi' }}</h1>
            <p>{{ $visiMisi->hero_subtitle ?? 'Pascasarjana Universitas Ngudi Waluyo' }}</p>
        </div>
    </section>

    <div class="content-wrapper">

        <div class="visi-misi-card">
            <div class="card-header">
                <h2>{{ $visiMisi->judul_visi ?? 'Visi' }}</h2>
            </div>
            <div class="card-content">
                {!! $visiMisi->visi ?? '<p><em>Belum ada konten visi. Silakan isi melalui Admin Panel.</em></p>' !!}
            </div>
        </div>

        <div class="visi-misi-card">
            <div class="card-header">
                <h2>{{ $visiMisi->judul_misi ?? 'Misi' }}</h2>
            </div>
            <div class="card-content">
                {!! $visiMisi->misi ?? '<p><em>Belum ada konten misi. Silakan isi melalui Admin Panel.</em></p>' !!}
            </div>
        </div>

        <div class="visi-misi-card">
            <div class="card-header">
                <h2>{{ $visiMisi->judul_tujuan ?? 'Tujuan' }}</h2>
            </div>
            <div class="card-content">
                {!! $visiMisi->tujuan ?? '<p><em>Belum ada konten tujuan. Silakan isi melalui Admin Panel.</em></p>' !!}
            </div>
        </div>

        <div class="visi-misi-card">
            <div class="card-header">
                <h2>{{ $visiMisi->judul_tujuan_bidang ?? 'Tujuan UNW Dalam Bidang' }}</h2>
            </div>
            <div class="card-content">
                {!! $visiMisi->tujuan_bidang ?? '<p><em>Belum ada konten tujuan dalam bidang. Silakan isi melalui Admin Panel.</em></p>' !!}
            </div>
        </div>

        <div class="visi-misi-card">
            <div class="card-header">
                <h2>{{ $visiMisi->judul_sasaran_target ?? 'Sasaran dan Target' }}</h2>
            </div>
            <div class="card-content">
                {!! $visiMisi->sasaran_target ?? '<p><em>Belum ada konten sasaran dan target. Silakan isi melalui Admin Panel.</em></p>' !!}
            </div>
        </div>

    </div>

    @include('component.footer')

</body>

</html>