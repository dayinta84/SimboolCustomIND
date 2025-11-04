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
                        <li><a href="{{ url('/') }}" class="footer-link">Home</a></li>
                        <li><a href="{{ url('/produk') }}" class="footer-link">Produk</a></li>
                        <li><a href="{{ url('/profile') }}" class="footer-link">Profile</a></li>
                        <li><a href="{{ url('/contact') }}" class="footer-link">Kontak</a></li>
                    </ul>
                </div>

                <!-- Marketplace -->
                <div class="col-md-2 d-flex flex-column justify-content-start">
                    <p class="fw-semibold mb-2">Marketplace</p>
                    <ul class="list-unstyled small mb-0">
                        <li><a href="https://www.tiktok.com/@simboolcustom.ind" class="footer-link">Tiktok</a></li>
                        <li><a href="https://shopee.co.id/simboolcustom.ind" class="footer-link">Shopee</a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div class="col-md-2">
                    <p class="fw-semibold mb-2">Kontak</p>
                    <ul class="list-unstyled small mb-0">
                        <li class="footer-item">+62 857-3509-3369</li>
                        <li class="footer-item">info@simboolcustom.ind</li>
                    </ul>
                </div>

                <!-- Alamat -->
                <div class="col-md-3">
                    <p class="fw-semibold mb-2">Alamat</p>
                    <ul class="list-unstyled small mb-0">
                        <li class="footer-item">
                            <span>
                                Gang Cinta, Nglandung Tiga, Nglandung,<br>
                                Kec. Geger, Kabupaten Madiun,<br>
                                Jawa Timur 63171
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
    background: radial-gradient(circle at top left, #1a1a1a, #0e0e0e 80%);
    position: relative;
    font-family: 'Poppins', sans-serif;
    overflow: hidden;
}

/* Animasi garis atas */
.footer-top-gradient {
    height: 5px;
    width: 100%;
    background: linear-gradient(90deg, #d000ff, #6a00ff, #00d4ff, #d000ff);
    background-size: 300% 300%;
    animation: gradientFlow 6s ease infinite;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

@keyframes gradientFlow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Animasi lembut muncul */
.footer-content {
    background-color: transparent;
    animation: fadeIn 1s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ===== LOGO & TEXT SECTION ===== */
.footer-logo {
    width: 85px;
    height: auto;
    filter: drop-shadow(0 0 8px rgba(208, 0, 255, 0.3));
    transition: transform 0.3s ease;
}
.footer-logo:hover {
    transform: scale(1.05);
}

.footer-logo-text h5 {
    font-size: 1.4rem;
    background: linear-gradient(90deg, #d000ff, #6a00ff, #00d4ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 0 6px rgba(208, 0, 255, 0.2);
    letter-spacing: 1px;
}

/* ===== LINK STYLING ===== */
.footer-link {
    color: #eaeaea;
    text-decoration: none;
    position: relative;
    transition: all 0.3s ease;
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
.footer-link:hover {
    color: #00d4ff;
    text-shadow: 0 0 6px #00d4ff;
}
.footer-link:hover::after {
    width: 100%;
}

/* ===== ICON & TEXT COLOR ===== */
.footer-section p,
.footer-section span,
.footer-item {
    color: #ccc;
    transition: color 0.3s ease;
}
.footer-section .fw-semibold {
    color: #fff;
}

/* ===== FOOTER BOTTOM ===== */
.footer-bottom {
    font-size: 0.9rem;
    background: #0d0d0d;
    color: #bbb;
    border-top: 1px solid rgba(255,255,255,0.1);
    letter-spacing: 0.4px;
    backdrop-filter: blur(6px);
}

/* ===== EFEK HALUS ===== */
.footer-section::before {
    content: "";
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(208,0,255,0.08), transparent 60%);
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

    .footer-logo-text {
        margin-left: 0;
        margin-top: 10px;
    }

    .footer-section .col-md-3,
    .footer-section .col-md-2 {
        text-align: left;
    }
}
</style>
