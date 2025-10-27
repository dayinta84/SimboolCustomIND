@extends('layout.adminlte')

@section('title', 'Dashboard Superadmin')

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