<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $program['unwProgramStudi']['nama'] ?? 'Program Pascasarjana' }} - Universitas Ngudi Waluyo</title>
    
    <style>
        /* Variabel Warna dan Pengaturan Dasar */
        :root {
            --primary: #072b57;
            --yellow: #f7b500;
            --text-dark: #334155;
            --bg-light: #f8fafc;
            --white: #ffffff;
        }

        /* Reset & Base Typography */
        *, *::before, *::after {
            box-sizing: border-box;
        }

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

        main { 
            flex-grow: 1; 
            background-color: var(--white);
            padding: 40px 0;
        }

        .container {
            width: 100%;
            max-width: 1000px; /* Disesuaikan untuk kenyamanan membaca konten */
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Styling tambahan untuk menyesuaikan konten dari API */
        .api-content {
            line-height: 1.6;
        }
        
        .api-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 16px 0;
        }

        .api-content h3, .api-content h4 {
            color: var(--primary);
            margin-top: 24px;
        }
        
        .heading-page {
            border-bottom: 2px solid var(--yellow);
            padding-bottom: 8px;
            display: inline-block;
        }
    </style>
</head>
<body>
    
    @include('component.header')

    <main>
        <div class="container">
            <div class="api-content">
                {!! $program['body'] !!}
            </div>
        </div>
    </main>

    @include('component.footer')

</body>
</html>