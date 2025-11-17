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

    <!-- Custom Style -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .brand-link {
            font-size: 1.2rem;
            font-weight: 600;
        }

        /* Efek sidebar aktif & hover */
        .nav-sidebar .nav-link.active {
            background-color: #007bff;
            color: #fff !important;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-sidebar .nav-link:hover {
            background-color: #0056b3;
            color: #fff !important;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        /* Content transparan */
        .content-wrapper {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            margin: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Animasi masuk */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark bg-dark shadow-sm">
        <ul class="navbar-nav">
            <li class="nav-item">
                <!-- Toggle Sidebar -->
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars text-white"></i>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <span class="nav-link text-white fw-bold">@yield('title')</span>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto align-items-center">
            <li class="nav-item">
                <span class="nav-link text-white">👋 {{ Auth::user()->name }}</span>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="nav-link text-danger">
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
    <div class="content-wrapper p-4">
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
</body>
</html>
