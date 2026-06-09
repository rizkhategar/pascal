<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita - Pascasarjana UNW</title>
    <link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
    <style>
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

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--light);
            color: var(--text);
        }

        .container {
            width: min(100% - 40px, 1200px);
            margin: 0 auto;
        }

        /* Hero Detail Berita */
        .news-hero {
            background: linear-gradient(135deg, #072b57 0%, #052044 100%);
            color: var(--white);
            padding: 60px 0 130px;
            /* Padding bawah sengaja besar untuk efek overlap card */
        }

        /* Tombol Kembali yang Menarik */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--white) !important;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: .5px;
            transition: all 0.25s ease;
            margin-bottom: 24px;
        }

        .back-link:hover {
            background: var(--yellow) !important;
            color: var(--primary-dark) !important;
            border-color: var(--yellow);
            transform: translateX(-4px);
        }

        .news-category-pill {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            background: rgba(247, 181, 0, .15);
            border: 1px solid rgba(247, 181, 0, .35);
            color: var(--yellow);
            border-radius: 999px;
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .news-title-page {
            margin: 0 0 24px;
            font-size: clamp(26px, 4.2vw, 42px);
            line-height: 1.2;
            font-weight: 900;
        }

        /* Meta dengan Icon */
        .news-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            color: rgba(255, 255, 255, .85);
            font-size: 14px;
            font-weight: 600;
        }

        .news-meta span {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.08);
            padding: 6px 14px;
            border-radius: 20px;
        }

        .news-meta span i {
            color: var(--yellow);
            font-size: 14px;
        }

        /* Layout Utama: Lebih Lebar, Menggantung (Overlap) */
        .news-content-section {
            padding: 0 0 80px;
            margin: 0;
        }

        .news-detail-shell {
            width: 100%;
            max-width: 1060px;
            /* Lebar optimal, tidak memenuhi layar penuh desktop */
            margin: -90px auto 0;
            /* Efek menumpuk ke atas hero */
            padding: 0 20px;
        }

        .news-card-detail {
            background: var(--white);
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(7, 43, 87, 0.08);
            overflow: hidden;
            width: 100%;
            border: 1px solid rgba(7, 43, 87, 0.05);
        }

        .news-cover-wrap {
            width: 100%;
            overflow: hidden;
        }

        .news-cover {
            width: 100%;
            height: clamp(300px, 45vw, 540px);
            object-fit: cover;
            display: block;
        }

        /* Area Konten Bacaan */
        .news-body {
            max-width: 880px;
            /* Lebar pembatas teks bacaan agar nyaman dibaca */
            margin: 0 auto;
            padding: 50px 40px 60px;
        }

        .news-excerpt-detail {
            margin: 0 0 32px;
            padding: 22px 24px;
            border-left: 5px solid var(--yellow);
            background: #fff9e6;
            color: #374151;
            font-size: 16px;
            line-height: 1.75;
            font-weight: 600;
            border-radius: 0 12px 12px 0;
        }

        .news-content-html {
            color: #232933;
            font-size: 17px;
            line-height: 1.85;
        }

        .news-content-html p {
            margin: 0 0 22px;
        }

        /* ==========================================================================
       PENGATURAN GAMBAR MENYAMPING (HILANGKAN GARIS TABEL)
       ========================================================================== */
        .news-content-html table,
        .news-content-html tr,
        .news-content-html td,
        .news-content-html th {
            border: none !important;
            /* Menghapus garis border tabel */
            border-collapse: collapse !important;
            background: transparent !important;
            padding: 6px !important;
            /* Memberi jarak antar gambar menyamping */
        }

        .news-content-html table img {
            max-width: 100%;
            height: auto;
            border-radius: 8px !important;
            /* Membuat sudut gambar melengkung lembut */
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
            margin: 0 auto !important;
            display: block;
        }

        .news-content-html img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 32px auto;
            border-radius: 8px;
        }

        .news-content-html h1,
        .news-content-html h2,
        .news-content-html h3 {
            color: var(--primary);
            margin: 36px 0 18px;
            font-weight: 800;
        }

        /* States */
        .empty-news,
        .loading-news {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 40px;
            text-align: center;
            color: var(--muted);
            margin: 40px auto;
            max-width: 600px;
        }

        .loading-news {
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .detail-loader {
            width: 40px;
            height: 40px;
            border: 4px solid #e5e7eb;
            border-top-color: var(--yellow);
            border-radius: 50%;
            animation: spin .8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .news-hero {
                padding: 45px 0 100px;
            }

            .news-detail-shell {
                margin: -60px auto 0;
            }

            .news-body {
                padding: 30px 20px 40px;
            }

            .news-cover {
                height: 240px;
            }
        }
    </style>
</head>

<body>
    @include('component.header')

    <section class="news-hero">
        <div class="container">
            <!-- Tombol Kembali dengan Icon Menarik -->
            <a href="{{ route('home') }}#layanan-mahasiswa" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Berita
            </a>
            <div class="news-category-pill" id="newsCategory">Berita</div>
            <h1 class="news-title-page" id="newsTitle">Detail Berita</h1>
            <div class="news-meta" id="newsMeta"></div>
        </div>
    </section>

    <main class="news-content-section">
        <div class="news-detail-shell">
            <article class="news-card-detail" id="newsCard">
                <div class="loading-news">
                    <div class="detail-loader"></div>
                </div>
            </article>
        </div>
    </main>

    @include('component.footer')

    <script>
        (function() {
            const slug = @json($slug);
            const API_ORIGIN = 'https://panel-web.unw.ac.id';
            const API_NEWS = API_ORIGIN + '/api/news';

            function esc(value) {
                return String(value ?? '').replace(/[&<>'"]/g, function(char) {
                    return {
                        '&': '&amp;',
                        '<': '&lt;',
                        '>': '&gt;',
                        "'": '&#039;',
                        '"': '&quot;'
                    } [char]
                })
            }

            function toArray(payload) {
                if (Array.isArray(payload)) return payload;
                if (Array.isArray(payload?.data)) return payload.data;
                if (Array.isArray(payload?.data?.data)) return payload.data.data;
                return []
            }

            function extractItem(payload) {
                if (payload?.slug || payload?.id) return payload;
                if (payload?.data?.slug || payload?.data?.id) return payload.data;
                const list = toArray(payload);
                return list.find(item => item?.slug === slug) || list[0] || null
            }

            function formatDate(value) {
                if (!value) return '';
                const date = new Date(value);
                if (Number.isNaN(date.getTime())) return String(value);
                return date.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                })
            }
            async function getJson(url) {
                const response = await fetch(url, {
                    headers: {
                        Accept: 'application/json'
                    }
                });
                if (!response.ok) throw new Error('API gagal dimuat');
                return response.json()
            }
            async function tryGet(url) {
                try {
                    return await getJson(url)
                } catch (error) {
                    return null
                }
            }
            async function findNewsBySlug() {
                const encodedSlug = encodeURIComponent(slug);
                const direct = await tryGet(API_NEWS + '/' + encodedSlug);
                const directItem = direct ? extractItem(direct) : null;
                if (directItem && (!directItem.slug || directItem.slug === slug)) return directItem;
                const byQuery = await tryGet(API_NEWS + '?slug=' + encodedSlug);
                const queryList = toArray(byQuery);
                const queryItem = queryList.find(item => item?.slug === slug) || extractItem(byQuery);
                if (queryItem && (!queryItem.slug || queryItem.slug === slug)) return queryItem;
                for (let page = 1; page <= 12; page++) {
                    const payload = await tryGet(API_NEWS + '?paginate=100&page=' + page);
                    if (!payload) continue;
                    const item = toArray(payload).find(news => news?.slug === slug);
                    if (item) return item;
                    const last = Number(payload?.meta?.last_page || 0);
                    if (last && page >= last) break
                }
                return null
            }

            function renderNews(news) {
                const title = news?.title || 'Detail Berita';
                const category = (news?.category?.name || 'Berita').trim();
                const image = news?.image || news?.image_thumbnail || '';
                const excerpt = news?.excerpt || '';
                const body = news?.content || news?.body || news?.description || '';
                const date = news?.publishedAt || news?.published_at || news?.createdAt || news?.created_at || '';
                const author = news?.author?.name || '';
                const views = news?.views;

                document.title = title + ' - Pascasarjana UNW';
                document.getElementById('newsCategory').textContent = category;
                document.getElementById('newsTitle').textContent = title;

                // Menghasilkan markup dengan Ikon FontAwesome baru
                const meta = [];
                if (date) {
                    meta.push('<span><i class="fas fa-calendar-alt"></i> ' + esc(formatDate(date)) + '</span>');
                }
                if (author) {
                    meta.push('<span><i class="fas fa-user"></i> Oleh: ' + esc(author) + '</span>');
                }
                if (views !== undefined && views !== null) {
                    meta.push('<span><i class="fas fa-eye"></i> ' + esc(views) + ' dibaca</span>');
                }
                document.getElementById('newsMeta').innerHTML = meta.join('');

                const imageHtml = image ? '<div class="news-cover-wrap"><img src="' + esc(image) + '" alt="' + esc(
                    title) + '" class="news-cover"></div>' : '';
                const excerptHtml = excerpt ? '<p class="news-excerpt-detail">' + esc(excerpt) + '</p>' : '';
                const bodyHtml = body ? body : '<p>' + esc(excerpt || 'Isi lengkap berita belum tersedia.') + '</p>';

                document.getElementById('newsCard').innerHTML = imageHtml + '<div class="news-body">' + excerptHtml +
                    '<div class="news-content-html">' + bodyHtml + '</div></div>';
            }

            function renderError() {
                document.getElementById('newsTitle').textContent = 'Berita tidak ditemukan';
                document.getElementById('newsCard').innerHTML =
                    '<div class="empty-news">Berita belum dapat dimuat dari API berdasarkan slug: <strong>' + esc(
                        slug) +
                    '</strong>.<br>Silakan kembali ke daftar berita atau buka ulang halaman beberapa saat lagi.</div>'
            }
            findNewsBySlug().then(function(news) {
                if (news) renderNews(news);
                else renderError()
            }).catch(renderError);
        })();
    </script>
</body>

</html>
