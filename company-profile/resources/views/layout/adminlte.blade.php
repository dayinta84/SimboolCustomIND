<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Style -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* Warna latar belakang halaman yang lebih netral */
            background-color: #f8fafc; 
        }

        /* Brand Link */
        .brand-link {
            font-size: 1.2rem;
            font-weight: 600;
            color: #fff !important;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3); /* Bayangan teks */
        }

        /* Navbar */
        .main-header {
            /* Gradien warna navbar */
            background: linear-gradient(135deg, #31459fff 0%, #461e6eff 100%) !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.9) !important; /* Warna teks navbar */
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #ffffff !important; /* Warna teks saat hover */
        }

        /* Sidebar */
        .main-sidebar {
            /* Gradien warna sidebar */
            background: linear-gradient(180deg, #2c3e50 0%, #1a252f 100%) !important;
            border-right: 1px solid rgba(255,255,255, 0.1);
        }

        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active {
            /* Warna item aktif sidebar */
            background-color: rgba(102, 126, 234, 0.2) !important; 
            color: #ffffff !important;
            border-left: 4px solid #667eea; /* Garis aksen */
            border-radius: 0 8px 8px 0; /* Radius hanya di kanan */
            transition: all 0.3s ease;
        }

        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link:hover {
            /* Warna item saat hover */
            background-color: rgba(102, 126, 234, 0.1) !important;
            color: #ffffff !important;
            border-left: 4px solid rgba(102, 126, 234, 0.5);
            border-radius: 0 8px 8px 0;
            transition: all 0.3s ease;
        }

        .nav-sidebar .nav-icon {
            margin-right: 10px; /* Jarak antar ikon dan teks */
        }

        /* Content Wrapper */
        .content-wrapper {
            /* Warna latar belakang konten (ini adalah bagian tengah yang TIDAK diubah gayanya) */
            background: #f8fafc; 
            min-height: calc(100vh - 120px); /* Tinggi minimal minus tinggi navbar dan footer */
            padding: 20px;
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Footer */
        .main-footer {
            /* Gradien warna footer */
            background: linear-gradient(135deg, #31459fff 0%, #461e6eff 100%) !important;
            color: #ecf0f1 !important;
            border-top: none; /* Hilangkan border default */
            padding: 15px 0;
        }

        .main-footer a {
            color: #ffffff !important;
            text-decoration: underline;
            transition: color 0.3s ease;
        }

        .main-footer a:hover {
            color: #b3d9ff !important; /* Warna link saat hover */
        }

        /* Animasi saat logout (opsional) */
        .logout-fade {
            opacity: 0.7;
            pointer-events: none;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <!-- Toggle Sidebar -->
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <span class="nav-link fw-bold">@yield('title')</span>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto align-items-center">
            <li class="nav-item">
                <span class="nav-link">👋 {{ Auth::user()->name }}</span>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); 
                            document.querySelector('.wrapper').classList.add('logout-fade');
                            document.getElementById('logout-form').submit();"
                   class="nav-link text-light">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a class="brand-link text-center">
            <span class="brand-text font-weight-light">Simbool Custom</span>
        </a>

        <div class="sidebar">
            <nav class="mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column" role="menu">

                    <!-- Menu Umum (Semua User) -->
                    <li class="nav-item">
                        <a href="{{ url(Auth::user()->role . '/dashboard') }}" 
                           class="nav-link {{ request()->is(Auth::user()->role . '/dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url(Auth::user()->role . '/home_content/edit') }}" 
                           class="nav-link {{ request()->is(Auth::user()->role . '/beranda*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Kelola Beranda</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url(Auth::user()->role . '/products') }}" 
                           class="nav-link {{ request()->is(Auth::user()->role . '/products*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-box"></i>
                            <p>Kelola Produk</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url(Auth::user()->role . '/marketplace/edit') }}" 
                           class="nav-link {{ request()->is(Auth::user()->role . '/marketplace*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-store"></i>
                            <p>Kelola Marketplace</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url(Auth::user()->role . '/contact/edit') }}" 
                           class="nav-link {{ request()->is(Auth::user()->role . '/contact*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>Kelola Kontak</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url(Auth::user()->role . '/profil/edit') }}" 
                           class="nav-link {{ request()->is(Auth::user()->role . '/profil*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Kelola Profil</p>
                        </a>
                    </li>

                    <!-- Menu Khusus Superadmin -->
                    @if(Auth::user()->role == 'superadmin')
                        <li class="nav-item">
                            <a href="{{ url('/superadmin/users') }}" 
                               class="nav-link {{ request()->is('superadmin/users*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Kelola User</p>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="main-footer text-center">
        <strong>&copy; {{ date('Y') }} Simbool Custom</strong> All rights reserved.
    </footer>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
</div>

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


@yield('scripts')

</body>
</html>