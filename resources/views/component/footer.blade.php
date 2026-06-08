<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
.hero .container,
.hero-content,
.hero-text {
    position: relative !important;
    z-index: 50 !important;
}

.hero-title,
.hero-subtitle,
.hero .btn-primary {
    position: relative !important;
    z-index: 60 !important;
}

.hero .btn-primary {
    pointer-events: auto;
}

.program-section .program-card,
.program-section .program-detail {
    cursor: pointer;
}

.footer{
    background:#022B63;
    color:#fff;
    padding:40px 0 20px;
}

.footer-content{
    display:grid;
    grid-template-columns:1.3fr 1fr 1fr .8fr;
    gap:60px;
    align-items:flex-start;
}

.footer-column h3{
    font-size:15px;
    font-weight:700;
    margin-bottom:20px;
    text-transform:uppercase;
}

.footer-item{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:15px;
    font-size:15px;
    font-weight:600;
}

.footer-item i{
    color:#FFC107;
    width:20px;
    font-size:18px;
    text-align:center;
}

.footer-item a{
    color:#fff;
    text-decoration:none;
}

.footer-item a:hover{
    color:#FFC107;
}

.footer-links{
    list-style:none;
    padding:0;
    margin:0;
}

.footer-links li{
    margin-bottom:16px;
}

.footer-links a{
    color:#fff;
    font-size:15px;
    font-weight:600;
    text-decoration:none;
    transition:.3s;
}

.footer-links a:hover{
    color:#FFC107;
    padding-left:5px;
}

.social-icons{
    display:flex;
    align-items:center;
    gap:12px;
}

.social-icons a{
    width:36px;
    height:36px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#FFC107;
    font-size:22px;
    transition:.3s;
}

.social-icons a:hover{
    transform:translateY(-3px);
}

.footer-bottom{
    margin-top:35px;
    padding-top:15px;
    border-top:1px solid rgba(255,255,255,.35);
    text-align:center;
    font-size:14px;
    font-weight:600;
}

/* MAP */
.map-container{
    width:100%;
    max-width:280px;
}

.footer-map{
    width:100%;
    height:180px;
    border:none;
    border-radius:18px;
    display:block;
}

/* RESPONSIVE */
@media(max-width:992px){

    .footer-content{
        grid-template-columns:repeat(2,1fr);
        gap:35px;
    }
}

@media(max-width:768px){

    .footer{
        text-align:center;
    }

    .footer-content{
        grid-template-columns:1fr;
        gap:30px;
    }

    .footer-item{
        justify-content:center;
    }

    .social-icons{
        justify-content:center;
    }

    .map-container{
        margin:auto;
    }
}
</style>

<footer class="footer">
    <div class="container">

        <div class="footer-content">

            {{-- KONTAK --}}
            <div class="footer-column">
                <h3>KONTAK</h3>

                <div class="footer-item">
                    <i class="fas fa-location-dot"></i>
                    <span>Universitas Ngudi Waluyo</span>
                </div>

                <div class="footer-item">
                    <i class="fas fa-phone"></i>
                    <span>0261 438-3363</span>
                </div>

                <div class="footer-item">
                    <i class="fab fa-whatsapp"></i>
                    <span>0561 438-3363</span>
                </div>

                <div class="footer-item">
                    <i class="fas fa-globe"></i>
                    <a href="https://www.unw.ac.id" target="_blank">
                        universitasngudiwaluyo.com
                    </a>
                </div>
            </div>

            {{-- LOKASI --}}
            <div class="footer-column">
                <h3>LOKASI</h3>

                <div class="map-container">
                    <iframe
                        class="footer-map"
                        src="https://maps.google.com/maps?q=Universitas%20Ngudi%20Waluyo&t=&z=15&ie=UTF8&iwloc=&output=embed"
                        loading="lazy"
                        allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            {{-- LINK CEPAT --}}
            <div class="footer-column">
                <h3>LINK CEPAT</h3>

                <ul class="footer-links">
                    <li>
                        <a href="#">Akreditasi</a>
                    </li>

                    <li>
                        <a href="https://pmb.unw.ac.id/">Admisi</a>
                    </li>

                    <li>
                        <a href="#">Penjaminan Mutu</a>
                    </li>

                    <li>
                        <a href="#">Riset & PDM</a>
                    </li>
                </ul>
            </div>

            {{-- MEDIA SOSIAL --}}
            <div class="footer-column">
                <h3>MEDIA SOSIAL</h3>

                <div class="social-icons">

                    <a href="#">
                        <i class="fab fa-facebook"></i>
                    </a>

                    <a href="#">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a href="#">
                        <i class="fab fa-x-twitter"></i>
                    </a>

                    <a href="#">
                        <i class="fab fa-youtube"></i>
                    </a>

                </div>
            </div>

        </div>

        <div class="footer-bottom">
            © {{ date('Y') }} Universitas Ngudi Waluyo. All Rights Reserved
        </div>

    </div>
