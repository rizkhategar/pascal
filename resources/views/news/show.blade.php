<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita - Pascasarjana UNW</title>
    <link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
    <style>
        :root{--primary:#072b57;--primary-dark:#052044;--yellow:#f7b500;--white:#fff;--light:#f8fafc;--text:#111827;--muted:#64748b;--border:#e5e7eb}
        *{box-sizing:border-box}body{margin:0;font-family:Arial,Helvetica,sans-serif;background:var(--light);color:var(--text)}.container{width:min(100% - 40px,1180px);margin:0 auto}.news-hero{background:linear-gradient(135deg,rgba(7,43,87,.98),rgba(5,32,68,.95));color:var(--white);padding:58px 0 74px}.back-link{display:inline-flex;align-items:center;gap:8px;color:var(--yellow);text-decoration:none;font-weight:800;font-size:13px;text-transform:uppercase;letter-spacing:.8px;margin-bottom:20px}.news-category-pill{display:inline-flex;align-items:center;padding:8px 13px;background:rgba(247,181,0,.14);border:1px solid rgba(247,181,0,.35);color:var(--yellow);border-radius:999px;font-size:13px;font-weight:800;margin-bottom:16px}.news-title-page{max-width:1120px;margin:0 0 18px;font-size:clamp(28px,4.5vw,48px);line-height:1.16;font-weight:900}.news-meta{display:flex;align-items:center;gap:12px;flex-wrap:wrap;color:rgba(255,255,255,.78);font-size:14px;font-weight:600}.news-meta span{display:inline-flex;align-items:center;gap:6px}.news-content-section{padding:0 0 78px;margin:0}.news-detail-shell{width:100%;margin:0}.news-card-detail{background:var(--white);border:0;border-radius:0;box-shadow:none;overflow:hidden;width:100%}.news-cover-wrap{width:100%;background:transparent;margin:0;line-height:0;overflow:hidden}.news-cover{width:100%;height:clamp(320px,48vw,620px);object-fit:cover;display:block;border:0!important;outline:0!important;box-shadow:none!important;border-radius:0!important;margin:0;padding:0}.news-body{width:min(100% - 40px,1180px);margin:0 auto;padding:38px 0 64px}.news-excerpt-detail{margin:0 0 28px;padding:20px 22px;border-left:5px solid var(--yellow);background:#fff8e5;color:#374151;font-size:17px;line-height:1.75;font-weight:600;border-radius:0 12px 12px 0}.news-content-html{color:#1f2937;font-size:17px;line-height:1.9}.news-content-html p{margin:0 0 20px}.news-content-html img{max-width:100%;height:auto;border:0!important;outline:0!important;box-shadow:none!important;border-radius:0!important;display:block;margin:24px auto}.news-content-html h1,.news-content-html h2,.news-content-html h3{color:var(--primary);line-height:1.25;margin:30px 0 16px}.news-content-html ul,.news-content-html ol{padding-left:24px;margin-bottom:20px}.empty-news,.loading-news{background:var(--white);border:1px solid var(--border);border-radius:18px;padding:34px;text-align:center;color:var(--muted);line-height:1.7;width:min(100% - 40px,1180px);margin:34px auto}.loading-news{min-height:260px;display:flex;align-items:center;justify-content:center}.detail-loader{width:46px;height:46px;border:4px solid #e5e7eb;border-top-color:var(--yellow);border-radius:50%;animation:spin .8s linear infinite;margin:0 auto 14px}.loading-caption{font-weight:800;color:var(--primary)}@keyframes spin{to{transform:rotate(360deg)}}.external-link{display:inline-flex;margin-top:18px;color:var(--primary);font-weight:800;text-decoration:none}.external-link:hover{color:var(--yellow)}@media(max-width:768px){.container{width:min(100% - 28px,1180px)}.news-hero{padding:44px 0 58px}.news-body{width:min(100% - 28px,1180px);padding:26px 0 48px}.news-content-html{font-size:16px}.news-excerpt-detail{font-size:15px}.news-cover{height:260px}}
    </style>
</head>
<body>
    @include('component.header')

    <section class="news-hero">
        <div class="container">
            <a href="{{ route('home') }}#layanan-mahasiswa" class="back-link">← Kembali ke Berita</a>
            <div class="news-category-pill" id="newsCategory">Berita</div>
            <h1 class="news-title-page" id="newsTitle">Memuat Detail Berita...</h1>
            <div class="news-meta" id="newsMeta"></div>
        </div>
    </section>

    <main class="news-content-section">
        <div class="news-detail-shell">
            <article class="news-card-detail" id="newsCard">
                <div class="loading-news">
                    <div>
                        <div class="detail-loader"></div>
                        <div class="loading-caption">Memuat detail berita</div>
                    </div>
                </div>
            </article>
        </div>
    </main>

    @include('component.footer')

    <script>
        (function(){
            const slug = @json($slug);
            const API_ORIGIN = 'https://panel-web.unw.ac.id';
            const API_NEWS = API_ORIGIN + '/api/news';

            function esc(value){return String(value ?? '').replace(/[&<>'"]/g,function(char){return {'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#039;','"':'&quot;'}[char]})}
            function toArray(payload){if(Array.isArray(payload))return payload;if(Array.isArray(payload?.data))return payload.data;if(Array.isArray(payload?.data?.data))return payload.data.data;return[]}
            function extractItem(payload){if(payload?.slug||payload?.id)return payload;if(payload?.data?.slug||payload?.data?.id)return payload.data;const list=toArray(payload);return list.find(item=>item?.slug===slug)||list[0]||null}
            function formatDate(value){if(!value)return'';const date=new Date(value);if(Number.isNaN(date.getTime()))return String(value);return date.toLocaleDateString('id-ID',{day:'2-digit',month:'long',year:'numeric'})}
            async function getJson(url){const response=await fetch(url,{headers:{Accept:'application/json'}});if(!response.ok)throw new Error('API gagal dimuat');return response.json()}
            async function tryGet(url){try{return await getJson(url)}catch(error){return null}}

            async function findNewsBySlug(){
                const encodedSlug=encodeURIComponent(slug);
                const direct=await tryGet(API_NEWS+'/'+encodedSlug);
                const directItem=direct?extractItem(direct):null;
                if(directItem&&(!directItem.slug||directItem.slug===slug))return directItem;

                const byQuery=await tryGet(API_NEWS+'?slug='+encodedSlug);
                const queryList=toArray(byQuery);
                const queryItem=queryList.find(item=>item?.slug===slug)||extractItem(byQuery);
                if(queryItem&&(!queryItem.slug||queryItem.slug===slug))return queryItem;

                for(let page=1;page<=12;page++){
                    const payload=await tryGet(API_NEWS+'?paginate=100&page='+page);
                    if(!payload)continue;
                    const item=toArray(payload).find(news=>news?.slug===slug);
                    if(item)return item;
                    const last=Number(payload?.meta?.last_page||0);
                    if(last&&page>=last)break;
                }

                return null;
            }

            function renderNews(news){
                const title=news?.title||'Detail Berita';
                const category=(news?.category?.name||'Berita').trim();
                const image=news?.image||news?.image_thumbnail||'';
                const excerpt=news?.excerpt||'';
                const body=news?.content||news?.body||news?.description||'';
                const date=news?.publishedAt||news?.published_at||news?.createdAt||news?.created_at||'';
                const author=news?.author?.name||'';
                const views=news?.views;

                document.title=title+' - Pascasarjana UNW';
                document.getElementById('newsCategory').textContent=category;
                document.getElementById('newsTitle').textContent=title;

                const meta=[];
                if(date)meta.push('<span>'+esc(formatDate(date))+'</span>');
                if(author)meta.push('<span>Ditulis oleh '+esc(author)+'</span>');
                if(views!==undefined&&views!==null)meta.push('<span>'+esc(views)+' dibaca</span>');
                document.getElementById('newsMeta').innerHTML=meta.join('');

                const imageHtml=image?'<div class="news-cover-wrap"><img src="'+esc(image)+'" alt="'+esc(title)+'" class="news-cover"></div>':'';
                const excerptHtml=excerpt?'<p class="news-excerpt-detail">'+esc(excerpt)+'</p>':'';
                const bodyHtml=body?body:'<p>'+esc(excerpt||'Isi lengkap berita belum tersedia dari API. Data yang tersedia saat ini berasal dari ringkasan berita berdasarkan slug.')+'</p><a class="external-link" href="'+API_ORIGIN+'/news/'+esc(slug)+'" target="_blank" rel="noopener">Buka sumber berita asli →</a>';

                document.getElementById('newsCard').innerHTML=imageHtml+'<div class="news-body">'+excerptHtml+'<div class="news-content-html">'+bodyHtml+'</div></div>';
            }

            function renderError(){
                document.getElementById('newsTitle').textContent='Berita tidak ditemukan';
                document.getElementById('newsCard').innerHTML='<div class="empty-news">Berita belum dapat dimuat dari API berdasarkan slug: <strong>'+esc(slug)+'</strong>.<br>Silakan kembali ke daftar berita atau buka ulang halaman beberapa saat lagi.</div>';
            }

            findNewsBySlug().then(function(news){
                if(news)renderNews(news);else renderError();
            }).catch(renderError);
        })();
    </script>
</body>
</html>
