@extends('auth.admin')

@section('content')

@php
    // Ambil role dari URL (admin / superadmin)
    $role = Auth::user()->role;
@endphp

<div class="container">

    <h2>Edit Home</h2>

    <!-- ======================= SLIDER ======================= -->
    <h4>Slider</h4>

    <form action="{{ route('admin.slider.store', ['role' => $role]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" required>
        <button class="btn btn-primary mt-2">Tambah Slider</button>
    </form>

    <div class="row mt-3">
        @foreach($slides as $slide)
        <div class="col-md-3">
            <img src="{{ asset('storage/'.$slide->image) }}" class="img-fluid mb-1">

            <form action="{{ route('admin.slider.delete', ['role' => $role, 'id' => $slide->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>

        </div>
    @endforeach
    </div>

    <hr>

    <!-- ======================= KONTEN UTAMA ======================= -->
    <h4>Konten Utama</h4>

    <form action="{{ route('admin.home_content.update', $role) }}" method="POST">
        @csrf

        <label>Judul Halaman</label>
        <input type="text" name="title" class="form-control" value="{{ $content->title ?? '' }}">

        <label class="mt-2">Sub Judul</label>
        <input type="text" name="subtitle" class="form-control" value="{{ $content->subtitle ?? '' }}">

        <h5 class="mt-3">Mengapa Kami</h5>

        <input type="text" name="why_1_title" class="form-control mt-1" placeholder="Judul 1"
               value="{{ $content->why_1_title ?? '' }}">
        <textarea name="why_1_desc" class="form-control mt-1">{{ $content->why_1_desc ?? '' }}</textarea>

        <input type="text" name="why_2_title" class="form-control mt-2" placeholder="Judul 2"
               value="{{ $content->why_2_title ?? '' }}">
        <textarea name="why_2_desc" class="form-control mt-1">{{ $content->why_2_desc ?? '' }}</textarea>

        <input type="text" name="why_3_title" class="form-control mt-2" placeholder="Judul 3"
               value="{{ $content->why_3_title ?? '' }}">
        <textarea name="why_3_desc" class="form-control mt-1">{{ $content->why_3_desc ?? '' }}</textarea>

        <button class="btn btn-success mt-3">Simpan Konten Utama</button>
    </form>

    <hr>

    <!-- ======================= LAYANAN ======================= -->
    <h4>Layanan Kami</h4>

    <!-- FORM TAMBAH LAYANAN -->
    <form action="{{ route('admin.layananlist.add', $role) }}" method="POST">
        @csrf
        <input type="text" name="nama_layanan" class="form-control" placeholder="Nama Layanan" required>
        <textarea name="deskripsi" class="form-control mt-2" placeholder="Deskripsi (opsional)"></textarea>
        <button class="btn btn-primary mt-2">Tambah Layanan</button>
    </form>

    <!-- LIST LAYANAN -->
    <div class="mt-3">
        <h5>Daftar Layanan</h5>

        @foreach($layanan as $item)
            <div class="border rounded p-3 mb-3">

                <strong>{{ $item->nama_layanan }}</strong>
                <p class="mb-1">{{ $item->deskripsi }}</p>

                <!-- EDIT LAYANAN -->
                <form action="{{ route('admin.layananlist.update', ['role' => $role, 'id' => $item->id]) }}" 
                      method="POST" class="mb-2">
                    @csrf
                    <input type="text" name="nama_layanan" class="form-control"
                           value="{{ $item->nama_layanan }}">
                    <textarea name="deskripsi" class="form-control mt-1">{{ $item->deskripsi }}</textarea>
                    <button class="btn btn-warning btn-sm mt-1">Update</button>
                </form>

                <!-- HAPUS LAYANAN -->
                <form action="{{ route('admin.layananlist.delete', ['role' => $role, 'id' => $item->id]) }}" 
                      method="POST">
                    @csrf 
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>

            </div>
        @endforeach

    </div>

</div>
@endsection