</footer>

@if (isset($heroSlides) && $heroSlides->count() > 0)
    <script>
        (function () {
            const heroSlidesData = @json($heroSlides->map(fn ($slide) => [
                'title' => $slide->title,
                'subtitle' => $slide->subtitle,
                'image' => asset('storage/' . $slide->image_path),
            ])->values());

            if (!heroSlidesData.length) return;

            const hero = document.querySelector('.hero');
            const dotsWrapper = document.getElementById('heroDots');
            const titleEl = document.querySelector('.hero-title');
            const subtitleEl = document.querySelector('.hero-subtitle');

            if (!hero || !dotsWrapper) return;

            document.querySelectorAll('.hero-slide').forEach((slide) => slide.remove());
            dotsWrapper.innerHTML = '';

            heroSlidesData.forEach((item, index) => {
                const slide = document.createElement('div');
                slide.className = index === 0 ? 'hero-slide active' : 'hero-slide';
                slide.style.backgroundImage = `url('${item.image}')`;
                hero.insertBefore(slide, hero.firstElementChild);

                const dot = document.createElement('button');
                dot.className = index === 0 ? 'hero-dot active' : 'hero-dot';
                dot.type = 'button';
                dot.setAttribute('aria-label', `Slide ${index + 1}`);
                dotsWrapper.appendChild(dot);
            });

            if (titleEl) {
                titleEl.innerHTML = heroSlidesData[0].title.replace(/\n/g, '<br>');
            }

            if (subtitleEl) {
                subtitleEl.textContent = heroSlidesData[0].subtitle;
            }

            window.__homeHeroSlidesData = heroSlidesData;
        })();
    </script>
@endif

<script>
    (function () {
        function bindProgramDetailLinks() {
            const programCards = document.querySelectorAll('.program-section .program-card');

            const programDetailRoutes = [
                "{{ route('akademik.show', 'magister-hukum') }}",
                "{{ route('akademik.show', 'magister-manajemen-pendidikan') }}",
                "{{ route('akademik.show', 'magister-kesehatan-masyarakat') }}",
                "{{ route('akademik.show', 'magister-keperawatan') }}",
            ];

            programCards.forEach(function (card, index) {
                const url = programDetailRoutes[index];
                if (!url) return;

                card.setAttribute('href', url);
                card.setAttribute('aria-label', 'Lihat detail program studi');

                const detailText = card.querySelector('.program-detail');

                if (detailText) {
                    detailText.setAttribute('role', 'link');
                    detailText.setAttribute('tabindex', '0');
                    detailText.dataset.href = url;
                }
            });
        }

        document.addEventListener('click', function (event) {
            const detailText = event.target.closest('.program-section .program-detail');
            if (!detailText || !detailText.dataset.href) return;

            event.preventDefault();
            event.stopPropagation();
            window.location.href = detailText.dataset.href;
        }, true);

        document.addEventListener('keydown', function (event) {
            const detailText = event.target.closest('.program-section .program-detail');
            if (!detailText || !detailText.dataset.href) return;

            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                window.location.href = detailText.dataset.href;
            }
        }, true);

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', bindProgramDetailLinks);
        } else {
            bindProgramDetailLinks();
        }
    })();
</script>