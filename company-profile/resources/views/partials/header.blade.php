<header class="floating-navbar">
  <div class="nav-inner">

    <div class="nav-logo">
      <img src="{{ asset('images/logo_simbool.png') }}" class="logo">
    </div>

    <button class="nav-toggle" id="navToggle">
        <span></span><span></span><span></span>
    </button>

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
    z-index: 9999;
    width: 100%;
    padding: 0; /* HAPUS padding biar nempel full */
    background: transparent;
    display: flex;
    flex-direction: column;
}

/* NAV DALAMNYA FULL WIDTH */
.nav-inner {
    width: 100%; /* ← FULL */
    padding: 14px 34px;

    display: flex;
    justify-content: space-between;
    align-items: center;

    background: rgba(30, 0, 40, 0.55); /* kamu bisa sesuaikan */
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);

    border-radius: 0; 
    border-bottom: 1px solid rgba(255,255,255,0.08);
    box-shadow: 0 4px 14px rgba(0,0,0,0.3);
}

.logo {
    height: 40px;
}

/* GLOW BAR FULL WIDTH */
.under-glow {
    width: 100%; /* ← FULL */
    height: 3px;
    background: linear-gradient(90deg,#d000ff,#00d4ff,#7000ff);
    animation: glowRun 6s infinite;
}

@keyframes glowRun {
    0% { background-position: 0% }
    50% { background-position: 100% }
    100% { background-position: 0% }
}

/* ================= DESKTOP MENU ================= */

.nav-menu {
    display: flex;
    gap: 32px;
}

.nav-menu a {
    color: #ddd;
    text-decoration: none;
    font-size: 15px;
    font-weight: 500;
    position: relative;
    padding: 3px 0;
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
    width: 100%;                 /* ← FULL */
    height: 3px;
    background: linear-gradient(90deg,#d000ff,#00d4ff,#7000ff);
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
    border-radius: 4px;
    transition: .25s;
}

@media(max-width: 820px) {

    .nav-toggle { display: flex; }

    .nav-menu {
        position: absolute;
        top: 78px;
        left: 50%;
        transform: translateX(-50%) translateY(-10px);
        width: 90%;
        max-width: 420px;
        padding: 20px 26px;

        flex-direction: column;
        gap: 20px;

        background: rgba(15,15,15,0.9);
        backdrop-filter: blur(14px);

        border-radius: 0; /* ← MOBILE DROPDOWN JUGA KOTAK */
        border: 1px solid rgba(255,255,255,0.12);

        opacity: 0;
        pointer-events: none;
        transition: 0.25s ease;
        box-shadow: 0 8px 26px rgba(0,0,0,0.5);
    }

    .nav-menu.show {
        opacity: 1;
        pointer-events: auto;
        transform: translateX(-50%) translateY(0);
    }

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
