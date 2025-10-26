@extends('layout.adminlte')

@section('title', 'Edit Halaman Kontak')

@section('sidebar')
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.contact.editpage', ['role' => Auth::user()->role]) }}" class="nav-link active">
                    <i class="nav-icon fas fa-address-book"></i>
                    <p>Kelola Kontak</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('profil.edit', ['role' => Auth::user()->role]) }}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Profil</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('product.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-box"></i>
                    <p>Produk</p>
                </a>
            </li>
        </ul>
    </nav>
@endsection

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Halaman Kontak</h3>
        </div>

        <form action="{{ route('admin.contact.updatepage', ['role' => Auth::user()->role]) }}" 
              method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" 
                           value="{{ old('alamat', $contact->alamat) }}" required>
                </div>

                <div class="form-group">
                    <label>Gambar (opsional)</label>
                    <input type="file" name="gambar" class="form-control-file">
                    @if($contact->gambar)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $contact->gambar) }}" 
                                 alt="Gambar Kontak" width="120" class="img-thumbnail">
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Nomor WhatsApp</label>
                    @php
                        $whatsapps = old('whatsapp', $contact->whatsapp ?? []);
                    @endphp

                    @foreach($whatsapps as $index => $wa)
                        <div class="input-group mb-2">
                            <input type="text" name="whatsapp[]" class="form-control" value="{{ $wa }}">
                        </div>
                    @endforeach

                    <div class="input-group mb-2">
                        <input type="text" name="whatsapp[]" class="form-control" placeholder="Tambah nomor baru">
                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
