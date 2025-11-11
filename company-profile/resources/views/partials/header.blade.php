<header class="header">
  <div class="container">
    <div class="header-content">
      <!-- Logo -->
      <div class="header-logo">
        <img src="{{ asset('images/logo_simbool.png') }}" alt="Logo" class="logo">
      </div>

      <!-- Tombol menu mobile -->
      <div class="menu-toggle" id="menuToggle">&#9776;</div>

      <!-- Menu -->
      <nav class="nav-menu" id="navMenu">
        <ul>
          <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
          <li><a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">Produk</a></li>
          <li><a href="{{ route('marketplace.index') }}" class="{{ request()->routeIs('marketplace.*') ? 'active' : '' }}">Marketplace</a></li>
          <li><a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.*') ? 'active' : '' }}">Kontak</a></li>
          <li><a href="{{ route('profile.index') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">Profil</a></li>
        </ul>
      </nav>
    </div>
  </div>

  <!-- Garis animasi di bawah header -->
  <div class="header-bottom-gradient"></div>
</header>

<style>
/* ===== HEADER BASE ===== */
.header {
  position: sticky;
  top: 0;
  width: 100%;
  z-index: 999;
  background: radial-gradient(circle at top left, #0e0e0e, #111);
  color: #fff;
  overflow: hidden;
  box-shadow: 0 3px 8px rgba(0,0,0,0.3);
  animation: fadeInHeader 1s ease-in-out;
}

/* Garis gradient bergerak di BAWAH header */
.header-bottom-gradient {
  height: 4px;
  width: 100%;
  background: linear-gradient(90deg, #d000ff, #6a00ff, #00d4ff, #d000ff);
  background-size: 300% 300%;
  animation: gradientFlow 6s ease infinite;
}

/* Container */
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 14px 20px;
}

/* Header content */
.header-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

/* Logo */
.header-logo .logo {
  max-height: 55px;
  transition: transform 0.3s ease, filter 0.3s ease;
  filter: drop-shadow(0 0 8px rgba(208, 0, 255, 0.3));
}

.header-logo .logo:hover {
  transform: scale(1.05);
  filter: drop-shadow(0 0 12px rgba(208, 0, 255, 0.5));
}

/* ===== MENU ===== */
.nav-menu ul {
  list-style: none;
  display: flex;
  justify-content: center;
  gap: 50px;
  margin: 0;
  padding: 0;
}

.nav-menu ul li a {
  color: #ddd;
  text-decoration: none;
  font-weight: 600;
  letter-spacing: 0.4px;
  border-bottom: 2px solid transparent;
  padding-bottom: 4px;
  transition: all 0.3s ease;
  position: relative;
}

/* Efek animasi underline seperti footer link */
.nav-menu ul li a::after {
  content: '';
  position: absolute;
  width: 0%;
  height: 2px;
  bottom: -3px;
  left: 0;
  background: linear-gradient(90deg, #d000ff, #00d4ff);
  transition: width 0.3s ease;
}

.nav-menu ul li a:hover {
  color: #00d4ff;
  text-shadow: 0 0 6px #00d4ff;
}

.nav-menu ul li a:hover::after {
  width: 100%;
}

.nav-menu ul li a.active {
  color: #fff;
  text-shadow: 0 0 6px #d000ff;
  border-color: transparent;
}

.nav-menu ul li a.active::after {
  width: 100%;
}

/* ===== TOGGLE MENU ===== */
.menu-toggle {
  display: none;
  font-size: 28px;
  cursor: pointer;
  color: white;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
  .nav-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background: #0e0e0e;
    width: 100%;
    border-top: 1px solid #333;
    animation: fadeInNav 0.3s ease;
  }

  .nav-menu.active {
    display: block;
  }

  .nav-menu ul {
    flex-direction: column;
    align-items: center;
    gap: 20px;
    padding: 20px 0;
  }

  .menu-toggle {
    display: block;
  }

  @keyframes fadeInNav {
    from {opacity: 0; transform: translateY(-10px);}
    to {opacity: 1; transform: translateY(0);}
  }
}

/* ===== ANIMATIONS ===== */
@keyframes gradientFlow {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

@keyframes fadeInHeader {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const toggle = document.getElementById('menuToggle');
  const nav = document.getElementById('navMenu');

  toggle.addEventListener('click', function () {
    nav.classList.toggle('active');
  });
});
</script>
