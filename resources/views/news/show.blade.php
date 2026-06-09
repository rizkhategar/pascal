<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita - Pascasarjana UNW</title>
    <link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
    <style>
        :root{--primary:#072b57;--primary-dark:#052044;--yellow:#f7b500;--white:#fff;--light:#f8fafc;--text:#111827;--muted:#64748b;--border:#e5e7eb}
        *{box-sizing:border-box}body{margin:0;font-family:Arial,Helvetica,sans-serif;background:linear-gradient(180deg,#f8fafc,#eef5f6);color:var(--text)}.container{width:min(100% - 40px,1180px);margin:0 auto}.news-hero{background:linear-gradient(135deg,rgba(7,43,87,.98),rgba(5,32,68,.94));color:var(--white);padding:54px 0 88px;position:relative;overflow:hidden}.news-hero:after{content:"";position:absolute;right:-120px;top:-120px;width:340px;height:340px;background:rgba(247,181,0,.14);border-radius:50%;filter:blur(4px)}.back-link{position:relative;z-index:1;display:inline-flex;align-items:center;gap:10px;color:var(--white)!important;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);text-decoration:none;font-weight:900;font-size:13px;text-transform:uppercase;letter-spacing:.5px;margin-bottom:22px;padding:11px 16px;border-radius:999px;box-shadow:0 12px 26px rgba(0,0,0,.14);transition:.25s ease}.back-link:hover{transform:translateX(-4px);background:var(--yellow)!important;color:var(--primary)!important;border-color:var(--yellow)}.back-link i{font-size:14px}.news-category-pill{position:relative;z-index:1;display:inline-flex;align-items:center;gap:8px;padding:8px 14px;background:rgba(247,181,0,.14);border:1px solid rgba(247,181,0,.35);color:var(--yellow);border-radius:999px;font-size:13px;font-weight:800;margin-bottom:16px;text-transform:uppercase}.news-category-pill i{font-size:13px}.news-title-page{position:relative;z-index:1;max-width:1120px;margin:0 0 18px;font-size:clamp(28px,4.5vw,48px);line-height:1.16;font-weight:900}.news-meta{position:relative;z-index:1;display:flex;align-items:center;gap:12px;flex-wrap:wrap;color:rgba(255,255,255,.86);font-size:14px;font-weight:700}.news-meta span{display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.16);padding:8px 11px;border-radius:999px}.news-meta i{color:var(--yellow);font-size:14px}.news-content-section{padding:0 0 78px;margin-top:-46px;position:relative;z-index:2}.news-detail-shell{width:min(100% - 40px,1180px);margin:0 auto}.news-card-detail{width:100%;background:var(--white);border:1px solid rgba(7,43,87,.1);border-radius:24px;box-shadow:0 24px 70px rgba(15,23,42,.14);overflow:hidden}.news-cover-wrap{width:100%;background:#eef2f7;line-height:0;overflow:hidden}.news-cover{width:100%;height:clamp(300px,42vw,560px);object-fit:cover;display:block;border:0!important;outline:0!important;box-shadow:none!important;border-radius:0!important;margin:0;padding:0}.news-body{max-width:980px;margin:0 auto;padding:40px 44px 54px}.news-excerpt-detail{margin:0 0 28px;padding:20px 22px;border-left:5px solid var(--yellow);background:#fff8e5;color:#374151;font-size:17px;line-height:1.75;font-weight:700;border-radius:0 14px 14px 0}.news-content-html{color:#1f2937;font-size:17px;line-height:1.9}.news-content-html p{margin:0 0 20px}.news-content-html img{max-width:100%;height:auto;border:0!important;outline:0!important;box-shadow:none!important;border-radius:12px!important;display:block;margin:24px auto}.news-content-html table,.news-content-html tr,.news-content-html td,.news-content-html th{border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important}.news-content-html table{border-collapse:separate!important;border-spacing:12px!important;width:100%!important}.news-content-html td{padding:0!important;vertical-align:top}.news-content-html td img{width:100%;height:auto;margin:0!important;display:block;border-radius:12px!important}.news-content-html h1,.news-content-html h2,.news-content-html h3{color:var(--primary);line-height:1.25;margin:30px 0 16px}.news-content-html ul,.news-content-html ol{padding-left:24px;margin-bottom:20px}.empty-news,.loading-news{background:var(--white);border:1px solid var(--border);border-radius:18px;padding:34px;text-align:center;color:var(--muted);line-height:1.7;width:min(100% - 40px,1180px);margin:34px auto}.loading-news{min-height:260px;display:flex;align-items:center;justify-content:center}.detail-loader{width:48px;height:48px;border:4px solid #e5e7eb;border-top-color:var(--yellow);border-radius:50%;animation:spin .8s linear infinite;margin:0 auto}@keyframes spin{to{transform:rotate(360deg)}}.external-link{display:inline-flex;margin-top:18px;color:var(--primary);font-weight:800;text-decoration:none}.external-link:hover{color:var(--yellow)}@media(max-width:768px){.container{width:min(100% - 28px,1180px)}.news-hero{padding:42px 0 72px}.news-detail-shell{width:min(100% - 24px,1180px)}.news-card-detail{border-radius:18px}.news-body{padding:24px 18px 40px}.news-content-html{font-size:16px}.news-excerpt-detail{font-size:15px}.news-cover{height:260px}.news-meta span{width:auto}}
    </style>
</head>
<body>
    @include('component.header')

    <section class="news-hero">
        <div class="container">
            <a href="{{ route('home') }}#layanan-mahasiswa" class="back-link"><i class="fas fa-arrow-left"></i><span>Kembali ke Berita</span></a>
            <div class="news-category-pill" id="newsCategory"><i class="fas fa-tag"></i><span>Berita</span></div>
            <h1 class="news-title-page" id="newsTitle">Detail Berita</h1>
            <div class="news-meta" id="newsMeta"></div>
        </div>
    </section>

    <main class="news-content-section">
        <div class="news-detail-shell">
            <article class="news-card-detail" id="newsCard">
                <div class="loading-news"><div class="detail-loader"></div></div>
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
            async function findNewsBySlug(){const encodedSlug=encodeURIComponent(slug);const direct=await tryGet(API_NEWS+'/'+encodedSlug);const directItem=direct?extractItem(direct):null;if(directItem&&(!directItem.slug||directItem.slug===slug))return directItem;const byQuery=await tryGet(API_NEWS+'?slug='+encodedSlug);const queryList=toArray(byQuery);const queryItem=queryList.find(item=>item?.slug===slug)||extractItem(byQuery);if(queryItem&&(!queryItem.slug||queryItem.slug===slug))return queryItem;for(let page=1;page<=12;page++){const payload=await tryGet(API_NEWS+'?paginate=100&page='+page);if(!payload)continue;const item=toArray(payload).find(news=>news?.slug===slug);if(item)return item;const last=Number(payload?.meta?.last_page||0);if(last&&page>=last)break}return null}
            function renderNews(news){const title=news?.title||'Detail Berita';const category=(news?.category?.name||'Berita').trim();const image=news?.image||news?.image_thumbnail||'';const excerpt=news?.excerpt||'';const body=news?.content||news?.body||news?.description||'';const date=news?.publishedAt||news?.published_at||news?.createdAt||news?.created_at||'';const author=news?.author?.name||'';const views=news?.views;document.title=title+' - Pascasarjana UNW';document.getElementById('newsCategory').innerHTML='<i class="fas fa-tag"></i><span>'+esc(category)+'</span>';document.getElementById('newsTitle').textContent=title;const meta=[];if(date)meta.push('<span><i class="fas fa-calendar-alt"></i>'+esc(formatDate(date))+'</span>');if(author)meta.push('<span><i class="fas fa-user"></i>Oleh: '+esc(author)+'</span>');if(views!==undefined&&views!==null)meta.push('<span><i class="fas fa-eye"></i>'+esc(views)+' dibaca</span>');document.getElementById('newsMeta').innerHTML=meta.join('');const imageHtml=image?'<div class="news-cover-wrap"><img src="'+esc(image)+'" alt="'+esc(title)+'" class="news-cover"></div>':'';const excerptHtml=excerpt?'<p class="news-excerpt-detail">'+esc(excerpt)+'</p>':'';const bodyHtml=body?body:'<p>'+esc(excerpt||'Isi lengkap berita belum tersedia.')+'</p>';document.getElementById('newsCard').innerHTML=imageHtml+'<div class="news-body">'+excerptHtml+'<div class="news-content-html">'+bodyHtml+'</div></div>'}
            function renderError(){document.getElementById('newsTitle').textContent='Berita tidak ditemukan';document.getElementById('newsCard').innerHTML='<div class="empty-news">Berita belum dapat dimuat dari API berdasarkan slug: <strong>'+esc(slug)+'</strong>.<br>Silakan kembali ke daftar berita atau buka ulang halaman beberapa saat lagi.</div>'}
            findNewsBySlug().then(function(news){if(news)renderNews(news);else renderError()}).catch(renderError);
        })();
    </script>
</body>
</html>
