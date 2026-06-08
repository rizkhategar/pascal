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
            --light: #f8fafc;
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

        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(
                180deg,
                #f8fafc 0%,
                #ffffff 40%,
                #ffffff 100%
            );
            color: var(--text);
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        .container {
            width: min(1120px, 92%);
            margin: 0 auto;
        }

        /* ====================================
           HERO SECTION
        ==================================== */
        .page-hero {
            position: relative;
            background-color: var(--primary);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 100px 0 80px;
            color: white;
            text-align: center;
            z-index: 1;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(5, 32, 68, 0.75);
            z-index: -1;
        }

        .page-hero h1 {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .page-hero p {
            font-size: 1.15rem;
            opacity: .95;
            max-width: 800px;
            margin: 0 auto;
        }

        /* ====================================
           CONTENT
        ==================================== */

        .content-wrapper {
            max-width: 1100px;
            margin: 80px auto;
            padding: 0 20px;
        }

        .visi-misi-card {
            padding-bottom: 55px;
            margin-bottom: 55px;
            border-bottom: 1px solid rgba(7, 43, 87, 0.12);
        }

        .visi-misi-card:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .card-header {
            margin-bottom: 30px;
        }

        .card-header h2 {
            position: relative;
            display: inline-block;
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--primary);
            padding-bottom: 12px;
        }

        .card-header h2::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 70px;
            height: 4px;
            background: var(--gold);
            border-radius: 10px;
        }

        .card-content {
            font-size: 1.08rem;
            line-height: 2;
            color: #374151;
        }

        .card-content p {
            margin-bottom: 1.5rem;
        }

        .card-content ul,
        .card-content ol {
            padding-left: 1.5rem;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .card-content ul {
            list-style: disc;
        }

        .card-content ol {
            list-style: decimal;
        }

        .card-content li {
            margin-bottom: 0.9rem;
        }

        .card-content strong {
            color: var(--primary);
        }

        /* ====================================
           RESPONSIVE
        ==================================== */

        @media (max-width: 1200px) {
            .container {
                width: min(100% - 40px, 1120px);
            }
        }

        @media (max-width: 768px) {
            .content-wrapper {
                margin: 60px auto;
            }

            .card-header h2 {
                font-size: 1.9rem;
            }

            .card-content {
                font-size: 1rem;
                line-height: 1.9;
            }
        }

        @media (max-width: 640px) {
            .container {
                width: min(100% - 28px, 1120px);
            }

            .page-hero {
                padding: 75px 0 60px;
            }

            .page-hero h1 {
                font-size: 2rem;
            }

            .page-hero p {
                font-size: 1rem;
            }

            .card-header h2 {
                font-size: 1.7rem;
            }
        }
    </style>
</head>

<body>

    @include('component.header')

    <section
        class="page-hero"
        style="background-image: url('{{ !empty($visiMisi->hero_image) ? asset('storage/' . $visiMisi->hero_image) : '' }}');">

        <div class="container">
            <h1>{{ $visiMisi->hero_title ?? 'Visi & Misi' }}</h1>
            <p>{{ $visiMisi->hero_subtitle ?? 'Pascasarjana Universitas Ngudi Waluyo' }}</p>
        </div>

    </section>

    <main class="content-wrapper">

        <section class="visi-misi-card">
            <div class="card-header">
                <h2>{{ $visiMisi->judul_visi ?? 'Visi' }}</h2>
            </div>

            <div class="card-content">
                {!! $visiMisi->visi ?? '<p><em>Belum ada konten visi. Silakan isi melalui Admin Panel.</em></p>' !!}
            </div>
        </section>

        <section class="visi-misi-card">
            <div class="card-header">
                <h2>{{ $visiMisi->judul_misi ?? 'Misi' }}</h2>
            </div>

            <div class="card-content">
                {!! $visiMisi->misi ?? '<p><em>Belum ada konten misi. Silakan isi melalui Admin Panel.</em></p>' !!}
            </div>
        </section>

        <section class="visi-misi-card">
            <div class="card-header">
                <h2>{{ $visiMisi->judul_tujuan ?? 'Tujuan' }}</h2>
            </div>

            <div class="card-content">
                {!! $visiMisi->tujuan ?? '<p><em>Belum ada konten tujuan. Silakan isi melalui Admin Panel.</em></p>' !!}
            </div>
        </section>

        <section class="visi-misi-card">
            <div class="card-header">
                <h2>{{ $visiMisi->judul_tujuan_bidang ?? 'Tujuan UNW Dalam Bidang' }}</h2>
            </div>

            <div class="card-content">
                {!! $visiMisi->tujuan_bidang ?? '<p><em>Belum ada konten tujuan dalam bidang. Silakan isi melalui Admin Panel.</em></p>' !!}
            </div>
        </section>

        <section class="visi-misi-card">
            <div class="card-header">
                <h2>{{ $visiMisi->judul_sasaran_target ?? 'Sasaran dan Target' }}</h2>
            </div>

            <div class="card-content">
                {!! $visiMisi->sasaran_target ?? '<p><em>Belum ada konten sasaran dan target. Silakan isi melalui Admin Panel.</em></p>' !!}
            </div>
        </section>

    </main>

    @include('component.footer')

</body>

</html>