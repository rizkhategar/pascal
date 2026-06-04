<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $program->name }} - Akademik</title>
    
    <style>
        /* Variabel Warna dan Pengaturan Dasar */
        :root {
            /* --- VARIABEL UNTUK KOMPONEN HEADER & FOOTER --- */
            --primary: #072b57;
            --yellow: #f7b500;
            /* ----------------------------------------------- */

            /* Variabel untuk Konten Akademik */
            --primary-blue: #0f172a;   
            --primary-light: #1e293b;
            --accent-yellow: #eab308;  
            --accent-hover: #ca8a04;
            --text-dark: #334155;
            --text-muted: #64748b;
            --bg-light: #f8fafc;
            --white: #ffffff;
            --border: #e2e8f0;
        }

        /* Reset & Base Typography */
        *, *::before, *::after {
            box-sizing: border-box;
        }

        /* --- RESET GLOBAL UNTUK HEADER & FOOTER --- */
        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        button {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            font: inherit;
            color: inherit;
        }
        /* ------------------------------------------ */

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            margin: 0;
            padding: 0;
            color: var(--text-dark);
            background-color: var(--bg-light);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main { flex-grow: 1; }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* 1. Hero Section */
        .hero {
            position: relative;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 500px;
            display: flex;
            align-items: center;
            padding: 60px 0;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background-color: rgba(15, 23, 42, 0.75);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 700px;
            color: var(--white);
        }

        .hero-tag {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 14px;
            font-weight: 600;
            color: var(--accent-yellow);
            display: block;
            margin-bottom: 12px;
        }

        .hero-title {
            font-size: 42px;
            font-weight: 700;
            line-height: 1.2;
            margin: 0 0 20px 0;
        }

        .hero-desc {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 36px;
            color: #cbd5e1;
        }

        .hero-actions { display: flex; gap: 16px; flex-wrap: wrap; }

        .btn {
            display: inline-block;
            padding: 14px 32px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-primary { background-color: var(--accent-yellow); color: var(--primary-blue); }
        .btn-primary:hover { background-color: var(--accent-hover); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(234, 179, 8, 0.3); }
        .btn-outline { background-color: transparent; border: 2px solid var(--white); color: var(--white); }
        .btn-outline:hover { background-color: var(--white); color: var(--primary-blue); transform: translateY(-2px); }

        /* 2. Overview Section */
        .section-padding { padding: 80px 0; }
        .bg-white { background-color: var(--white); }

        .overview-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; }

        .section-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary-blue);
            margin: 0 0 24px 0;
            border-left: 5px solid var(--primary-blue);
            padding-left: 16px;
            line-height: 1.3;
        }

        .overview-text { color: var(--text-muted); line-height: 1.8; text-align: justify; }
        .overview-text p { margin-top: 0; margin-bottom: 16px; }

        .overview-image-wrapper {
            background-color: var(--bg-light);
            border-radius: 16px;
            height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border: 4px solid var(--white);
        }
        .overview-image { width: 100%; height: 100%; object-fit: cover; }

        /* 3. Requirement & Timeline Section */
        .req-section {
            background-color: var(--bg-light);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .req-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; }

        .card {
            background: var(--white);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
            height: 100%;
        }

        .card-header {
            display: flex; align-items: center; border-bottom: 1px solid var(--border);
            padding-bottom: 20px; margin-bottom: 24px;
        }

        .card-icon { width: 28px; height: 28px; margin-right: 16px; color: var(--accent-yellow); }
        .card-title { font-size: 24px; font-weight: 700; color: var(--primary-blue); margin: 0; }

        /* Daftar Prasyarat */
        .bullet-list { list-style: none; padding: 0; margin: 0; }
        .bullet-list li { display: flex; align-items: flex-start; margin-bottom: 20px; line-height: 1.6; color: var(--text-dark); }
        .bullet-list li::before {
            content: "•"; color: var(--primary-blue); font-size: 24px; font-weight: bold;
            line-height: 1; margin-right: 12px; margin-top: -2px;
        }

        /* Alur Pendaftaran (Timeline) */
        .timeline-list { list-style: none; padding: 0; margin: 0 0 0 16px; border-left: 2px solid #bfdbfe; position: relative; }
        .timeline-item { position: relative; padding-left: 32px; margin-bottom: 32px; }
        .timeline-item:last-child { margin-bottom: 0; }
        .timeline-number {
            position: absolute; left: -17px; top: 0; width: 32px; height: 32px;
            background-color: var(--primary-blue); color: var(--white); border-radius: 50%;
            display: flex; align-items: center; justify-content: center; font-weight: 700; border: 4px solid var(--white);
        }
        .timeline-title { font-size: 18px; font-weight: 700; color: var(--primary-blue); margin: 0 0 4px 0; }
        .timeline-desc { font-size: 14px; color: var(--text-muted); margin: 0; line-height: 1.5; }

        /* 4. Konsentrasi Matriks Jika-Maka */
        .text-center { text-align: center; max-width: 700px; margin: 0 auto 48px auto; }
        .text-center .section-title { border-left: none; padding-left: 0; }
        .text-center p { color: var(--text-muted); font-size: 16px; line-height: 1.6; }

        .matrix-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 32px; }

        .matrix-card {
            background-color: var(--primary-blue);
            color: var(--white);
            padding: 36px;
            border-radius: 16px;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .matrix-card:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2); }
        .matrix-bg-icon {
            position: absolute; top: 16px; right: 16px; width: 120px; height: 120px;
            opacity: 0.05; transition: opacity 0.3s ease;
        }
        .matrix-card:hover .matrix-bg-icon { opacity: 0.1; }
        .matrix-title {
            font-size: 24px; font-weight: 700; margin: 0 0 24px 0; display: flex; align-items: center; position: relative; z-index: 2;
        }
        .matrix-title svg { width: 32px; height: 32px; margin-right: 16px; color: var(--accent-yellow); }
        .matrix-content {
            background-color: rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 24px; border-radius: 8px; margin-bottom: 24px; position: relative; z-index: 2;
        }
        .matrix-content p { font-size: 14px; line-height: 1.8; margin: 0; }
        .highlight-text { color: var(--accent-yellow); font-weight: 700; font-size: 16px; }
        .matrix-link {
            display: inline-flex; align-items: center; color: var(--accent-yellow);
            text-decoration: none; font-weight: 600; font-size: 14px; position: relative; z-index: 2; transition: color 0.2s ease;
        }
        .matrix-link:hover { color: var(--white); }
        .matrix-link svg { width: 16px; height: 16px; margin-left: 8px; }

        /* Responsivitas Layar Kecil (Mobile) */
        @media (max-width: 768px) {
            .hero-title { font-size: 32px; }
            .overview-grid, .req-grid, .matrix-grid { grid-template-columns: 1fr; gap: 32px; }
            .hero-actions { flex-direction: column; }
            .btn { width: 100%; }
            .overview-image-wrapper { height: 250px; }
        }
    </style>
