<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    .footer {
        background: #022B63;
        color: #fff;
        padding: 40px 0 20px;
    }

    .footer-content {
        display: grid;
        grid-template-columns: 1.3fr 1fr 1fr .8fr;
        gap: 60px;
        align-items: flex-start;
    }

    .footer-column h3 {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 20px;
        text-transform: uppercase;
    }

    .footer-item {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
        font-size: 15px;
        font-weight: 600;
    }

    .footer-item i {
        color: #FFC107;
        width: 20px;
        font-size: 18px;
        text-align: center;
        flex-shrink: 0;
    }

    .footer-item a {
        color: #fff;
        text-decoration: none;
    }

    .footer-item a:hover {
        color: #FFC107;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 16px;
    }

    .footer-links a {
        color: #fff;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        transition: .3s;
    }

    .footer-links a:hover {
        color: #FFC107;
        padding-left: 5px;
    }

    .social-icons {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .social-icons a {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FFC107;
        font-size: 22px;
        transition: .3s;
    }

    .social-icons a:hover {
        transform: translateY(-3px);
    }

    .footer-bottom {
        margin-top: 35px;
        padding-top: 15px;
        border-top: 1px solid rgba(255, 255, 255, .35);
        text-align: center;
        font-size: 14px;
        font-weight: 600;
    }

    .map-container {
        width: 100%;
        max-width: 280px;
    }

    .footer-map {
        width: 100%;
        height: 180px;
        border: none;
        border-radius: 18px;
        display: block;
    }

    @media(max-width: 992px) {
        .footer-content {
            grid-template-columns: repeat(2, 1fr);
            gap: 35px;
        }
    }

    @media(max-width: 768px) {
        .footer {
            text-align: left !important;
            padding: 34px 0 18px !important;
        }

        .footer-content {
            grid-template-columns: 1fr !important;
            gap: 26px !important;
        }

        .footer-column h3 {
            text-align: left !important;
            margin-bottom: 14px !important;
        }

        .footer-item {
            justify-content: flex-start !important;
            align-items: flex-start !important;
        }

        .footer-links li {
            text-align: left !important;
        }

        .social-icons {
            justify-content: flex-start !important;
        }

        .map-container {
            margin: 0 !important;
            max-width: 100% !important;
        }

        .footer-map {
            height: 210px !important;
        }

        .footer-bottom {
            text-align: left !important;
            line-height: 1.5;
        }
    }
</style>

<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-column">
                <h3>KONTAK</h3>
                <div class="footer-item"><i class="fas fa-location-dot"></i><span>Universitas Ngudi Waluyo</span></div>
                <div class="footer-item"><i class="fas fa-phone"></i><span>0261 438-3363</span></div>
                <div class="footer-item"><i class="fab fa-whatsapp"></i><span>0561 438-3363</span></div>
                <div class="footer-item">
                    <i class="fas fa-globe"></i>
                    <a href="https://www.unw.ac.id" target="_blank">universitasngudiwaluyo.com</a>
                </div>
            </div>

            <div class="footer-column">
                <h3>LOKASI</h3>
                <div class="map-container">
                    <iframe class="footer-map" src="https://maps.google.com/maps?q=Universitas%20Ngudi%20Waluyo&t=&z=15&ie=UTF8&iwloc=&output=embed" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <div class="footer-column">
                <h3>LINK CEPAT</h3>
                <ul class="footer-links">
                    <li><a href="#">Akreditasi</a></li>
                    <li><a href="https://pmb.unw.ac.id/">Admisi</a></li>
                    <li><a href="#">Penjaminan Mutu</a></li>
                    <li><a href="#">Riset & PDM</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>MEDIA SOSIAL</h3>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">© {{ date('Y') }} Universitas Ngudi Waluyo. All Rights Reserved</div>
    </div>
</footer>

@include('component.frontend-enhancements')
