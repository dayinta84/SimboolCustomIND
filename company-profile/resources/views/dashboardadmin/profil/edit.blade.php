@extends('layout.adminlte')
@section('title', 'Kelola Profil')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Kelola Profil Perusahaan</h3>

    {{-- Gambar Profil --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('profil.update', ['role' => Auth::user()->role]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 text-center">
                        @if($profil && $profil->image)
                            <img src="{{ asset('storage/' . $profil->image) }}" alt="Gambar Profil" class="img-fluid rounded shadow-sm mb-2" style="max-height:200px;">
                        @else
                            <div class="border rounded p-4 text-muted">Belum ada gambar</div>
                        @endif
                        <input type="file" name="image" class="form-control mt-2">

                        {{-- Gambar Tentang Kami --}}
                        <div class="mb-3 mt-4 text-left">
                            <label>Gambar Tentang Kami</label>
                            @if($profil && $profil->image_tentang)
                                <img src="{{ asset('storage/' . $profil->image_tentang) }}" class="img-fluid mb-2" style="max-height:150px;">
                            @endif
                            <input type="file" name="image_tentang" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label>Judul / Nama Perusahaan</label>
                            <input type="text" name="title" value="{{ $profil->title ?? '' }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Tentang Kami</label>
                            <textarea name="tentang" class="form-control">{{ $profil->tentang ?? '' }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Visi</label>
                            <textarea name="visi" class="form-control">{{ $profil->visi ?? '' }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Misi</label>
                            <textarea name="misi" class="form-control">{{ $profil->misi ?? '' }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- LAYANAN KAMI --}}
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0 d-inline">Layanan Kami</h5>
            <!-- 🔧 ubah data-bs ke data- -->
            <button class="btn btn-success btn-sm float-right" data-toggle="collapse" data-target="#tambahLayanan">+ Tambah</button>
        </div>
        <div class="collapse p-3" id="tambahLayanan">
            <form action="{{ route('layanan.store', ['role' => Auth::user()->role]) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="judul" class="form-control" placeholder="Judul Layanan" required>
                    </div>
                    <div class="col-md-7">
                        <textarea name="deskripsi" class="form-control" placeholder="Deskripsi Layanan" required></textarea>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead><tr><th>No</th><th>Judul</th><th>Deskripsi</th><th>Aksi</th></tr></thead>
                <tbody>
                    @foreach($layanans as $i => $l)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $l->judul }}</td>
                        <td>{{ $l->deskripsi }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" 
                                data-id="{{ $l->id }}" 
                                data-judul="{{ $l->judul }}" 
                                data-deskripsi="{{ $l->deskripsi }}"
                                onclick="editLayanan(this)">Edit</button>

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

    {{-- SECTION TAMBAHAN --}}
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0 d-inline">Section Tambahan</h5>
            <!-- 🔧 ubah data-bs ke data- -->
            <button class="btn btn-success btn-sm float-right" data-toggle="collapse" data-target="#tambahSection">+ Tambah</button>
        </div>
        <div class="collapse p-3" id="tambahSection">
            <form action="{{ route('profil.tambahSection', ['role' => Auth::user()->role]) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="judul" class="form-control" placeholder="Judul Section" required>
                    </div>
                    <div class="col-md-7">
                        <textarea name="isi" class="form-control" placeholder="Isi Section" required></textarea>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead><tr><th>No</th><th>Judul</th><th>Isi</th><th>Aksi</th></tr></thead>
                <tbody>
                @foreach($sections as $i => $sec)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $sec->judul }}</td>
                        <td>{{ $sec->isi }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" 
                                data-id="{{ $sec->id }}" 
                                data-judul="{{ $sec->judul }}" 
                                data-isi="{{ $sec->isi }}"
                                onclick="editSection(this)">Edit</button>

                            <form action="{{ route('profil.hapusSection', ['role'=>Auth::user()->role,'id'=>$sec->id]) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <script>
                    function editLayanan(btn) {
                        const id = btn.dataset.id;
                        const judul = btn.dataset.judul;
                        const deskripsi = btn.dataset.deskripsi;

                        const form = document.querySelector('#tambahLayanan form');
                        form.action = `/profil/{{ Auth::user()->role }}/edit-layanan/${id}`;
                        form.querySelector('input[name="judul"]').value = judul;
                        form.querySelector('textarea[name="deskripsi"]').value = deskripsi;

                        // 🔽 Tambahkan ini
                        form.querySelector('input[name="_method"]')?.remove();
                        form.insertAdjacentHTML('beforeend', '<input type="hidden" name="_method" value="PUT">');

                        document.querySelector('#tambahLayanan').classList.add('show');
                    }

                    function editSection(btn) {
                        const id = btn.dataset.id;
                        const judul = btn.dataset.judul;
                        const isi = btn.dataset.isi;

                        const form = document.querySelector('#tambahSection form');
                        form.action = `/profil/{{ Auth::user()->role }}/edit-section/${id}`;
                        form.querySelector('input[name="judul"]').value = judul;
                        form.querySelector('textarea[name="isi"]').value = isi;

                        // 🔽 Tambahkan ini juga
                        form.querySelector('input[name="_method"]')?.remove();
                        form.insertAdjacentHTML('beforeend', '<input type="hidden" name="_method" value="PUT">');

                        document.querySelector('#tambahSection').classList.add('show');
                    }
                    </script>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
