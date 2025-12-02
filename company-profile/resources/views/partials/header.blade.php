<header class="floating-navbar">
  <div class="nav-inner">

    <!-- Logo -->
    <div class="nav-logo">
      <img src="{{ asset('images/logo_simbool.png') }}" class="logo">
    </div>

    <!-- Toggle Button -->
    <button class="nav-toggle" id="navToggle">
        <span></span><span></span><span></span>
    </button>

    <!-- Menu -->
    <nav class="nav-menu" id="navMenu">
      <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
      <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">Produk</a>
      <a href="{{ route('marketplace.index') }}" class="{{ request()->routeIs('marketplace.*') ? 'active' : '' }}">Marketplace</a>
      <a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.*') ? 'active' : '' }}">Kontak</a>
      <a href="{{ route('profile.index') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">Profil</a>
    </nav>

  </div>

  <div class="under-glow"></div>
</header>

<style>

/* ================= FLOATING NAVBAR ================= */

.floating-navbar {
    position: sticky;
    top: 0;
    padding: 14px 0;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    align-items: center;
    background: transparent;
}

.nav-inner {
    width: min(92%, 1250px);
    padding: 12px 28px;
    background: rgba(20, 20, 20, 0.65);
    backdrop-filter: blur(14px);
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.1);

    display: flex;
    justify-content: space-between;
    align-items: center;

    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

.logo {
    height: 40px;
}

/* ================= DESKTOP MENU ================= */

.nav-menu {
    display: flex;
    gap: 34px;
}

.nav-menu a {
    color: #ddd;
    text-decoration: none;
    font-size: 15px;
    font-weight: 500;
    position: relative;
    padding: 4px 0;
    transition: 0.2s ease;
}

.nav-menu a::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -4px;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #d000ff, #00d4ff);
    transition: width .22s ease;
}

.nav-menu a:hover,
.nav-menu a.active {
    color: #fff;
}

.nav-menu a:hover::after,
.nav-menu a.active::after {
    width: 100%;
}

/* ================= NEON GLOW ================= */

.under-glow {
    width: min(92%, 1250px);
    height: 3px;
    background: linear-gradient(90deg,#d000ff,#00d4ff,#7000ff);
    border-radius: 999px;
    animation: glowRun 6s infinite;
}

@keyframes glowRun {
    0% { background-position: 0% }
    50% { background-position: 100% }
    100% { background-position: 0% }
}

/* ================= MOBILE ================= */

.nav-toggle {
    display: none;
    flex-direction: column;
    gap: 5px;
    background: none;
    border: none;
    cursor: pointer;
}

.nav-toggle span {
    width: 26px;
    height: 3px;
    background: white;
    border-radius: 8px;
    transition: .25s;
}

@media(max-width: 820px) {

    .nav-toggle { display: flex; }

    /* === MOBILE DROPDOWN (DI-TENGAH) === */
    .nav-menu {
        position: absolute;
        top: 78px;
        left: 50%;                     /* supaya center */
        transform: translateX(-50%) translateY(-10px);
        width: 90%;                    /* responsif */
        max-width: 420px;              /* biar tidak terlalu lebar */
        padding: 20px 26px;

        flex-direction: column;
        gap: 20px;
        background: rgba(15,15,15,0.9);
        backdrop-filter: blur(14px);

        border-radius: 16px;
        border: 1px solid rgba(255,255,255,0.12);

        opacity: 0;
        pointer-events: none;
        transition: 0.25s ease;
        box-shadow: 0 8px 26px rgba(0,0,0,0.5);
    }

    .nav-menu a {
        text-align: center;
        width: 100%;   
    }

    .nav-menu.show {
        opacity: 1;
        pointer-events: auto;
        transform: translateX(-50%) translateY(0);
    }

    /* Hamburger → X */
    .nav-toggle.active span:nth-child(1) {
        transform: rotate(45deg) translateY(8px);
    }
    .nav-toggle.active span:nth-child(2) {
        opacity: 0;
    }
    .nav-toggle.active span:nth-child(3) {
        transform: rotate(-45deg) translateY(-8px);
    }
}

</style>

<script>
document.getElementById("navToggle").addEventListener("click", () => {
    document.getElementById("navToggle").classList.toggle("active");
    document.getElementById("navMenu").classList.toggle("show");
});
</script>