</head>
<body>
    
    @include('component.header')

    <main>
        <section class="hero" style="background-image: url('{{ asset('assets/images/' . $program->hero_image) }}');">
            <div class="hero-overlay"></div>
            
            <div class="container hero-content">
                <span class="hero-tag">Program Pascasarjana</span>
                <h1 class="hero-title">{{ $program->hero_title }}</h1>
                <p class="hero-desc">{{ $program->hero_desc }}</p>
                <div class="hero-actions">
                    <a href="#" class="btn btn-primary">Mulai Pendaftaran</a>
                    <a href="#" class="btn btn-outline">Unduh Kurikulum</a>
                </div>
            </div>
        </section>

        <section class="section-padding bg-white">
            <div class="container">
                <div class="overview-grid">
                    <div>
                        <h2 class="section-title">{{ $program->overview_title }}</h2>
                        <div class="overview-text">
                            @if(is_array($program->overview_content) || is_object($program->overview_content))
                                @foreach($program->overview_content as $paragraph)
                                    <p>{{ $paragraph }}</p>
                                @endforeach
                            @else
                                <p>{{ $program->overview_content }}</p>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="overview-image-wrapper">
                            <img src="{{ asset('assets/images/' . $program->overview_image) }}" alt="Aktivitas {{ $program->name }}" class="overview-image">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding req-section">
            <div class="container">
                <div class="req-grid">
                    
                    <div class="card">
                        <div class="card-header">
                            <svg class="card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <h3 class="card-title">Prasyarat Pendaftaran</h3>
                        </div>
                        <ul class="bullet-list">
                            @foreach($program->requirements as $requirement)
                                <li>{{ $requirement->requirement_text }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <svg class="card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            <h3 class="card-title">Alur Pendaftaran</h3>
                        </div>
                        <ol class="timeline-list">
                            @foreach($program->steps as $step)
                                <li class="timeline-item">
                                    <div class="timeline-number">{{ $step->step_number }}</div>
                                    <h4 class="timeline-title">{{ $step->title }}</h4>
                                    <p class="timeline-desc">{{ $step->description }}</p>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding bg-white">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-title">Konsentrasi {{ $program->name }}</h2>
                    <p>Pilih opsi peminatan yang paling sesuai dengan ambisi karir profesional Anda.</p>
                </div>

                <div class="matrix-grid">
                    @foreach($program->concentrations as $concentration)
                        <div class="matrix-card">
                            <svg class="matrix-bg-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                            
                            <h3 class="matrix-title">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                {{ $concentration->name }}
                            </h3>
                            
                            <div class="matrix-content">
                                <p>
                                    <span class="highlight-text">JIKA</span> {{ $concentration->if_condition }} <br><br>
                                    <span class="highlight-text">MAKA</span> {{ $concentration->then_outcome }}
                                </p>
                            </div>
                            
                            <a href="{{ $concentration->curriculum_link ?? '#' }}" class="matrix-link">
                                Pelajari Kurikulum <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    @include('component.footer')

</body>
</html>