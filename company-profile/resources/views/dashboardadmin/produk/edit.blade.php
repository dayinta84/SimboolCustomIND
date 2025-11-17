@extends('layout.adminlte')
@section('title', 'Kelola Produk')

@section('content')
<div class="container-fluid">

    <h3 class="mb-4">{{ isset($product) ? 'Edit Produk' : 'Tambah Produk Baru' }}</h3>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- ============================ FORM TAMBAH / EDIT ============================ --}}
    <div class="card">
        <div class="card-body">

            <form action="{{ isset($product) 
                ? route('admin.products.update', $product->id) 
                : route('admin.products.store') }}" 
                method="POST" enctype="multipart/form-data">

                @csrf
                @if(isset($product))
                    @method('PUT')
                @endif

                <div class="row">

                    {{-- GAMBAR --}}
                    <div class="col-md-4 text-center">

                        @if(isset($product) && $product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" 
                                 class="img-fluid rounded shadow mb-3"
                                 style="max-height:200px;">
                        @else
                            <div class="border p-4 rounded bg-light text-muted">
                                Belum ada gambar
                            </div>
                        @endif

                        <input type="file" name="image" class="form-control mt-2">
                    </div>

                    {{-- FORM --}}
                    <div class="col-md-8">

                        <div class="mb-3">
                            <label>Nama Produk</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name', $product->name ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Kategori</label>
                            <select class="form-control" name="category">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Banner" {{ old('category', $product->category ?? '')=='Banner'?'selected':'' }}>Banner</option>
                                <option value="Decal" {{ old('category', $product->category ?? '')=='Decal'?'selected':'' }}>Decal</option>
                                <option value="Sablon Kaos" {{ old('category', $product->category ?? '')=='Sablon Kaos'?'selected':'' }}>Sablon Kaos</option>
                                <option value="Sticker" {{ old('category', $product->category ?? '')=='Sticker'?'selected':'' }}>Sticker</option>
                                <option value="Striping" {{ old('category', $product->category ?? '')=='Striping'?'selected':'' }}>Striping</option>
                                <!-- <option value="Lainnya" {{ old('category', $product->category ?? '')=='Lainnya'?'selected':'' }}>Lainnya</option> -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Deskripsi Produk</label>
                            <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ isset($product) ? 'Perbarui Produk' : 'Tambah Produk' }}
                        </button>

                    </div>
                </div>

            </form>

        </div>
    </div>


    {{-- ============================ TABEL PRODUK ============================ --}}
    <div class="card mt-4">
        <div class="card-header"><strong>Daftar Produk</strong></div>

        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $i => $p)
                        <tr>
                            <td>{{ $i+1 }}</td>

                            <td>
                                @if($p->image)
                                    <img src="{{ asset('storage/'.$p->image) }}" width="70" class="rounded shadow-sm">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td>{{ $p->name }}</td>
                            <td>{{ $p->category ?? '-' }}</td>
                            <td>{{ $p->description }}</td>

                            <td>
                                <a href="{{ route('admin.products.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">Hapus</button>
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
