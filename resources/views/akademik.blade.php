<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @php
        // Logika aman untuk mengambil data (berjaga-jaga jika Controller melempar array lengkap dengan key 'data' atau sudah diekstrak)
        $dataProgram = isset($program['data']) ? $program['data'] : $program;
        
        $namaProgram = $dataProgram['unwProgramStudi']['nama'] ?? 'Program Akademik';
        $bodyContent = $dataProgram['body'] ?? '<p class="empty-state">Konten belum tersedia untuk program ini.</p>';
        
        // Format tanggal jika ada di API
        $createdAt = isset($dataProgram['createdAt']) 
            ? \Carbon\Carbon::parse($dataProgram['createdAt'])->translatedFormat('d F Y') 
            : null;
    @endphp

    <title>{{ $namaProgram }} - Pascasarjana UNW</title>
    <link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Konfigurasi Variabel Warna Mengikuti show.blade.php */
        :root {
            --primary: #072b57;
            --primary-dark: #052044;
            --yellow: #f7b500;
            --white: #fff;
            --light: #f8fafc;
            --text: #111827;
            --muted: #64748b;
            --border: #e5e7eb;
        }

        * { box-sizing: border-box; }
        
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(180deg, #f8fafc, #eef5f6);
            color: var(--text);
        }

        .container {
            width: min(100% - 40px, 1180px);
            margin: 0 auto;
        }

        /* ==========================================
           HERO SECTION (BANNER GRADIENT PREMIUM)
           ========================================== */
        .page-hero {
            background: linear-gradient(135deg, rgba(7,43,87,.98), rgba(5,32,68,.94));
            color: var(--white);
            padding: 54px 0 88px;
            position: relative;
            overflow: hidden;
        }

        .page-hero:after {
            content: "";
            position: absolute;
            right: -120px;
            top: -120px;
            width: 340px;
            height: 340px;
            background: rgba(247, 181, 0, .14);
            border-radius: 50%;
            filter: blur(4px);
        }

        /* STYLE TOMBOL KEMBALI KAPSUL (PERSIS SHOW.BLADE.PHP) */
        .back-link {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--white) !important;
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.2);
            text-decoration: none;
            font-weight: 900;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 22px;
            padding: 11px 16px;
            border-radius: 999px;
            box-shadow: 0 12px 26px rgba(0,0,0,.14);
            transition: .25s ease;
            width: fit-content;
        }

        .back-link:hover {
            transform: translateX(-4px);
            background: var(--yellow) !important;
            color: var(--primary) !important;
            border-color: var(--yellow);
        }

        .back-link i { font-size: 14px; }

        /* Kategori Pill */
        .category-pill {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            background: rgba(247, 181, 0, .14);
            border: 1px solid rgba(247, 181, 0, .35);
            color: var(--yellow);
            border-radius: 999px;
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 16px;
            text-transform: uppercase;
        }

        .title-page {
            position: relative;
            z-index: 1;
            max-width: 1120px;
            margin: 0 0 18px;
            font-size: clamp(28px, 4.5vw, 48px);
            line-height: 1.16;
            font-weight: 900;
        }

        /* Meta Banner Data */
        .page-meta {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            color: rgba(255,255,255,.86);
            font-size: 14px;
            font-weight: 700;
        }

        .page-meta span {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.16);
            padding: 8px 11px;
            border-radius: 999px;
        }

        .page-meta i { color: var(--yellow); font-size: 14px; }

        /* ==========================================
           KONTEN UTAMA (OVERLAPPING / MEMOTONG HERO)
           ========================================== */
        .content-section {
            padding: 0 0 78px;
            margin-top: -46px; /* Efek memotong / overlapping */
            position: relative;
            z-index: 2;
        }

        .detail-shell {
            width: min(100% - 40px, 1180px);
            margin: 0 auto;
        }

        /* Kartu Pembungkus Putih */
        .card-detail {
            width: 100%;
            background: var(--white);
            border: 1px solid rgba(7,43,87,.1);
            border-radius: 24px;
            box-shadow: 0 24px 70px rgba(15,23,42,.14);
            overflow: hidden;
        }

        .page-body {
            max-width: 980px;
            margin: 0 auto;
            padding: 50px 44px 64px;
        }

        /* ==========================================
           STYLING UNTUK HTML YANG KELUAR DARI API
           ========================================== */
        .content-html {
            color: #1f2937;
            font-size: 17px;
            line-height: 1.9;
        }

        .content-html p { margin: 0 0 20px; }
        
        .content-html img {
            max-width: 100%;
            height: auto;
            border: 0 !important;
            outline: 0 !important;
            box-shadow: none !important;
            border-radius: 12px !important;
            display: block;
            margin: 24px auto;
        }

        /* Styling Tabel dari API Editor */
        .content-html table, .content-html tr, .content-html td, .content-html th {
            border: 0 !important;
            outline: 0 !important;
            box-shadow: none !important;
            background: transparent !important;
        }
        
        .content-html table {
            border-collapse: separate !important;
            border-spacing: 12px !important;
            width: 100% !important;
        }

        .content-html td { padding: 0 !important; vertical-align: top; }
        .content-html td img {
            width: 100%;
            height: auto;
            margin: 0 !important;
            display: block;
            border-radius: 12px !important;
        }

        .content-html h1, .content-html h2, .content-html h3 {
            color: var(--primary);
            line-height: 1.25;
            margin: 30px 0 16px;
        }

        .content-html ul, .content-html ol {
            padding-left: 24px;
            margin-bottom: 20px;
        }

        /* Override khusus untuk class "heading-page" bawaan payload API Anda */
        .content-html h4.heading-page {
            font-size: 22px;
            font-weight: 800;
            color: var(--primary);
            border-bottom: 3px solid var(--yellow);
            padding-bottom: 8px;
            display: inline-block;
            margin: 40px 0 20px 0;
            text-transform: uppercase;
        }

        .empty-state {
            text-align: center;
            color: var(--muted);
            font-style: italic;
            padding: 40px 0;
        }

        /* Responsive Layar HP & Tablet */
        @media(max-width: 768px) {
            .container { width: min(100% - 28px, 1180px); }
            .page-hero { padding: 42px 0 72px; }
            .detail-shell { width: min(100% - 24px, 1180px); }
            .card-detail { border-radius: 18px; }
            .page-body { padding: 30px 20px 40px; }
            .content-html { font-size: 16px; }
            .page-meta span { width: auto; }
            .content-html h4.heading-page { font-size: 18px; margin: 25px 0 15px 0; }
        }
    </style>
</head>
<body>

    @include('component.header')

    <section class="page-hero">
        <div class="container">
            <a href="javascript:history.back()" class="back-link">
                <i class="fas fa-arrow-left"></i><span>Kembali</span>
            </a>
            
            <div class="category-pill">
                <i class="fas fa-graduation-cap"></i><span>Akademik Pascasarjana</span>
            </div>
            
            <h1 class="title-page">{{ $namaProgram }}</h1>
            
            <div class="page-meta">
                @if($createdAt)
                    <span><i class="fas fa-calendar-alt"></i> Dipublikasi: {{ $createdAt }}</span>
                @endif
                <span><i class="fas fa-university"></i> Universitas Ngudi Waluyo</span>
            </div>
        </div>
    </section>

    <main class="content-section">
        <div class="detail-shell">
            <article class="card-detail">
                <div class="page-body">
                    <div class="content-html">
                        {!! $bodyContent !!}
                    </div>
                </div>
            </article>
        </div>
    </main>

    @include('component.footer')

</body>
</html>