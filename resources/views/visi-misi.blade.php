<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi & Misi | Pascasarjana Universitas Ngudi Waluyo</title>
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
            --gold: #d9a935;
            --green: #78927a;
        }

        /* --- TAMBAHAN CSS GLOBAL DARI HOME BLADE --- */
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
        /* ------------------------------------------- */

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--light);
            color: var(--text);
            overflow-x: hidden;
        }

        .page-hero {
            background: var(--primary);
            padding: 70px 0 55px;
            color: white;
            text-align: center;
        }

        .page-hero h1 {
            font-size: 2.6rem;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .page-hero p {
            font-size: 1.15rem;
            opacity: 0.9;
        }

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

        .card-icon {
            width: 52px;
            height: 52px;
            background: var(--yellow);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            flex-shrink: 0;
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

        /* --- TAMBAHAN RESPONSIVE CONTAINER DARI HOME BLADE --- */
        @media (max-width: 1200px) {
            .container {
                width: min(100% - 40px, 1120px);
            }
        }

        @media (max-width: 640px) {
            .container {
                width: min(100% - 28px, 1120px);
            }
        }
        /* ----------------------------------------------------- */
    </style>
</head>
<body>

    @include('component.header')

    <!-- Hero Section -->
    <section class="page-hero">
        <div class="container">
            <h1>Visi & Misi</h1>
            <p>Pascasarjana Universitas Ngudi Waluyo</p>
        </div>
    </section>

    <!-- Konten Utama -->
    <div class="content-wrapper">

        <!-- VISI -->
        <div class="visi-misi-card">
            <div class="card-header">
                <h2>Visi</h2>
            </div>
            <div class="card-content">
                {!! $visiMisi->visi ?? '<p><em>Belum ada konten visi. Silakan isi melalui Admin Panel.</em></p>' !!}
            </div>
        </div>

        <!-- MISI -->
        <div class="visi-misi-card">
            <div class="card-header">
                <h2>Misi</h2>
            </div>
            <div class="card-content">
                {!! $visiMisi->misi ?? '<p><em>Belum ada konten misi. Silakan isi melalui Admin Panel.</em></p>' !!}
            </div>
        </div>

    </div>

    @include('component.footer')

</body>
</html>