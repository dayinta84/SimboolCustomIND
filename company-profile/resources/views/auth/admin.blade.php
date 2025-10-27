@extends('layout.adminlte')

@section('title', 'Dashboard Admin')

@section('content')
    <h3>Selamat Datang, {{ Auth::user()->name }} 👋</h3>
    <p>Anda login sebagai <b>Admin</b>. Gunakan menu di sidebar untuk mengelola website.</p>

    <div class="card mt-3 shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold">Informasi Cepat</h5>
            <p>Gunakan panel di sebelah kiri untuk memperbarui data perusahaan, kontak, dan produk.</p>
        </div>
    </div>
@endsection
