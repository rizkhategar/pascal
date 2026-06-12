<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita - Pascasarjana UNW</title>

    <link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png" sizes="64x64">
    <link rel="shortcut icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('logo_unwnobg.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary: #062f5f;
            --primary-dark: #031f42;
            --primary-soft: #07457d;
            --blue: #0b5f9f;
            --yellow: #f7b500;

            --white: #ffffff;
            --body-bg: #f6f9fc;
            --text: #0f172a;
            --text-soft: #334155;
            --muted: #64748b;
            --border: #e2e8f0;

            --radius-lg: 26px;
            --radius-md: 18px;

            --shadow-card: 0 22px 55px rgba(15, 23, 42, .12);
            --shadow-soft: 0 12px 30px rgba(15, 23, 42, .08);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(11, 95, 159, .08), transparent 28%),
                linear-gradient(180deg, #ffffff 0%, var(--body-bg) 42%, #eef5fb 100%);
            color: var(--text);
        }

        a {
            color: inherit;
        }

        .container {
            width: min(100% - 64px, 1120px);
            margin: 0 auto;
        }

        /* ================= HERO ================= */

        .news-hero {
            position: relative;
            overflow: hidden;
            padding: 44px 0 104px;
            color: #fff;
            background:
                radial-gradient(circle at 18% 8%, rgba(45, 156, 219, .24), transparent 28%),
                linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 52%, var(--blue) 100%);
        }

        .news-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, .055) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, .055) 1px, transparent 1px);
            background-size: 42px 42px;
            opacity: .35;
            pointer-events: none;
        }

        .news-hero::after {
            content: "";
            position: absolute;
            right: -180px;
            top: -210px;
            width: 560px;
            height: 560px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(255, 255, 255, .18), transparent 68%);
            pointer-events: none;
        }

        .hero-inner {
            position: relative;
            z-index: 2;
            max-width: 980px;
        }

        .back-link {
            width: fit-content;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
            padding: 10px 15px;
            border-radius: 999px;
            color: #fff !important;
            background: rgba(255, 255, 255, .10);
            border: 1px solid rgba(255, 255, 255, .20);
            text-decoration: none;
            font-size: 13px;
            font-weight: 900;
            letter-spacing: .4px;
            text-transform: uppercase;
            transition: .22s ease;
        }

        .back-link:hover {
            transform: translateX(-4px);
            background: var(--yellow);
            border-color: var(--yellow);
            color: var(--primary) !important;
        }

        .news-category-pill {
            width: fit-content;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
            padding: 8px 13px;
            border-radius: 999px;
            color: #ffe9a6;
            background: rgba(247, 181, 0, .13);
            border: 1px solid rgba(247, 181, 0, .32);
            font-size: 12px;
            font-weight: 900;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .news-title-page {
            max-width: 980px;
            margin: 0 0 18px;
            color: #fff;
            font-size: clamp(30px, 4.3vw, 52px);
            line-height: 1.08;
            font-weight: 900;
            letter-spacing: -.9px;
        }

        .news-meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .news-meta span {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 11px;
            border-radius: 999px;
            color: rgba(255, 255, 255, .88);
            background: rgba(255, 255, 255, .10);
            border: 1px solid rgba(255, 255, 255, .14);
            font-size: 13px;
            font-weight: 800;
        }

        .news-meta i {
            color: var(--yellow);
        }

        /* ================= CONTENT ================= */

        .news-content-section {
            position: relative;
            z-index: 4;
            margin-top: -66px;
            padding: 0 0 90px;
        }

        .news-detail-shell {
            width: min(100% - 64px, 1060px);
            margin: 0 auto;
        }

        .news-card-detail {
            overflow: hidden;
            background: var(--white);
            border: 1px solid rgba(226, 232, 240, .96);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
        }

        .news-cover-wrap {
            position: relative;
            width: 100%;
            overflow: hidden;
            background: #eaf1f8;
        }

        .news-cover {
            width: 100%;
            height: clamp(260px, 40vw, 500px);
            object-fit: cover;
            object-position: center;
            display: block;
            border: 0 !important;
            outline: 0 !important;
            box-shadow: none !important;
            border-radius: 0 !important;
            margin: 0;
            padding: 0;
        }

        .news-no-cover {
            min-height: 260px;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                radial-gradient(circle at 20% 20%, rgba(11, 95, 159, .12), transparent 32%),
                linear-gradient(135deg, #eef6ff, #f8fafc);
        }

        .news-no-cover i {
            width: 76px;
            height: 76px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 24px;
            color: var(--primary);
            background: rgba(6, 47, 95, .08);
            font-size: 32px;
        }

        .news-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 18px 26px;
            background: #fff;
            border-bottom: 1px solid var(--border);
        }

        .news-topbar-info {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .news-topbar-icon {
            width: 42px;
            height: 42px;
            flex: 0 0 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--blue));
            box-shadow: 0 10px 24px rgba(6, 47, 95, .22);
        }

        .news-topbar-info h2 {
            margin: 0 0 4px;
            color: var(--text);
            font-size: 18px;
            line-height: 1.25;
            font-weight: 900;
        }

        .news-topbar-info p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.45;
            font-weight: 600;
        }

        .news-action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex-shrink: 0;
            min-height: 40px;
            padding: 9px 14px;
            border: 1px solid rgba(6, 47, 95, .14);
            border-radius: 999px;
            background: #fff;
            color: var(--primary);
            font-size: 13px;
            font-weight: 900;
            text-decoration: none;
            cursor: pointer;
            transition: .22s ease;
        }

        .news-action-btn:hover {
            background: var(--primary);
            color: #fff;
            transform: translateY(-2px);
        }

        .news-body {
            max-width: 840px;
            margin: 0 auto;
            padding: 44px 42px 60px;
        }

        .news-excerpt-detail {
            position: relative;
            margin: 0 0 32px;
            padding: 22px 24px 22px 62px;
            border-radius: 20px;
            color: #1f2937;
            background:
                linear-gradient(135deg, rgba(247, 181, 0, .12), rgba(6, 47, 95, .05)),
                #ffffff;
            border: 1px solid rgba(226, 232, 240, .96);
            box-shadow: 0 12px 32px rgba(15, 23, 42, .07);
            font-size: 16px;
            line-height: 1.75;
            font-weight: 800;
        }

        .news-excerpt-detail::before {
            content: "\f10d";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            left: 23px;
            top: 22px;
            color: var(--yellow);
            font-size: 24px;
        }

        /* ================= API CONTENT ================= */

        .news-content-html {
            color: var(--text-soft);
            font-size: 17px;
            line-height: 1.92;
            word-break: break-word;
        }

        .news-content-html > *:first-child {
            margin-top: 0 !important;
        }

        .news-content-html > *:last-child {
            margin-bottom: 0 !important;
        }

        .news-content-html p {
            margin: 0 0 20px;
            color: var(--text-soft);
        }

        .news-content-html a {
            color: var(--blue);
            font-weight: 800;
            text-decoration: none;
            border-bottom: 1px solid rgba(11, 95, 159, .35);
        }

        .news-content-html a:hover {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .news-content-html h1,
        .news-content-html h2,
        .news-content-html h3,
        .news-content-html h4,
        .news-content-html h5,
        .news-content-html h6 {
            color: var(--primary);
            line-height: 1.28;
            font-weight: 900;
            letter-spacing: -.3px;
        }

        .news-content-html h1 {
            font-size: clamp(30px, 3vw, 40px);
            margin: 38px 0 18px;
        }

        .news-content-html h2 {
            font-size: clamp(25px, 2.6vw, 32px);
            margin: 36px 0 16px;
        }

        .news-content-html h3 {
            font-size: clamp(21px, 2.2vw, 27px);
            margin: 32px 0 14px;
        }

        .news-content-html h4 {
            position: relative;
            display: inline-block;
            margin: 30px 0 16px;
            padding-bottom: 9px;
            font-size: 21px;
        }

        .news-content-html h4::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 72px;
            height: 4px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--yellow), var(--blue));
        }

        .news-content-html ul,
        .news-content-html ol {
            margin: 0 0 24px;
            padding-left: 22px;
        }

        .news-content-html li {
            margin-bottom: 10px;
            color: var(--text-soft);
            line-height: 1.75;
        }

        .news-content-html blockquote {
            position: relative;
            margin: 28px 0;
            padding: 22px 24px 22px 62px;
            border-radius: 20px;
            color: var(--text-soft);
            background: #f8fafc;
            border: 1px solid var(--border);
            box-shadow: 0 10px 28px rgba(15, 23, 42, .05);
        }

        .news-content-html blockquote::before {
            content: "\f10d";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            left: 23px;
            top: 22px;
            color: var(--yellow);
            font-size: 22px;
        }

        .news-content-html img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 28px auto;
            border: 0 !important;
            outline: 0 !important;
            border-radius: 18px !important;
            box-shadow: var(--shadow-soft) !important;
        }

        .news-content-html iframe {
            width: 100%;
            min-height: 420px;
            border: 0;
            border-radius: 18px;
            box-shadow: var(--shadow-soft);
        }

        .news-content-html table {
            width: 100% !important;
            margin: 28px 0 !important;
            border-collapse: collapse !important;
            border-spacing: 0 !important;
            overflow: hidden;
            border-radius: 16px;
            background: #fff !important;
            box-shadow: var(--shadow-soft);
        }

        .news-content-html table th {
            color: #fff !important;
            background: linear-gradient(135deg, var(--primary), var(--blue)) !important;
            font-weight: 900 !important;
            text-align: left;
        }

        .news-content-html table th,
        .news-content-html table td {
            padding: 13px 15px !important;
            border: 1px solid var(--border) !important;
            vertical-align: top;
            color: var(--text-soft);
            line-height: 1.55;
        }

        .news-content-html table tr:nth-child(even) td {
            background: #f8fafc !important;
        }

        .news-content-html table img {
            width: 100%;
            height: auto;
            margin: 0 !important;
            border-radius: 12px !important;
            box-shadow: none !important;
        }

        .news-content-html hr {
            margin: 34px 0;
            border: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, #cbd5e1, transparent);
        }

        /* ================= STATE ================= */

        .loading-news,
        .empty-news {
            min-height: 310px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            gap: 14px;
            padding: 42px 24px;
            color: var(--muted);
            background: #fff;
            font-weight: 800;
            line-height: 1.7;
        }

        .detail-loader {
            width: 46px;
            height: 46px;
            border: 4px solid #e5e7eb;
            border-top-color: var(--yellow);
            border-right-color: var(--primary);
            border-radius: 50%;
            animation: spin .8s linear infinite;
        }

        .empty-news i {
            width: 62px;
            height: 62px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 22px;
            background: rgba(6, 47, 95, .08);
            color: var(--primary);
            font-size: 26px;
        }

        .empty-news strong {
            display: block;
            color: var(--text);
            font-size: 20px;
            line-height: 1.3;
        }

        .empty-news span {
            display: block;
            max-width: 540px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width: 768px) {
            .container {
                width: min(100% - 28px, 1120px);
            }

            .news-hero {
                padding: 38px 0 92px;
            }

            .back-link {
                margin-bottom: 18px;
                padding: 9px 13px;
                font-size: 12px;
            }

            .news-category-pill {
                font-size: 12px;
                padding: 8px 12px;
            }

            .news-title-page {
                font-size: clamp(29px, 8vw, 38px);
                letter-spacing: -.5px;
            }

            .news-meta span {
                font-size: 12px;
                padding: 8px 10px;
            }

            .news-content-section {
                margin-top: -52px;
                padding-bottom: 70px;
            }

            .news-detail-shell {
                width: min(100% - 24px, 1060px);
            }

            .news-card-detail {
                border-radius: 22px;
            }

            .news-cover {
                height: 250px;
            }

            .news-no-cover {
                min-height: 220px;
            }

            .news-topbar {
                align-items: flex-start;
                flex-direction: column;
                padding: 18px;
            }

            .news-action-btn {
                width: 100%;
            }

            .news-body {
                padding: 30px 20px 44px;
            }

            .news-excerpt-detail {
                padding: 20px 20px 20px 56px;
                font-size: 15px;
                border-radius: 18px;
            }

            .news-excerpt-detail::before {
                left: 21px;
                top: 20px;
                font-size: 22px;
            }

            .news-content-html {
                font-size: 16px;
                line-height: 1.82;
            }

            .news-content-html table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .news-content-html iframe {
                min-height: 310px;
            }
        }

        @media(max-width: 480px) {
            .news-cover {
                height: 220px;
            }

            .news-topbar-info {
                align-items: flex-start;
            }

            .news-topbar-icon {
                width: 38px;
                height: 38px;
                flex-basis: 38px;
                border-radius: 13px;
            }

            .news-topbar-info h2 {
                font-size: 17px;
            }

            .news-topbar-info p {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    @include('component.header')

    <section class="news-hero">
        <div class="container">
            <div class="hero-inner">
                <a href="{{ route('news.index') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke Berita</span>
                </a>

                <div class="news-category-pill" id="newsCategory">
                    <i class="fas fa-tag"></i>
                    <span>Berita</span>
                </div>

                <h1 class="news-title-page" id="newsTitle">Detail Berita</h1>

                <div class="news-meta" id="newsMeta"></div>
            </div>
        </div>
    </section>

    <main class="news-content-section">
        <div class="news-detail-shell">
            <article class="news-card-detail" id="newsCard">
                <div class="loading-news">
                    <div class="detail-loader"></div>
                    <span>Memuat detail berita...</span>
                </div>
            </article>
        </div>
    </main>

    @include('component.footer')

    <script>
        (function () {
            const slug = @json($slug);
            const API_ORIGIN = 'https://panel-web.unw.ac.id';
            const API_NEWS = API_ORIGIN + '/api/news';

            const newsCard = document.getElementById('newsCard');
            const newsTitle = document.getElementById('newsTitle');
            const newsCategory = document.getElementById('newsCategory');
            const newsMeta = document.getElementById('newsMeta');

            function esc(value) {
                return String(value ?? '').replace(/[&<>'"]/g, function (char) {
                    return {
                        '&': '&amp;',
                        '<': '&lt;',
                        '>': '&gt;',
                        "'": '&#039;',
                        '"': '&quot;'
                    }[char];
                });
            }

            function strip(value) {
                return String(value ?? '')
                    .replace(/<[^>]*>/g, '')
                    .replace(/\s+/g, ' ')
                    .trim();
            }

            function toArray(payload) {
                if (Array.isArray(payload)) return payload;
                if (Array.isArray(payload?.data)) return payload.data;
                if (Array.isArray(payload?.data?.data)) return payload.data.data;
                return [];
            }

            function extractItem(payload) {
                if (payload?.slug || payload?.id) return payload;
                if (payload?.data?.slug || payload?.data?.id) return payload.data;

                const list = toArray(payload);

                return list.find(function (item) {
                    return item?.slug === slug;
                }) || list[0] || null;
            }

            function formatDate(value) {
                if (!value) return '';

                const date = new Date(value);

                if (Number.isNaN(date.getTime())) {
                    return String(value);
                }

                return date.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                });
            }

            function imageUrl(url) {
                if (!url) return '';

                url = String(url);

                if (/^https?:\/\//i.test(url)) {
                    return url;
                }

                if (url.startsWith('/')) {
                    return API_ORIGIN + url;
                }

                return API_ORIGIN + '/' + url.replace(/^\/+/, '');
            }

            async function getJson(url) {
                const response = await fetch(url, {
                    headers: {
                        Accept: 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('API gagal dimuat');
                }

                return response.json();
            }

            async function tryGet(url) {
                try {
                    return await getJson(url);
                } catch (error) {
                    return null;
                }
            }

            async function findNewsBySlug() {
                const encodedSlug = encodeURIComponent(slug);

                const direct = await tryGet(API_NEWS + '/' + encodedSlug);
                const directItem = direct ? extractItem(direct) : null;

                if (directItem && (!directItem.slug || directItem.slug === slug)) {
                    return directItem;
                }

                const byQuery = await tryGet(API_NEWS + '?slug=' + encodedSlug);
                const queryList = toArray(byQuery);
                const queryItem = queryList.find(function (item) {
                    return item?.slug === slug;
                }) || extractItem(byQuery);

                if (queryItem && (!queryItem.slug || queryItem.slug === slug)) {
                    return queryItem;
                }

                for (let page = 1; page <= 12; page++) {
                    const payload = await tryGet(API_NEWS + '?paginate=100&page=' + page);

                    if (!payload) continue;

                    const item = toArray(payload).find(function (news) {
                        return news?.slug === slug;
                    });

                    if (item) return item;

                    const lastPage = Number(payload?.meta?.last_page || 0);

                    if (lastPage && page >= lastPage) break;
                }

                return null;
            }

            function renderNews(news) {
                const title = news?.title || 'Detail Berita';
                const category = (news?.category?.name || 'Berita').trim();

                const rawImage = news?.image || news?.image_thumbnail || '';
                const image = imageUrl(rawImage);

                const excerpt = strip(news?.excerpt || '');
                const body = news?.content || news?.body || news?.description || '';
                const date = news?.publishedAt || news?.published_at || news?.createdAt || news?.created_at || '';
                const author = news?.author?.name || '';
                const views = news?.views;

                document.title = title + ' - Pascasarjana UNW';

                newsCategory.innerHTML = `
                    <i class="fas fa-tag"></i>
                    <span>${esc(category)}</span>
                `;

                newsTitle.textContent = title;

                const meta = [];

                if (date) {
                    meta.push(`
                        <span>
                            <i class="fas fa-calendar-alt"></i>
                            ${esc(formatDate(date))}
                        </span>
                    `);
                }

                if (author) {
                    meta.push(`
                        <span>
                            <i class="fas fa-user"></i>
                            Oleh: ${esc(author)}
                        </span>
                    `);
                }

                if (views !== undefined && views !== null) {
                    meta.push(`
                        <span>
                            <i class="fas fa-eye"></i>
                            ${esc(views)} dibaca
                        </span>
                    `);
                }

                meta.push(`
                    <span>
                        <i class="fas fa-university"></i>
                        Pascasarjana UNW
                    </span>
                `);

                newsMeta.innerHTML = meta.join('');

                const imageHtml = image
                    ? `
                        <div class="news-cover-wrap">
                            <img src="${esc(image)}" alt="${esc(title)}" class="news-cover">
                        </div>
                    `
                    : `
                        <div class="news-cover-wrap news-no-cover">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    `;

                const excerptHtml = excerpt
                    ? `<p class="news-excerpt-detail">${esc(excerpt)}</p>`
                    : '';

                const bodyHtml = body
                    ? body
                    : `<p>${esc(excerpt || 'Isi lengkap berita belum tersedia.')}</p>`;

                newsCard.innerHTML = `
                    ${imageHtml}

                    <div class="news-topbar">
                        <div class="news-topbar-info">
                            <div class="news-topbar-icon">
                                <i class="fas fa-file-lines"></i>
                            </div>

                            <div>
                                <h2>Detail Berita</h2>
                                <p>Informasi resmi Pascasarjana Universitas Ngudi Waluyo</p>
                            </div>
                        </div>

                        <button class="news-action-btn" id="copyLinkButton" type="button">
                            <i class="fas fa-link"></i>
                            <span>Salin Link</span>
                        </button>
                    </div>

                    <div class="news-body">
                        ${excerptHtml}

                        <div class="news-content-html">
                            ${bodyHtml}
                        </div>
                    </div>
                `;

                const copyButton = document.getElementById('copyLinkButton');

                copyButton?.addEventListener('click', async function () {
                    try {
                        await navigator.clipboard.writeText(window.location.href);
                        copyButton.innerHTML = '<i class="fas fa-check"></i><span>Link Tersalin</span>';

                        setTimeout(function () {
                            copyButton.innerHTML = '<i class="fas fa-link"></i><span>Salin Link</span>';
                        }, 1600);
                    } catch (error) {
                        copyButton.innerHTML = '<i class="fas fa-triangle-exclamation"></i><span>Gagal</span>';

                        setTimeout(function () {
                            copyButton.innerHTML = '<i class="fas fa-link"></i><span>Salin Link</span>';
                        }, 1600);
                    }
                });
            }

            function renderError() {
                newsTitle.textContent = 'Berita tidak ditemukan';

                newsCategory.innerHTML = `
                    <i class="fas fa-circle-exclamation"></i>
                    <span>Tidak Ditemukan</span>
                `;

                newsMeta.innerHTML = `
                    <span>
                        <i class="fas fa-university"></i>
                        Pascasarjana UNW
                    </span>
                `;

                newsCard.innerHTML = `
                    <div class="empty-news">
                        <i class="fas fa-triangle-exclamation"></i>
                        <strong>Berita belum dapat dimuat</strong>
                        <span>
                            Berita belum dapat dimuat dari API berdasarkan slug:
                            <strong>${esc(slug)}</strong>.
                            Silakan kembali ke daftar berita atau coba muat ulang halaman beberapa saat lagi.
                        </span>
                    </div>
                `;
            }

            findNewsBySlug()
                .then(function (news) {
                    if (news) {
                        renderNews(news);
                    } else {
                        renderError();
                    }
                })
                .catch(renderError);
        })();
    </script>
</body>

</html>