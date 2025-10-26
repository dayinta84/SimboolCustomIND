@extends('layout.adminlte')

@section('title', 'Dashboard Superadmin')

@section('sidebar')
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
        <li class="nav-item">
            <a href="{{ url('superadmin/dashboard') }}" class="nav-link active">
                <i class="nav-icon fas fa-home"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('superadmin/profil/edit') }}" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>Kelola Profil</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('superadmin/contact/edit') }}" class="nav-link">
                <i class="nav-icon fas fa-envelope"></i>
                <p>Kelola Kontak</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('superadmin/product/edit') }}" class="nav-link">
                <i class="nav-icon fas fa-box"></i>
                <p>Kelola Produk</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('superadmin/users') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Kelola User</p>
            </a>
        </li>
    </ul>
</nav>
@endsection

@section('content')
    <h3>Selamat Datang, {{ Auth::user()->name }} 👋</h3>
    <p>Anda login sebagai <b>Superadmin</b>. Anda memiliki akses penuh terhadap semua data dan pengguna.</p>

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
                    <a href="{{ url('/' . Auth::user()->role . '/marketplace/edit') }}" class="list-group-item list-group-item-action">🛍 Kelola Marketplace</a>
                    <a href="{{ url('/' . Auth::user()->role . '/contact/edit') }}" class="list-group-item list-group-item-action">📞 Kelola Kontak</a>
                    <a href="{{ url('/superadmin/profil/edit') }}" class="list-group-item list-group-item-action">👤 Kelola Profil</a>
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

                <div class="card mt-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold">Kontrol Penuh</h5>
                        <p>Kelola data website, produk, profil, kontak, dan juga manajemen pengguna di menu sidebar.</p>
                    </div>
                </div>
            </div> <!-- end col utama -->
        </div> <!-- end row -->
    </div> <!-- end container -->
@endsection