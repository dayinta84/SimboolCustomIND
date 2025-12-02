<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<footer class="footer-section text-white">
    <div class="footer-top-gradient"></div>

    <div class="footer-content py-5">
        <div class="container">
            <div class="row gy-4 align-items-stretch">

                <!-- Logo & Nama -->
                <div class="col-md-3 footer-logo-wrap d-flex align-items-center">
                    <img src="{{ asset('images/logo_simbool.png') }}" alt="Simbool Logo" class="footer-logo">
                    <div class="footer-logo-text ms-3">
                        <h5 class="fw-bold mb-0 text-gradient">SIMBOOL</h5>
                        <h5 class="fw-bold text-gradient mb-0">CUSTOM.IND</h5>
                    </div>
                </div>

                <!-- Menu -->
                <div class="col-md-2 d-flex flex-column justify-content-start">
                    <p class="fw-semibold mb-2">Menu</p>
                    <ul class="list-unstyled small mb-0">
                        <li>
                            <a href="{{ url('/') }}" class="footer-link d-flex align-items-center">
                                <i class="bi bi-house-door footer-icon me-2"></i> Beranda
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/produk') }}" class="footer-link d-flex align-items-center">
                                <i class="bi bi-box-seam footer-icon me-2"></i> Produk
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/marketplace') }}" class="footer-link d-flex align-items-center">
                                <i class="bi bi-shop-window footer-icon me-2"></i> Marketplace
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/profile') }}" class="footer-link d-flex align-items-center">
                                <i class="bi bi-person-circle footer-icon me-2"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/contact') }}" class="footer-link d-flex align-items-center">
                                <i class="bi bi-telephone footer-icon me-2"></i> Kontak
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Marketplace -->
                <div class="col-md-2 d-flex flex-column justify-content-start">
                    <p class="fw-semibold mb-2">Marketplace</p>
                    <ul class="list-unstyled small mb-0">
                        <li class="footer-item mb-2">
                            <a href="https://www.tiktok.com/@simboolcustom.ind" class="footer-link d-flex align-items-center">
                                <i class="bi bi-tiktok footer-icon"></i>
                                <span class="ms-2">Tiktok</span>
                            </a>
                        </li>

                        <li class="footer-item mb-2">
                            <a href="https://shopee.co.id/simboolcustom.ind" class="footer-link d-flex align-items-center">
                                <i class="bi bi-bag-fill footer-icon"></i>
                                <span class="ms-2">Shopee</span>
                            </a>
                        </li>

                        <li class="footer-item mb-2">
                            <a href="https://www.instagram.com/simboolcustom.ind/" class="footer-link d-flex align-items-center">
                                <i class="bi bi-instagram footer-icon"></i>
                                <span class="ms-2">Instagram</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div class="col-md-2">
                    <p class="fw-semibold mb-2">Kontak</p>
                    <ul class="list-unstyled small mb-0">
                        <li class="footer-item mb-2">
                            <a href="https://wa.me/6285931200646" target="_blank" class="footer-link d-flex align-items-center">
                                <i class="bi bi-whatsapp footer-icon"></i>
                                <span class="ms-2">+62 859-3120-0646</span>
                            </a>
                        </li>

                        <li class="footer-item mb-2">
                            <a href="https://wa.me/6289617024003" target="_blank" class="footer-link d-flex align-items-center">
                                <i class="bi bi-whatsapp footer-icon"></i>
                                <span class="ms-2">+62 896-1702-4003</span>
                            </a>
                        </li>

                        <li class="footer-item mb-2">
                            <a href="https://wa.me/62895410286959" target="_blank" class="footer-link d-flex align-items-center">
                                <i class="bi bi-whatsapp footer-icon"></i>
                                <span class="ms-2">+62 895-4102-86959</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Alamat -->
                <div class="col-md-3">
                    <p class="fw-semibold mb-2">Alamat</p>
                    <ul class="list-unstyled small mb-0">
                        <li class="footer-item">
                            <i class="bi bi-geo-alt footer-icon"></i>
                            <span>
                                Gang Cinta, Nglandung Tiga, Nglandung, Kec. Geger, Kabupaten Madiun, Jawa Timur 63171    
                            </span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom py-3 text-center text-dark bg-light small">
        © 2025 Simbool Custom Industries
    </div>
</footer>

<style>
/* ===== FOOTER BASE ===== */
.footer-section {
    background: #0b0b0f; /* Sama seperti navbar */
    position: relative;
    font-family: 'Poppins', sans-serif;
    overflow: hidden;
}

/* GARIS ATAS GRADIENT (lebih modern, match navbar glow) */
.footer-top-gradient {
    height: 5px;
    width: 100%;
    background: linear-gradient(90deg, #d000ff, #00d4ff, #7000ff, #d000ff);
    background-size: 300% 300%;
    animation: gradientFlow 6s ease infinite;
}

@keyframes gradientFlow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Fade-in smooth */
.footer-content {
    animation: fadeIn 1s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ===== LOGO ===== */
.footer-logo {
    width: 85px;
    filter: drop-shadow(0 0 10px rgba(0,212,255,0.25));
    transition: transform 0.3s ease;
}
.footer-logo:hover {
    transform: scale(1.07);
}

/* TEXT GRADIENT */
.footer-logo-text h5 {
    font-size: 1.4rem;
    background: linear-gradient(90deg, #d000ff, #00d4ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 0 10px rgba(0,212,255,0.25);
    letter-spacing: 1px;
}

/* ===== LINK ===== */
.footer-link {
    color: #cfcfcf;
    text-decoration: none;
    position: relative;
    transition: all 0.3s ease;
}
.footer-link:hover {
    color: #00d4ff;
    text-shadow: 0 0 8px #00d4ff;
}
.footer-link::after {
    content: '';
    position: absolute;
    width: 0%;
    height: 2px;
    bottom: -3px;
    left: 0;
    background: linear-gradient(90deg, #d000ff, #00d4ff);
    transition: width 0.3s ease;
}
.footer-link:hover::after {
    width: 100%;
}

/* TEXT COLOR */
.footer-section p,
.footer-section span,
.footer-item {
    color: #cfcfcf;
}
.footer-section .fw-semibold {
    color: #ffffff;
}

/* ===== FOOTER BOTTOM ===== */
.footer-bottom {
    font-size: 0.9rem;
    background: #0d0d0d;
    color: #bdbdbd;
    border-top: 1px solid rgba(255,255,255,0.1);
    backdrop-filter: blur(6px);
    letter-spacing: 0.4px;
}

/* ===== BACKGROUND GLOW ===== */
.footer-section::before {
    content: "";
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(0,212,255,0.08), transparent 60%);
    animation: glowMove 12s linear infinite;
}
@keyframes glowMove {
    0% { transform: translate(0, 0); }
    50% { transform: translate(30%, 30%); }
    100% { transform: translate(0, 0); }
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .footer-logo-wrap {
        justify-content: center;
        text-align: center;
        flex-direction: column;
    }
    
    .footer-section .col-md-2,
    .footer-section .col-md-3 {
        text-align: center;
    }

    .footer-section ul {
        padding-left: 0 !important;
    }

    .footer-link,
    .footer-item {
        justify-content: center !important;
    }
}
</style>
