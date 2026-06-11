<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita - Pascasarjana UNW</title>
    <link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png" sizes="32x32">
    <link rel="shortcut icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('logo_unwnobg.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root{--primary:#072b57;--yellow:#f7b500;--white:#fff;--light:#f8fafc;--text:#111827;--muted:#64748b;--border:#e5e7eb}
        *{box-sizing:border-box}body{margin:0;font-family:Arial,Helvetica,sans-serif;background:var(--light);color:var(--text)}.container{width:min(100% - 40px,1180px);margin:0 auto}.news-hero{background:linear-gradient(135deg,#052044,#083b73);color:#fff;padding:72px 0;position:relative;overflow:hidden}.news-hero:after{content:"";position:absolute;right:-70px;top:-80px;width:280px;height:280px;background:rgba(247,181,0,.14);border-radius:50%;filter:blur(3px)}.news-hero .container{position:relative;z-index:1}.hero-kicker{display:inline-flex;align-items:center;gap:9px;color:var(--yellow);font-weight:900;font-size:13px;text-transform:uppercase;letter-spacing:1.4px;margin-bottom:12px}.page-title{font-size:clamp(32px,5vw,52px);line-height:1.1;margin:0 0 16px;font-weight:900}.page-desc{max-width:720px;margin:0;color:rgba(255,255,255,.82);font-size:17px;line-height:1.7}.news-section{padding:52px 0 80px}.news-toolbar{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:24px;flex-wrap:wrap}.filter-bar{display:flex;gap:8px;flex-wrap:wrap;padding:12px;background:#fff;border:1px solid rgba(7,43,87,.1);border-radius:14px;box-shadow:0 10px 28px rgba(15,23,42,.05)}.filter-btn{display:inline-flex;align-items:center;gap:7px;border:1px solid rgba(7,43,87,.16);background:#f8fafc;color:var(--primary);font-weight:900;font-size:12px;border-radius:8px;padding:8px 13px;cursor:pointer;white-space:nowrap;transition:.2s ease}.filter-btn i{color:var(--yellow)}.filter-btn.active,.filter-btn:hover{background:var(--yellow);border-color:var(--yellow);color:#fff;box-shadow:0 8px 18px rgba(247,181,0,.25)}.filter-btn.active i,.filter-btn:hover i{color:#fff}.search-box{height:42px;min-width:260px;border:1px solid var(--border);border-radius:10px;background:#fff;padding:0 14px;outline:none;font-weight:700;color:var(--primary)}.news-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:22px}.news-card{background:#fff;border:1px solid rgba(7,43,87,.1);border-radius:18px;overflow:hidden;box-shadow:0 16px 38px rgba(15,23,42,.08);transition:.24s ease;text-decoration:none;color:inherit;display:flex;flex-direction:column;min-height:100%}.news-card:hover{transform:translateY(-4px);box-shadow:0 24px 48px rgba(15,23,42,.12)}.news-thumb{height:220px;background:#eef2f7;overflow:hidden;position:relative;flex-shrink:0}.news-thumb img{width:100%;height:100%;object-fit:cover;object-position:center;display:block;transition:.35s ease}.news-card:hover img{transform:scale(1.04)}.news-body{padding:18px;display:flex;flex-direction:column;flex:1}.news-category,.news-date{display:inline-flex;align-items:center;gap:7px;color:var(--primary);font-weight:900;font-size:12px}.news-category i,.news-date i{color:var(--yellow)}.news-title{font-size:18px;line-height:1.38;color:var(--primary);font-weight:900;margin:11px 0;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden}.news-excerpt{color:var(--muted);font-size:14px;line-height:1.65;margin:0 0 14px;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;flex:1}.pagination{margin-top:32px;display:flex;align-items:center;justify-content:center;gap:8px;flex-wrap:wrap}.page-btn{height:38px;min-width:38px;border:1px solid rgba(7,43,87,.16);border-radius:8px;background:#fff;color:var(--primary);font-weight:900;cursor:pointer;padding:0 12px}.page-btn.active,.page-btn:hover{background:var(--yellow);border-color:var(--yellow);color:#fff}.page-btn[disabled]{opacity:.45;cursor:not-allowed;background:#f1f5f9;color:#94a3b8}.page-dots{font-weight:900;color:#94a3b8}.page-jump{display:flex;align-items:center;gap:7px;margin-left:6px;border-left:1px solid rgba(7,43,87,.12);padding-left:12px}.page-jump input{width:72px;height:38px;border:1px solid rgba(7,43,87,.16);border-radius:8px;padding:0 10px;color:var(--primary);font-weight:900;outline:none}.page-jump button{height:38px;border:0;border-radius:8px;background:var(--primary);color:#fff;font-size:12px;font-weight:900;padding:0 13px;cursor:pointer}.page-jump button:hover{background:var(--yellow)}.loading,.empty{grid-column:1/-1;background:#fff;border:1px solid var(--border);border-radius:16px;padding:32px;text-align:center;color:var(--muted);font-weight:800}.loader{width:42px;height:42px;border:4px solid #e5e7eb;border-top-color:var(--yellow);border-radius:50%;animation:spin .8s linear infinite;margin:0 auto}@keyframes spin{to{transform:rotate(360deg)}}@media(max-width:992px){.news-grid{grid-template-columns:repeat(2,1fr)}}@media(max-width:640px){.container{width:min(100% - 28px,1180px)}.news-hero{padding:52px 0}.news-section{padding:34px 0 60px}.news-grid{grid-template-columns:1fr}.search-box{width:100%;min-width:0}.news-toolbar{align-items:stretch}.filter-bar{overflow-x:auto;flex-wrap:nowrap;padding-bottom:12px;scrollbar-width:none}.filter-bar::-webkit-scrollbar{display:none}.filter-btn{flex:0 0 auto}.news-thumb{height:205px}.pagination{justify-content:flex-start;overflow-x:auto;flex-wrap:nowrap;padding-bottom:6px;scrollbar-width:none}.pagination::-webkit-scrollbar{display:none}.page-jump{flex:0 0 auto}.page-jump input{width:58px}}
    </style>
</head>
<body>
    @include('component.header')

    <section class="news-hero">
        <div class="container">
            <div class="hero-kicker"><i class="fas fa-newspaper"></i> Berita Pascasarjana</div>
            <h1 class="page-title">Berita Terkini & Agenda</h1>
            <p class="page-desc">Kumpulan berita, agenda, dan informasi terbaru Pascasarjana Universitas Ngudi Waluyo.</p>
        </div>
    </section>

    <main class="news-section">
        <div class="container">
            <div class="news-toolbar">
                <div class="filter-bar" id="newsFilters"><button class="filter-btn active"><i class="fas fa-tag"></i>Semua</button></div>
                <input class="search-box" id="newsSearch" type="search" placeholder="Cari berita...">
            </div>
            <div class="news-grid" id="newsGrid"><div class="loading"><div class="loader"></div></div></div>
            <div class="pagination" id="newsPagination"></div>
        </div>
    </main>

    @include('component.footer')

    <script>
        (function(){
            const API_ORIGIN='https://panel-web.unw.ac.id';
            const API={news:API_ORIGIN+'/api/news',category:API_ORIGIN+'/api/category'};
            const state={page:1,lastPage:1,category:{id:'all',slug:'all'},q:''};
            const grid=document.getElementById('newsGrid'),filters=document.getElementById('newsFilters'),pagination=document.getElementById('newsPagination'),search=document.getElementById('newsSearch');
            function esc(v){return String(v??'').replace(/[&<>'"]/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#039;','"':'&quot;'}[c]))}
            function strip(v){return String(v??'').replace(/<[^>]*>/g,'').replace(/\s+/g,' ').trim()}
            function arr(p){if(Array.isArray(p))return p;if(Array.isArray(p?.data))return p.data;if(Array.isArray(p?.data?.data))return p.data.data;return[]}
            function date(v){if(!v)return'';const d=new Date(v);return Number.isNaN(d.getTime())?String(v):d.toLocaleDateString('id-ID',{day:'2-digit',month:'long',year:'numeric'})}
            function img(u){if(!u)return'';u=String(u);if(/^https?:\/\//i.test(u))return u;if(u.startsWith('/'))return API_ORIGIN+u;return API_ORIGIN+'/'+u.replace(/^\/+/, '')}
            async function get(url){const r=await fetch(url,{headers:{Accept:'application/json'}});if(!r.ok)throw new Error('failed');return r.json()}
            function normalize(item){const c=item?.category||{};return{title:String(item?.title??'Tanpa Judul'),slug:String(item?.slug??''),image:String(item?.image_thumbnail||item?.image||''),excerpt:String(item?.excerpt??''),date:String(item?.publishedAt||item?.published_at||item?.createdAt||item?.created_at||''),categoryId:String(c?.id??item?.category_id??''),categorySlug:String(c?.slug??''),categoryName:String(c?.name??'Artikel')}}
            function url(){const p=new URLSearchParams({paginate:'9',page:String(state.page)});if(state.category.id!=='all'){p.set('category_id',state.category.id);p.set('category',state.category.slug||state.category.id)}return API.news+'?'+p.toString()}
            function render(items){const q=state.q.toLowerCase();if(q)items=items.filter(n=>(n.title+' '+strip(n.excerpt)).toLowerCase().includes(q));if(!items.length){grid.innerHTML='<div class="empty">Belum ada berita yang sesuai.</div>';return}grid.innerHTML=items.map(n=>'<a class="news-card" href="/berita/'+encodeURIComponent(n.slug)+'"><div class="news-thumb">'+(n.image?'<img src="'+esc(img(n.image))+'" alt="'+esc(n.title)+'">':'')+'</div><div class="news-body"><div class="news-category"><i class="fas fa-tag"></i>'+esc(n.categoryName)+'</div><h2 class="news-title">'+esc(n.title)+'</h2><p class="news-excerpt">'+esc(strip(n.excerpt))+'</p><div class="news-date"><i class="fas fa-calendar-alt"></i>'+esc(date(n.date))+'</div></div></a>').join('')}
            function renderPages(){const last=Math.max(1,state.lastPage),cur=Math.min(state.page,last);let start=Math.max(1,cur-2),end=Math.min(last,start+4);if(end-start<4)start=Math.max(1,end-4);let html='<button class="page-btn" data-page="'+(cur-1)+'" '+(cur<=1?'disabled':'')+'>‹</button>';for(let p=start;p<=end;p++)html+='<button class="page-btn '+(p===cur?'active':'')+'" data-page="'+p+'">'+p+'</button>';if(end<last)html+='<span class="page-dots">...</span><button class="page-btn" data-page="'+last+'">'+last+'</button>';html+='<button class="page-btn" data-page="'+(cur+1)+'" '+(cur>=last?'disabled':'')+'>›</button><div class="page-jump"><input type="number" min="1" max="'+last+'" value="'+cur+'" aria-label="Pilih halaman"><button type="button">Go</button></div>';pagination.innerHTML=html;pagination.querySelectorAll('[data-page]').forEach(b=>b.onclick=()=>{const p=Number(b.dataset.page);if(p>=1&&p<=last&&p!==cur){state.page=p;load()}});const input=pagination.querySelector('.page-jump input'),button=pagination.querySelector('.page-jump button');function jump(){const p=Number(input.value);if(p>=1&&p<=last&&p!==cur){state.page=p;load()}}button?.addEventListener('click',jump);input?.addEventListener('keydown',e=>{if(e.key==='Enter')jump()})}
            async function load(){grid.innerHTML='<div class="loading"><div class="loader"></div></div>';try{const p=await get(url());state.lastPage=Number(p?.meta?.last_page||1);state.page=Number(p?.meta?.current_page||state.page);render(arr(p).map(normalize));renderPages()}catch(e){grid.innerHTML='<div class="empty">Berita belum dapat dimuat.</div>'}}
            async function loadFilters(){try{const p=await get(API.category);filters.innerHTML='<button class="filter-btn active" data-id="all" data-slug="all"><i class="fas fa-tag"></i>Semua</button>'+arr(p).map(c=>'<button class="filter-btn" data-id="'+esc(c.id)+'" data-slug="'+esc(c.slug||'')+'"><i class="fas fa-tag"></i>'+esc(c.name)+'</button>').join('');filters.querySelectorAll('.filter-btn').forEach(btn=>btn.onclick=()=>{filters.querySelectorAll('.filter-btn').forEach(b=>b.classList.remove('active'));btn.classList.add('active');state.category={id:btn.dataset.id,slug:btn.dataset.slug};state.page=1;load()})}catch(e){}}
            search.addEventListener('input',()=>{state.q=search.value;state.page=1;load()});
            loadFilters();load();
        })();
    </script>
</body>
</html>
