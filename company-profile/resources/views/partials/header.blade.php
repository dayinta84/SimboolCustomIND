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
          <li><a href="#">Beranda</a></li>
          <li><a href="#">Produk</a></li>
          <li><a href="#">Marketplace</a></li>
          <li><a href="#">Kontak</a></li>
          <li><a href="#">Profile</a></li>
        </ul>
      </nav>
    </div>
  </div>
</header>

<style>
.header {
  background: #111;
  color: white;
  width: 100%;
  position: sticky;
  top: 0;
  z-index: 999;
  border-bottom: 3px solid transparent;
  background-image: linear-gradient(#111, #111),
                    linear-gradient(90deg, #d000ff, #00d4ff);
  background-origin: border-box;
  background-clip: padding-box, border-box;
}


.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 12px 20px;
}

.header-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.header-logo .logo {
  max-height: 55px;
  transition: transform 0.3s ease;
}

.header-logo .logo:hover {
  transform: scale(1.05);
}

/* MENU */
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
  transition: color 0.3s ease, border-color 0.3s ease;
  border-bottom: 2px solid transparent;
  padding-bottom: 4px;
}

.nav-menu ul li a:hover {
  color: #fff;
  border-color: #c400ff;
}

.nav-menu ul li a.active {
  color: #fff;
  border-color: #c400ff;
}

/* TOGGLE MENU */
.menu-toggle {
  display: none;
  font-size: 28px;
  cursor: pointer;
  color: white;
}

/* RESPONSIVE */
@media (max-width: 768px) {
  .nav-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background: #111;
    width: 100%;
    border-top: 1px solid #333;
    animation: fadeIn 0.3s ease;
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

  @keyframes fadeIn {
    from {opacity: 0; transform: translateY(-10px);}
    to {opacity: 1; transform: translateY(0);}
  }
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