<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    /* Kustomisasi khusus yang tidak ada di utility bawaan Bootstrap */
    .bg-unw { background-color: #022B63; }
    .text-unw-yellow { color: #FFC107; }
    
    .footer-link {
        color: #fff;
        transition: 0.3s;
    }
    .footer-link:hover {
        color: #FFC107;
        padding-left: 5px;
    }
    
    .social-icon-btn {
        width: 36px;
        height: 36px;
        transition: 0.3s;
    }
    .social-icon-btn:hover {
        transform: translateY(-3px);
        color: #fff !important; /* Opsional: ubah warna saat dihover */
    }
    
    .footer-map {
        width: 100%;
        height: 180px;
        border-radius: 18px;
    }
</style>

<footer class="bg-unw text-white pt-5 pb-3 mt-auto">
    <div class="container">
        <div class="row gx-lg-5 gy-4">

            {{-- KONTAK (4 Kolom di Desktop, 6 di Tablet, 12 di Mobile) --}}
            <div class="col-lg-4 col-md-6 col-12 text-center text-md-start">
                <h6 class="fw-bold mb-4 text-uppercase">Kontak</h6>

                <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-3 mb-3 fw-semibold">
                    <i class="fas fa-location-dot text-unw-yellow fs-5" style="width: 20px;"></i>
                    <span>Universitas Ngudi Waluyo</span>
                </div>

                <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-3 mb-3 fw-semibold">
                    <i class="fas fa-phone text-unw-yellow fs-5" style="width: 20px;"></i>
                    <span>0261 438-3363</span>
                </div>

                <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-3 mb-3 fw-semibold">
                    <i class="fab fa-whatsapp text-unw-yellow fs-5" style="width: 20px;"></i>
                    <span>0561 438-3363</span>
                </div>

                <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-3 mb-3 fw-semibold">
                    <i class="fas fa-globe text-unw-yellow fs-5" style="width: 20px;"></i>
                    <a href="https://www.unw.ac.id" target="_blank" class="text-white text-decoration-none footer-link">
                        universitasngudiwaluyo.com
                    </a>
                </div>
            </div>

            {{-- LOKASI (3 Kolom di Desktop, 6 di Tablet, 12 di Mobile) --}}
            <div class="col-lg-3 col-md-6 col-12 text-center text-md-start">
                <h6 class="fw-bold mb-4 text-uppercase">Lokasi</h6>
                <div class="mx-auto mx-md-0" style="max-width: 280px;">
                    <iframe
                        class="footer-map border-0"
                        src="https://maps.google.com/maps?q=Universitas%20Ngudi%20Waluyo&t=&z=15&ie=UTF8&iwloc=&output=embed"
                        loading="lazy"
                        allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            {{-- LINK CEPAT (3 Kolom di Desktop, 6 di Tablet, 12 di Mobile) --}}
            <div class="col-lg-3 col-md-6 col-12 text-center text-md-start">
                <h6 class="fw-bold mb-4 text-uppercase">Link Cepat</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-3">
                        <a href="#" class="text-decoration-none fw-semibold footer-link">Akreditasi</a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="text-decoration-none fw-semibold footer-link">Admisi</a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="text-decoration-none fw-semibold footer-link">Penjaminan Mutu</a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="text-decoration-none fw-semibold footer-link">Riset & PDM</a>
                    </li>
                </ul>
            </div>

            {{-- MEDIA SOSIAL (2 Kolom di Desktop, 6 di Tablet, 12 di Mobile) --}}
            <div class="col-lg-2 col-md-6 col-12 text-center text-md-start">
                <h6 class="fw-bold mb-4 text-uppercase">Media Sosial</h6>
                <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2">
                    <a href="#" class="social-icon-btn d-flex align-items-center justify-content-center text-unw-yellow text-decoration-none fs-4">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="social-icon-btn d-flex align-items-center justify-content-center text-unw-yellow text-decoration-none fs-4">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-icon-btn d-flex align-items-center justify-content-center text-unw-yellow text-decoration-none fs-4">
                        <i class="fab fa-x-twitter"></i>
                    </a>
                    <a href="#" class="social-icon-btn d-flex align-items-center justify-content-center text-unw-yellow text-decoration-none fs-4">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-12 text-center pt-3 border-top border-light border-opacity-25" style="font-size: 14px; font-weight: 600;">
                © {{ date('Y') }} Universitas Ngudi Waluyo. All Rights Reserved
            </div>
        </div>
    </div>
</footer>