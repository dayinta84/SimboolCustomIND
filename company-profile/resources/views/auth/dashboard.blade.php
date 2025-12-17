@extends('layout.adminlte')

@section('title', 'Dashboard Superadmin')

@section('content')
<div class="container-fluid">

    <!-- Judul Tengah -->
    <div class="dashboard-title text-center mb-5">
        <h1 class="welcome-text fw-bold">Selamat Datang, {{ Auth::user()->name }} 👋</h1>
        <p class="subtitle-text">Anda login sebagai <b>Superadmin</b>. Kelola seluruh konten website dengan mudah.</p>
    </div>

    <!-- GRID MENU UTAMA -->
    <div class="row g-5">

        <!-- Card: Kelola Beranda -->
        <div class="col-md-4">
            <a href="{{ url('superadmin/home_content/edit') }}" class="text-decoration-none">
                <div class="card dashboard-card text-center p-4 shadow-lg border-0 h-100 pastel-blue">
                    <i class="fas fa-edit fa-3x mb-3 icon-white"></i>
                    <h5 class="fw-bold text-dark">Kelola Beranda</h5>
                    <p class="text-white">Edit slider, judul, dan tampilan utama website.</p>
                </div>
            </a>
        </div>

        <!-- Card: Kelola Produk -->
        <div class="col-md-4">
            <a href="{{ url('superadmin/products') }}" class="text-decoration-none">
                <div class="card dashboard-card text-center p-4 shadow-lg border-0 h-100 pastel-green">
                    <i class="fas fa-box-open fa-3x mb-3 icon-white"></i>
                    <h5 class="fw-bold text-dark">Kelola Produk</h5>
                    <p class="text-white">Tambah dan kelola produk website.</p>
                </div>
            </a>
        </div>

        <!-- Card: Kelola Marketplace -->
        <div class="col-md-4">
            <a href="{{ url('superadmin/marketplace/edit') }}" class="text-decoration-none">
                <div class="card dashboard-card text-center p-4 shadow-lg border-0 h-100 pastel-yellow">
                    <i class="fas fa-store fa-3x mb-3 icon-white"></i>
                    <h5 class="fw-bold text-dark">Kelola Marketplace</h5>
                    <p class="text-white">Atur marketplace & link pembelian.</p>
                </div>
            </a>
        </div>

        <!-- Card: Kelola Kontak -->
        <div class="col-md-4">
            <a href="{{ url('superadmin/contact/edit') }}" class="text-decoration-none">
                <div class="card dashboard-card text-center p-4 shadow-lg border-0 h-100 pastel-purple">
                    <i class="fas fa-envelope fa-3x mb-3 icon-white"></i>
                    <h5 class="fw-bold text-dark">Kelola Kontak</h5>
                    <p class="text-white">Ubah alamat dan nomor WhatsApp admin.</p>
                </div>
            </a>
        </div>

        <!-- Card: Kelola Profil -->
        <div class="col-md-4">
            <a href="{{ url('superadmin/profil/edit') }}" class="text-decoration-none">
                <div class="card dashboard-card text-center p-4 shadow-lg border-0 h-100 pastel-pink">
                    <i class="fas fa-user-cog fa-3x mb-3 icon-white"></i>
                    <h5 class="fw-bold text-dark">Kelola Profil Perusahaan</h5>
                    <p class="text-white">Edit visi, misi & informasi perusahaan.</p>
                </div>
            </a>
        </div>

        <!-- Card: Manajemen User -->
        <div class="col-md-4">
            <a href="{{ url('/superadmin/users') }}" class="text-decoration-none">
                <div class="card dashboard-card text-center p-4 shadow-lg border-0 h-100 pastel-orange">
                    <i class="fas fa-users fa-3x mb-3 icon-white"></i>
                    <h5 class="fw-bold text-dark">Manajemen User</h5>
                    <p class="text-white">Kelola semua pengguna sistem.</p>
                </div>
            </a>
        </div>

    </div>
</div>

<!-- STYLE -->
<style>
    /* JUDUL UTAMA */
    .welcome-text {
        font-size: 2.7rem;
        color: #000000; /* HITAM */
        text-shadow: 0 4px 18px rgba(128, 0, 128, 0.55); /* BAYANGAN UNGU */
        font-weight: 800;
    }

    .subtitle-text {
        font-size: 1.2rem;
        color: #000000ff;
        margin-top: 5px;
    }

    /* KARTU DASHBOARD */
    .dashboard-card {
        border-radius: 22px;
        transition: .3s ease-in-out;
    }
    .dashboard-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
    }

    /* IKON PUTIH */
    .icon-white {
        color: white !important;
        text-shadow: 0 3px 12px rgba(0,0,0,.4);
    }

    /* WARNA PASTEL */
   /* WARNA MACARON MANIS YANG INDAH DAN ELEGAN */
    .pastel-blue    { background: #0b3b5fcc !important; } /* Biru Laut Pucat */
    .pastel-green   { background: #068e4acc !important; } /* Sage Hijau Lembut */
    .pastel-yellow  { background: #9f7700cc !important; } /* Beige Pucat (Vanilla) */
    .pastel-pink    { background: #810013cc !important; } /* Mawar Pudar (Dusty Rose) */
    .pastel-purple  { background: #510585cc !important; } /* Mauve Lembut */
    .pastel-orange  { background: #ab3511cc !important; } /* Coral Pucat */
    /* JARAK ANTAR KOTAK */
    .row.g-5 > .col-md-4 {
        margin-top: 8px;
        margin-bottom: 8px;
    }
</style>

@endsection
