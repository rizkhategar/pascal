<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak PMB - Pascasarjana UNW</title>
    <link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root{--primary:#07457d;--blue:#155b99;--blue2:#2d83bd;--white:#fff;--text:#1f2937;--muted:#6b7280;--border:#e5e7eb;--shadow:0 8px 22px rgba(15,23,42,.12)}
        *{box-sizing:border-box}body{margin:0;font-family:Arial,Helvetica,sans-serif;background:#f8fafc;color:var(--text)}.container{width:min(100% - 64px,1180px);margin:0 auto}.contact-hero{min-height:205px;background:linear-gradient(120deg,#145a9a 0%,#176da8 58%,#2d8aca 100%);color:#fff;position:relative;overflow:hidden;display:flex;align-items:flex-start;padding:32px 0}.contact-hero:before{content:"";position:absolute;left:20px;top:4px;width:90px;height:50px;background-image:radial-gradient(rgba(255,255,255,.6) 2px,transparent 2px);background-size:18px 18px;opacity:.8}.contact-hero:after{content:"";position:absolute;right:-50px;top:0;width:250px;height:260px;background:linear-gradient(120deg,rgba(255,255,255,.08),rgba(255,255,255,.15));transform:skewX(-34deg)}.contact-title{position:relative;z-index:1;font-size:clamp(30px,4vw,44px);line-height:1.1;margin:0 0 18px;font-weight:900;letter-spacing:-.5px}.contact-subtitle{position:relative;z-index:1;margin:0;font-size:clamp(18px,2.4vw,26px);font-weight:800}.contact-section{padding:70px 0 90px;background:linear-gradient(180deg,#fff,#f8fafc)}.contact-grid{display:grid;grid-template-columns:minmax(330px,460px) 1fr;gap:50px;align-items:start}.contact-list{display:grid;gap:24px}.contact-card{display:grid;grid-template-columns:74px 1fr;align-items:center;gap:28px;background:#fff;border:1px solid var(--border);border-radius:10px;min-height:112px;padding:22px 26px;box-shadow:var(--shadow)}.contact-icon{width:54px;height:54px;display:flex;align-items:center;justify-content:center;color:#064274;font-size:46px}.contact-info h2{font-size:25px;line-height:1;margin:0 0 8px;color:#064274;font-weight:900;text-transform:uppercase}.contact-info p,.contact-info a{margin:0;color:#6b7280;font-size:21px;line-height:1.35;text-decoration:none}.contact-info a:hover{color:#064274}.map-card{background:#fff;border:1px solid var(--border);border-radius:10px;box-shadow:var(--shadow);padding:30px}.map-frame{width:100%;height:535px;border:0;display:block}.map-caption{margin:0;color:#111827;font-size:24px;line-height:1.3}.wa-floating{position:fixed;right:22px;bottom:22px;width:62px;height:62px;border-radius:50%;background:#25d366;color:#fff;display:flex;align-items:center;justify-content:center;font-size:34px;text-decoration:none;box-shadow:0 16px 34px rgba(37,211,102,.35);z-index:9999;transition:.22s ease}.wa-floating:hover{transform:translateY(-4px) scale(1.03);background:#1ebe5d}@media(max-width:992px){.container{width:min(100% - 32px,1180px)}.contact-grid{grid-template-columns:1fr;gap:30px}.map-frame{height:420px}}@media(max-width:640px){.contact-hero{min-height:180px;padding:30px 0}.contact-section{padding:42px 0 70px}.contact-card{grid-template-columns:48px 1fr;gap:18px;min-height:96px;padding:18px}.contact-icon{width:42px;height:42px;font-size:36px}.contact-info h2{font-size:18px}.contact-info p,.contact-info a{font-size:16px}.map-card{padding:16px}.map-frame{height:330px}.map-caption{font-size:18px}.wa-floating{width:56px;height:56px;font-size:30px;right:16px;bottom:16px}}
    </style>
</head>
<body>
    @include('component.header')

    <section class="contact-hero">
        <div class="container">
            <h1 class="contact-title">Kontak Pendaftaran Mahasiswa Baru</h1>
            <p class="contact-subtitle">PMB Universitas Ngudi Waluyo</p>
        </div>
    </section>

    <main class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-list">
                    <article class="contact-card">
                        <div class="contact-icon"><i class="fas fa-map"></i></div>
                        <div class="contact-info"><h2>Sekretariat</h2><p>Jl. Diponegoro No. 186 Ungaran</p></div>
                    </article>
                    <article class="contact-card">
                        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                        <div class="contact-info"><h2>Email</h2><a href="mailto:pmb@unw.ac.id">pmb@unw.ac.id</a></div>
                    </article>
                    <article class="contact-card">
                        <div class="contact-icon"><i class="fas fa-phone"></i></div>
                        <div class="contact-info"><h2>Fax</h2><p>(024)-6925408</p></div>
                    </article>
                    <article class="contact-card">
                        <div class="contact-icon"><i class="fab fa-whatsapp"></i></div>
                        <div class="contact-info"><h2>Whatsapp (Admin)</h2><a href="https://wa.me/6285730339469" target="_blank" rel="noopener">+62 857-3033-9469</a></div>
                    </article>
                </div>

                <article class="map-card">
                    <iframe class="map-frame" src="https://www.google.com/maps?q=PMB%20Universitas%20Ngudi%20Waluyo&output=embed" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <p class="map-caption">PMB Universitas Ngudi Waluyo</p>
                </article>
            </div>
        </div>
    </main>

    <a class="wa-floating" href="https://wa.me/6285730339469" target="_blank" rel="noopener" aria-label="Chat WhatsApp Admin PMB"><i class="fab fa-whatsapp"></i></a>

    @include('component.footer')
</body>
</html>
