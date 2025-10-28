@extends('layout.adminlte')
@section('title', 'Kelola Profil')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Kelola Profil Perusahaan</h3>

    {{-- Gambar Profil --}}
    <div class="card mb-4">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profil.update', ['role' => Auth::user()->role]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4 text-center">
                        {{-- Gambar Profil --}}
                        @if($profil && $profil->image)
                            <img src="{{ asset('storage/' . $profil->image) }}" alt="Gambar Profil" class="img-fluid rounded shadow-sm mb-2" style="max-height:200px;">
                        @else
                            <div class="border rounded p-4 text-muted">Belum ada gambar</div>
                        @endif
                        <input type="file" name="image" class="form-control mt-2">

                        {{-- Gambar Tentang Kami --}}
                        <div class="mb-3 mt-4 text-left">
                            <label>Gambar Tentang Kami</label> <br>
                            @if($profil && $profil->image_tentang)
                                <img src="{{ asset('storage/' . $profil->image_tentang) }}" class="img-fluid mb-2" style="max-height:150px;">
                            @endif
                            <input type="file" name="image_tentang" class="form-control">
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
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
            <button class="btn btn-success btn-sm float-right" data-toggle="collapse" data-target="#tambahSection">+ Tambah</button>
        </div>
        <div class="collapse p-3" id="tambahSection">
            <form action="{{ route('profil.tambahSection', ['role' => Auth::user()->role]) }}" method="POST" id="sectionForm">
                @csrf
                <input type="hidden" name="_method" value="POST" id="sectionMethod">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="judul" class="form-control" placeholder="Judul Section" required>
                    </div>
                    <div class="col-md-7">
                        <textarea name="isi" class="form-control" placeholder="Isi Section" required></textarea>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary">Simpan</button>
                        <!-- <button type="button" class="btn btn-secondary" onclick="resetSectionForm()">Batal</button> -->
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
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ================== SCRIPT ================== --}}
<script>
function editLayanan(btn) {
    const id = btn.dataset.id;
    const judul = btn.dataset.judul;
    const deskripsi = btn.dataset.deskripsi;

    const form = document.querySelector('#tambahLayanan form');
    form.action = "{{ route('layanan.update', ['role' => Auth::user()->role, 'id' => ':id']) }}".replace(':id', id);
    
    form.querySelector('input[name="judul"]').value = judul;
    form.querySelector('textarea[name="deskripsi"]').value = deskripsi;

    // form.querySelector('input[name="judul"]').value = judul;
    // form.querySelector('textarea[name="deskripsi"]').value = deskripsi;

    // form.querySelector('input[name="_method"]')?.remove();
    // form.insertAdjacentHTML('beforeend', '<input type="hidden" name="_method" value="PUT">');

    document.querySelector('#tambahLayanan').classList.add('show');
}

function editSection(btn) {
    const id = btn.dataset.id;
    const judul = btn.dataset.judul;
    const isi = btn.dataset.isi;

    const form = document.getElementById('sectionForm');
    const methodInput = document.getElementById('sectionMethod');

    // const form = document.querySelector('#tambahSection form');
    // const methodInput = document.getElementById('sectionMethod');

    form.action = "{{ route('profil.editSection', ['role' => Auth::user()->role, 'id' => ':id']) }}".replace(':id', id);
    methodInput.value = 'PUT';

    form.querySelector('input[name="judul"]').value = judul;
    form.querySelector('textarea[name="isi"]').value = isi;

    form.querySelector('input[name="_method"]')?.remove();
    form.insertAdjacentHTML('beforeend', '<input type="hidden" name="_method" value="PUT">');

    document.querySelector('#tambahSection').classList.add('show');
}

// Fungsi untuk reset form ke mode tambah
function resetSectionForm() {
    const form = document.getElementById('sectionForm');
    const methodInput = document.getElementById('sectionMethod');
    
    form.action = "{{ route('profil.tambahSection', ['role' => Auth::user()->role]) }}";
    methodInput.value = 'POST';
    
    form.querySelector('input[name="judul"]').value = '';
    form.querySelector('textarea[name="isi"]').value = '';

    // // Hapus method input jika ada (untuk mencegah konflik)
    // const existingMethod = form.querySelector('input[name="_method"][value="PUT"]');
    // if (existingMethod) {
    //     existingMethod.remove();
    // }
}


// ======== Preview Gambar Otomatis ========
document.addEventListener('DOMContentLoaded', function() {
    // Preview gambar utama
    const imageInput = document.querySelector('input[name="image"]');
    const imagePreview = document.querySelector('img[alt="Gambar Profil"]');

    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    if (imagePreview) {
                        imagePreview.src = event.target.result;
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Preview gambar tentang kami
    const imageTentangInput = document.querySelector('input[name="image_tentang"]');
    const imageTentangPreview = document.querySelector('img[src*="storage/"][class="img-fluid mb-2"]');

    if (imageTentangInput) {
        imageTentangInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    if (imageTentangPreview) {
                        imageTentangPreview.src = event.target.result;
                    } else {
                        const newImg = document.createElement('img');
                        newImg.src = event.target.result;
                        newImg.classList.add('img-fluid', 'mb-2');
                        newImg.style.maxHeight = '150px';
                        imageTentangInput.insertAdjacentElement('beforebegin', newImg);
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
@endsection
