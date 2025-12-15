<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<footer class="footer-section text-white">
    <div class="footer-top-gradient"></div>

    <div class="footer-content py-4">
        <div class="container">
            <div class="row g-3">

                <!-- Logo & Nama -->
                <div class="col-12 col-md-3 text-center text-md-start">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                        <img src="{{ asset('images/logo_simboollogo.png') }}" alt="Simbool Logo" class="footer-logo">
                        <div class="footer-logo-text ms-2">
                            <h6 class="fw-bold mb-0 text-gradient">SIMBOOL</h6>
                            <h6 class="fw-bold mb-0 text-gradient">CUSTOM.IND</h6>
                        </div>
                    </div>
                </div>

                <!-- Menu -->
                <div class="col-6 col-md-2">
                    <h6 class="footer-heading">Menu</h6>
                    <ul class="list-unstyled footer-list">
                        <li><a href="{{ url('/') }}" class="footer-link">Beranda</a></li>
                        <li><a href="{{ url('/produk') }}" class="footer-link">Produk</a></li>
                        <li><a href="{{ url('/marketplace') }}" class="footer-link">Marketplace</a></li>
                        <li><a href="{{ url('/profile') }}" class="footer-link">Profil</a></li>
                        <li><a href="{{ url('/contact') }}" class="footer-link">Kontak</a></li>
                    </ul>
                </div>

                <!-- Marketplace -->
                <div class="col-6 col-md-2">
                    <h6 class="footer-heading">Marketplace</h6>
                    <ul class="list-unstyled footer-list">
                        <li><a href="https://www.tiktok.com/@simboolcustom.ind" target="_blank" class="footer-link">TikTok</a></li>
                        <li><a href="https://shopee.co.id/simboolcustom.ind" target="_blank" class="footer-link">Shopee</a></li>
                        <li><a href="https://www.instagram.com/simboolcustom.ind/" target="_blank" class="footer-link">Instagram</a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div class="col-6 col-md-2">
                    <h6 class="footer-heading">Kontak</h6>
                    <ul class="list-unstyled footer-list">
                        <li><a href="https://wa.me/6285931200646" target="_blank" class="footer-link d-flex align-items-center"><i class="bi bi-whatsapp me-1"></i> 0859-3120-0646</a></li>
                        <li><a href="https://wa.me/6289617024003" target="_blank" class="footer-link d-flex align-items-center"><i class="bi bi-whatsapp me-1"></i> 0896-1702-4003</a></li>
                        <li><a href="https://wa.me/62895410286959" target="_blank" class="footer-link d-flex align-items-center"><i class="bi bi-whatsapp me-1"></i> 0895-4102-86959</a></li>
                    </ul>
                </div>

                <!-- Alamat -->
                <div class="col-6 col-md-3">
                    <h6 class="footer-heading">Alamat</h6>
                    <p class="footer-text mb-0">
                        <i class="bi bi-geo-alt me-1"></i> Gang Cinta, Nglandung Tiga,<br> Kec. Geger, Madiun,<br> Jawa Timur 63171
                    </p>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom py-2 text-center small">
        © 2025 Simbool Custom Industries
    </div>
</footer>

<style>
/* ===== FOOTER BASE ===== */
.footer-section {
    background: #0a0a0e;
    position: relative;
    font-family: 'Poppins', sans-serif;
    font-size: 0.875rem;
    overflow: hidden;
}

.footer-top-gradient {
    height: 3px;
    width: 100%;
    background: linear-gradient(90deg, #d000ff, #00d4ff, #7000ff, #d000ff);
    background-size: 300% 300%;
    animation: gradientFlow 8s ease infinite;
}

@keyframes gradientFlow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* ===== LOGO ===== */
.footer-logo {
    width: 60px;
    opacity: 0.95;
    transition: transform 0.25s ease;
}
.footer-logo:hover {
    transform: scale(1.05);
}

.footer-logo-text h6 {
    font-size: 1.1rem;
    background: linear-gradient(90deg, #d000ff, #00d4ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: 0.5px;
    line-height: 1.2;
}

/* ===== TEXT & LINK ===== */
.footer-heading {
    font-size: 0.85rem;
    font-weight: 600;
    color: #fff;
    margin-bottom: 0.6rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.footer-link,
.footer-text {
    color: #b0b0b0;
    text-decoration: none;
    transition: all 0.2s ease;
    font-size: 0.85rem;
}
.footer-link:hover {
    color: #00d4ff;
}

.footer-list {
    margin: 0;
    padding: 0;
}
.footer-list li {
    line-height: 1.6;
}

/* ===== FOOTER BOTTOM ===== */
.footer-bottom {
    background: #08080c;
    color: #999;
    border-top: 1px solid rgba(255,255,255,0.08);
    font-size: 0.82rem;
}

/* ===== GLOW (subtle) ===== */
.footer-section::before {
    content: "";
    position: absolute;
    top: -40%;
    left: -40%;
    width: 180%;
    height: 180%;
    background: radial-gradient(circle, rgba(0,212,255,0.04), transparent 60%);
    animation: glowMove 20s linear infinite;
    z-index: -1;
}
@keyframes glowMove {
    0% { transform: translate(0, 0); }
    50% { transform: translate(20%, 20%); }
    100% { transform: translate(0, 0); }
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .footer-content .row > [class*="col-"] {
        text-align: center;
    }

    .footer-logo-text h6 {
        font-size: 1rem;
    }

    .footer-text,
    .footer-link {
        font-size: 0.825rem;
    }

    .footer-heading {
        font-size: 0.8rem;
        margin-bottom: 0.5rem;
    }
}
</style>