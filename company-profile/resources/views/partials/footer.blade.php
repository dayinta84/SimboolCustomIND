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
                        <li><a href="{{ url('/kontak') }}" class="footer-link">Kontak</a></li>
                    </ul>
                </div>

                <!-- Marketplace -->
                <div class="col-md-2 d-flex flex-column justify-content-start">
                    <p class="fw-semibold mb-2">Marketplace</p>
                    <ul class="list-unstyled small mb-0">
                        <li><a href="#" class="footer-link">Tiktok</a></li>
                        <li><a href="#" class="footer-link">Shopee</a></li>
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
    background-color: #1a1a1a;
    position: relative;
    font-family: 'Poppins', sans-serif;
}

.footer-top-gradient {
    height: 6px;
    width: 100%;
    background: linear-gradient(90deg, #d000ff, #6a00ff, #00d4ff);
}

.footer-content {
    background-color: #1a1a1a;
}

/* ===== LOGO & TEXT SECTION ===== */
.footer-logo-wrap {
    display: flex;
    align-items: center;
}

.footer-logo {
    width: 80px;
    height: auto;
}

.footer-logo-text {
    display: flex;
    flex-direction: column;
    justify-content: center;
    line-height: 1.1;
}

.footer-logo-text h5 {
    font-size: 1.4rem;
    letter-spacing: 1px;
    margin-bottom: 0;
}

/* ===== TEXT GRADIENT ===== */
.text-gradient {
    background: linear-gradient(90deg, #d000ff, #6a00ff);
    background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ===== LINK STYLING ===== */
.footer-link {
    color: #ffffff;
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer-link:hover {
    color: #d000ff;
    text-decoration: underline;
}

/* ===== ICON & TEXT COLOR ===== */
.footer-section p,
.footer-section span,
.footer-item {
    color: #e6e6e6;
}

.footer-section .fw-semibold {
    color: #ffffff;
}

/* ===== FOOTER BOTTOM ===== */
.footer-bottom {
    font-size: 0.9rem;
    letter-spacing: 0.3px;
    background-color: #f8f9fa;
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