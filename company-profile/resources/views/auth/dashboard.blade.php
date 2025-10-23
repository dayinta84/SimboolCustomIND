<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Superadmin</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background: linear-gradient(90deg, #6610f2, #9b00ff);
        }
        .sidebar {
            min-height: 100vh;
            background-color: #ffffff;
            border-right: 1px solid #dee2e6;
        }
        .sidebar .list-group-item.active {
            background-color: #6610f2;
            border-color: #6610f2;
            color: white;
        }
        .sidebar .list-group-item:hover {
            background-color: #e9ecef;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">Dashboard Superadmin</a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3">
                    👤 {{ Auth::user()->name }} (Superadmin)
                </span>
                <a class="btn btn-outline-light btn-sm"
                   href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Logout form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- Konten -->
    <div class="container-fluid mt-3">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar p-0">
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action active">🏠 Dashboard</a>
                    <a href="{{ url('superadmin/home-content/edit') }}" class="list-group-item list-group-item-action">🖋 Kelola Halaman Home</a>
                    <a href="#" class="list-group-item list-group-item-action">📦 Kelola Produk</a>
                    <a href="#" class="list-group-item list-group-item-action">🛍 Kelola Marketplace</a>
                    <a href="{{ url('/' . Auth::user()->role . '/contact/edit') }}" class="list-group-item list-group-item-action">📞 Kelola Kontak</a>
                    <a href="{{ url('/superadmin/profil/edit') }}" class="list-group-item list-group-item-action">👤 Kelola Profil</a>
                    <!-- 👇 tambahan khusus superadmin -->
                    <a href="{{ route('superadmin.users.index') }}" class="list-group-item list-group-item-action text-danger fw-bold">
                        ⚙️ Kelola User
                    </a>
                </div>
            </div>

            <!-- Konten utama -->
            <div class="col-md-9 col-lg-10">
                <div class="card shadow-sm mt-3">
                    <div class="card-header bg-white fw-bold">
                        Selamat Datang, {{ Auth::user()->name }} 👋
                    </div>
                    <div class="card-body">
                        <p>Anda login sebagai <strong>Superadmin</strong>.</p>
                        <p>Gunakan menu di sebelah kiri untuk mengelola seluruh konten website termasuk manajemen pengguna.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
