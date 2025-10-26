<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <!-- AdminLTE & Bootstrap -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/bootstrap/css/bootstrap.min.css') }}">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }
        .brand-link {
            background-color: #343a40 !important;
            font-weight: 600;
        }
        .nav-sidebar .nav-link.active {
            background-color: #007bff !important;
            color: white !important;
        }
        .content-wrapper {
            background: #fff;
            border-radius: 10px;
            margin-top: 15px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .main-footer {
            background: #f8f9fa;
            border-top: 1px solid #dee2e6;
            padding: 15px;
            font-size: 14px;
            color: #6c757d;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">
        <!-- Left -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <span class="nav-link">@yield('title')</span>
            </li>
        </ul>

        <!-- Right -->
        <ul class="navbar-nav ml-auto align-items-center">
            <li class="nav-item">
                <span class="nav-link">👋 {{ Auth::user()->name }}</span>
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
        <div class="brand-link text-center">
            <span class="brand-text font-weight-light">Company Profile</span>
        </div>


        <div class="sidebar">
            @yield('sidebar')
        </div>
    </aside>

    <!-- Content -->
    <div class="content-wrapper p-3">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="main-footer text-center">
        <strong>&copy; {{ date('Y') }} Company Profile.</strong> All rights reserved.
    </footer>

    <form id="logout-form" action="{{ route('logout') }}" method
