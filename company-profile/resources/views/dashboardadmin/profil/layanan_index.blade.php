@extends('layout.adminlte')
@section('title', 'Kelola Layanan Kami')
@section('sidebar')
<ul class="nav nav-pills nav-sidebar flex-column">
    <li class="nav-item">
        <a href="{{ route('profil.edit', ['role' => Auth::user()->role]) }}" class="nav-link">
            <i class="fas fa-user"></i> <p>Profil Perusahaan</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('layanan.index', ['role' => Auth::user()->role]) }}" class="nav-link active">
            <i class="fas fa-concierge-bell"></i> <p>Layanan Kami</p>
        </a>
    </li>
</ul>
@endsection

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Kelola Layanan Kami</h3>

    {{-- Tambah Layanan --}}
    <div class="card mb-3">
        <div class="card-header">
            <h6 class="mb-0">Tambah Layanan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('layanan.store', ['role' => Auth::user()->role]) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="judul_layanan" class="form-control" placeholder="Judul Layanan" required>
                    </div>
                    <div class="col-md-7">
                        <textarea name="deskripsi" class="form-control" placeholder="Deskripsi Layanan" required></textarea>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Daftar Layanan --}}
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead><tr><th>No</th><th>Judul</th><th>Deskripsi</th><th>Aksi</th></tr></thead>
                <tbody>
                @foreach($layanans as $i => $l)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $l->judul_layanan }}</td>
                        <td>{{ $l->deskripsi }}</td>
                        <td>
                            {{-- Edit Modal --}}
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{ $l->id }}">Edit</button>
                            <div class="modal fade" id="edit{{ $l->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('layanan.update', ['role' => Auth::user()->role, 'id' => $l->id]) }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Layanan</h5>
                                            </div>
                                            <div class="modal-body">
                                                <input type="text" name="judul_layanan" value="{{ $l->judul_layanan }}" class="form-control mb-2">
                                                <textarea name="deskripsi" class="form-control">{{ $l->deskripsi }}</textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- Hapus --}}
                            <form action="{{ route('layanan.destroy', ['role'=>Auth::user()->role,'id'=>$l->id]) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
