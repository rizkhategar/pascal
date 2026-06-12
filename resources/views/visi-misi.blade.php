<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi, Misi</title>

    <link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Montserrat', sans-serif; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); color: var(--text); }
        
        .container { width: min(1120px, 92%); margin: 0 auto; }

        /* ==========================================
           0. HERO SECTION (POLOS TANPA GAMBAR)
           ========================================== */
        .page-hero {
            position: relative;
            background-color: var(--primary);
            padding: 90px 0 75px; 
            color: white;
            text-align: center;
            z-index: 1;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(5, 32, 68, 0.75); 
            z-index: -1;
        }

        .page-hero h1 { 
            font-size: 2.4rem; 
            font-weight: 800; 
            letter-spacing: 0.5px;
        }

        /* ==========================================
           1. CARD STYLES
           ========================================== */
        .visi-misi-wrapper {
            max-width: 900px;
            margin: 60px auto;
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .visi-misi-card {
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        }

        .card-header h2 {
            color: var(--primary);
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .card-header h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--yellow);
            border-radius: 2px;
        }

        .card-content {
            color: #374151;
            line-height: 1.8;
            font-size: 1.05rem;
        }

        .card-content ul, .card-content ol {
            padding-left: 20px;
            margin-top: 10px;
        }

        .card-content li {
            margin-bottom: 8px;
        }
    </style>
</head>

<body>

    @include('component.header')

    <section class="page-hero">
        <div class="container">
            <h1>Visi & Misi</h1>
        </div>
    </section>

    <div class="visi-misi-wrapper">
        @if($visiMisi)
            <section class="visi-misi-card">
                <div class="card-header">
                    <h2>Visi</h2>
                </div>
                <div class="card-content">
                    {!! $visiMisi->visi ?? '<p><em>Belum ada konten visi. Silakan isi melalui Admin Panel.</em></p>' !!}
                </div>
            </section>

            <section class="visi-misi-card">
                <div class="card-header">
                    <h2>Misi</h2>
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
        @else
            <div style="text-align: center; padding: 50px; background: white; border-radius: 12px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);">
                <h3 style="color: gray;">Data Visi & Misi belum diisi.</h3>
                <p>Silakan login ke Admin Panel untuk mengisi data.</p>
            </div>
        @endif
    </div>

    @include('component.footer')

</body>
</html>