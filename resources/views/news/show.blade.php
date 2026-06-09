<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ data_get($news, 'title', 'Detail Berita') }} - Pascasarjana UNW</title>
    <link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
    <style>
        :root {
            --primary: #072b57;
            --yellow: #f7b500;
            --white: #ffffff;
            --light: #f8fafc;
            --text: #111827;
            --muted: #64748b;
            --border: #e5e7eb;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--light);
            color: var(--text);
        }

        .container {
            width: min(100% - 32px, 980px);
            margin: 0 auto;
        }

        .news-hero {
            background: linear-gradient(135deg, rgba(7, 43, 87, .97), rgba(5, 32, 68, .94));
            color: var(--white);
            padding: 62px 0 72px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--yellow);
            text-decoration: none;
            font-weight: 800;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: .8px;
            margin-bottom: 18px;
        }

        .news-category-pill {
            display: inline-flex;
            align-items: center;
            padding: 8px 13px;
            background: rgba(247, 181, 0, .14);
            border: 1px solid rgba(247, 181, 0, .35);
            color: var(--yellow);
            border-radius: 999px;
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 16px;
        }

        .news-title-page {
            max-width: 900px;
            margin: 0 0 18px;
            font-size: clamp(30px, 4.6vw, 48px);
            line-height: 1.16;
            font-weight: 900;
        }

        .news-meta {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            color: rgba(255, 255, 255, .78);
            font-size: 14px;
            font-weight: 600;
        }

        .news-content-section {
            padding: 0 0 72px;
            margin-top: -36px;
        }

        .news-card-detail {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 22px;
            box-shadow: 0 22px 55px rgba(15, 23, 42, .12);
            overflow: hidden;
        }

        .news-cover {
            width: 100%;
            max-height: 520px;
            object-fit: cover;
            display: block;
            background: #e5e7eb;
        }

        .news-body {
            padding: 34px;
        }

        .news-excerpt-detail {
            margin: 0 0 24px;
            padding: 18px 20px;
            border-left: 5px solid var(--yellow);
            background: #fff8e5;
            color: #374151;
            font-size: 17px;
            line-height: 1.75;
            font-weight: 600;
            border-radius: 0 12px 12px 0;
        }

        .news-content-html {
            color: #1f2937;
            font-size: 16px;
            line-height: 1.85;
        }

        .news-content-html p { margin: 0 0 18px; }
        .news-content-html img { max-width: 100%; height: auto; border-radius: 14px; }
        .news-content-html h1,
        .news-content-html h2,
        .news-content-html h3 { color: var(--primary); line-height: 1.25; margin: 26px 0 14px; }
        .news-content-html ul,
        .news-content-html ol { padding-left: 22px; margin-bottom: 18px; }

        .empty-news {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 30px;
            text-align: center;
            color: var(--muted);
        }

        @media (max-width: 768px) {
            .news-hero { padding: 48px 0 64px; }
            .news-body { padding: 24px 18px; }
            .news-content-section { padding-bottom: 54px; }
        }
    </style>
</head>
<body>
    @include('component.header')

    @php
        $title = data_get($news, 'title', 'Detail Berita');
        $category = trim((string) data_get($news, 'category.name', 'Berita'));
        $image = data_get($news, 'image') ?: data_get($news, 'image_thumbnail');
        $dateRaw = data_get($news, 'publishedAt') ?: data_get($news, 'published_at') ?: data_get($news, 'createdAt') ?: data_get($news, 'created_at');
        $date = $dateRaw ? \Carbon\Carbon::parse($dateRaw)->translatedFormat('d F Y') : null;
        $author = data_get($news, 'author.name');
        $excerpt = data_get($news, 'excerpt');
        $body = data_get($news, 'content') ?: data_get($news, 'body') ?: data_get($news, 'description') ?: null;
    @endphp

    <section class="news-hero">
        <div class="container">
            <a href="{{ route('home') }}#layanan-mahasiswa" class="back-link">← Kembali ke Berita</a>
            <div class="news-category-pill">{{ $category ?: 'Berita' }}</div>
            <h1 class="news-title-page">{{ $title }}</h1>
            <div class="news-meta">
                @if ($date)
                    <span>{{ $date }}</span>
                @endif
                @if ($author)
                    <span>Ditulis oleh {{ $author }}</span>
                @endif
                @if (data_get($news, 'views') !== null)
                    <span>{{ data_get($news, 'views') }} dibaca</span>
                @endif
            </div>
        </div>
    </section>

    <main class="news-content-section">
        <div class="container">
            @if ($errorMessage)
                <div class="empty-news">{{ $errorMessage }}</div>
            @elseif ($news)
                <article class="news-card-detail">
                    @if ($image)
                        <img src="{{ $image }}" alt="{{ $title }}" class="news-cover">
                    @endif

                    <div class="news-body">
                        @if ($excerpt)
                            <p class="news-excerpt-detail">{{ $excerpt }}</p>
                        @endif

                        <div class="news-content-html">
                            @if ($body)
                                {!! $body !!}
                            @else
                                <p>{{ $excerpt ?: 'Isi berita belum tersedia dari API.' }}</p>
                            @endif
                        </div>
                    </div>
                </article>
            @else
                <div class="empty-news">Berita tidak ditemukan.</div>
            @endif
        </div>
    </main>

    @include('component.footer')
</body>
</html>
