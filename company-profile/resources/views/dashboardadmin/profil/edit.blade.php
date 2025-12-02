@extends('layout.adminlte')
@section('title', 'Kelola Profil')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4 fw-bold text-dark"><i class="fas fa-building"></i> Kelola Profil Perusahaan</h3>

    <!-- CARD PROFIL UTAMA -->
    <div class="card card-outline card-primary shadow-lg rounded-3 border-0">
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0"><i class="fas fa-image me-2"></i> Informasi & Gambar Profil</h5>
        </div>
        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-exclamation-triangle me-1"></i> Kesalahan:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('profil.update', ['role' => Auth::user()->role]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- Kolom Gambar -->
                    <div class="col-md-4">
                        <div class="text-center">
                            <!-- Logo / Gambar Utama -->
                            <div class="position-relative d-inline-block">
                                <img id="previewLogo" src="{{ $profil && $profil->image ? asset('storage/' . $profil->image) : 'https://placehold.co/300x200?text=No+Logo&bg=f0f0f0&fg=6c757d' }}"
                                     class="img-fluid rounded shadow-sm border" style="max-height: 200px; object-fit: contain;"
                                     alt="Logo Perusahaan">
                                <label for="image" class="btn btn-sm btn-outline-primary mt-2 w-100">
                                    <i class="fas fa-upload me-1"></i> Ganti Logo
                                </label>
                                <input type="file" name="image" id="image" class="d-none" accept="image/*">
                            </div>

                            <!-- Gambar Tentang Kami -->
                            <div class="mt-4 position-relative d-inline-block">
                                <img id="previewTentang" src="{{ $profil && $profil->image_tentang ? asset('storage/' . $profil->image_tentang) : 'https://placehold.co/300x150?text=No+Image&bg=f0f0f0&fg=6c757d' }}"
                                     class="img-fluid rounded shadow-sm border" style="max-height: 150px; object-fit: contain;"
                                     alt="Gambar Tentang Kami">
                                <label for="image_tentang" class="btn btn-sm btn-outline-secondary mt-2 w-100">
                                    <i class="fas fa-upload me-1"></i> Ganti Gambar
                                </label>
                                <input type="file" name="image_tentang" id="image_tentang" class="d-none" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Form -->
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label for="title" class="form-label"><i class="fas fa-tag me-1"></i> Judul / Nama Perusahaan</label>
                            <input type="text" name="title" id="title" class="form-control form-control-lg @error('title') is-invalid @enderror"
                                   value="{{ old('title', $profil->title ?? '') }}" placeholder="Contoh: Simbool Custom Industries" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tentang" class="form-label"><i class="fas fa-book-open me-1"></i> Tentang Kami</label>
                            <textarea name="tentang" id="tentang" class="form-control @error('tentang') is-invalid @enderror" rows="4"
                                      placeholder="Deskripsikan tentang perusahaan Anda...">{{ old('tentang', $profil->tentang ?? '') }}</textarea>
                            @error('tentang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="visi" class="form-label"><i class="fas fa-eye me-1"></i> Visi</label>
                            <textarea name="visi" id="visi" class="form-control @error('visi') is-invalid @enderror" rows="3"
                                      placeholder="Apa visi perusahaan Anda?">{{ old('visi', $profil->visi ?? '') }}</textarea>
                            @error('visi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="misi" class="form-label"><i class="fas fa-flag me-1"></i> Misi</label>
                            <textarea name="misi" id="misi" class="form-control @error('misi') is-invalid @enderror" rows="3"
                                      placeholder="Apa misi perusahaan Anda?">{{ old('misi', $profil->misi ?? '') }}</textarea>
                            @error('misi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-lg btn-primary w-100">
                                <i class="fas fa-save me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- CARD LAYANAN -->
    <div class="card mt-4 card-outline card-success shadow-lg rounded-3 border-0">
        <div class="card-header bg-gradient-success text-white d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0"><i class="fas fa-cogs me-2"></i> Layanan Kami</h5>
            <button class="btn btn-sm btn-light" data-toggle="collapse" data-target="#tambahLayanan">
                <i class="fas fa-plus me-1"></i> Tambah Layanan
            </button>
        </div>
        <div class="card-body p-4">
            <!-- Form Tambah/Edit Layanan -->
            <div class="collapse" id="tambahLayanan">
                <form action="{{ route('layanan.store', ['role' => Auth::user()->role]) }}" method="POST" id="layananForm">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-5">
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                                   placeholder="Judul Layanan" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                      placeholder="Deskripsi layanan..." rows="2" required></textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-save"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tabel Layanan -->
            <div class="table-responsive mt-3">
                <table class="table table-hover align-middle">
                    <thead class="table-success">
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($layanans as $l)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $l->judul }}</strong></td>
                                <td class="text-truncate" style="max-width: 300px;" title="{{ $l->deskripsi }}">
                                    {{ Str::limit($l->deskripsi, 60, '...') }}
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning" 
                                        data-id="{{ $l->id }}" 
                                        data-judul="{{ $l->judul }}" 
                                        data-deskripsi="{{ $l->deskripsi }}"
                                        onclick="editLayanan(this)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('layanan.destroy', ['role'=>Auth::user()->role,'id'=>$l->id]) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus layanan ini?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="fas fa-cog fa-2x mb-2 opacity-50"></i>
                                    <p class="mb-0">Belum ada layanan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- CARD SECTION TAMBAHAN -->
    <div class="card mt-4 card-outline card-info shadow-lg rounded-3 border-0">
        <div class="card-header bg-gradient-info text-white d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0"><i class="fas fa-folder-open me-2"></i> Section Tambahan</h5>
            <button class="btn btn-sm btn-light" data-toggle="collapse" data-target="#tambahSection">
                <i class="fas fa-plus me-1"></i> Tambah Section
            </button>
        </div>
        <div class="card-body p-4">
            <!-- Form Tambah/Edit Section -->
            <div class="collapse" id="tambahSection">
                <form action="{{ route('profil.tambahSection', ['role' => Auth::user()->role]) }}" method="POST" id="sectionForm">
                    @csrf
                    <input type="hidden" name="_method" value="POST" id="sectionMethod">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                                   placeholder="Judul Section" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <textarea name="isi" class="form-control @error('isi') is-invalid @enderror"
                                      placeholder="Isi section..." rows="2" required></textarea>
                            @error('isi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-info w-100">
                                <i class="fas fa-save"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tabel Section -->
            <div class="table-responsive mt-3">
                <table class="table table-hover align-middle">
                    <thead class="table-info">
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sections as $sec)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $sec->judul }}</strong></td>
                                <td class="text-truncate" style="max-width: 300px;" title="{{ $sec->isi }}">
                                    {{ Str::limit($sec->isi, 60, '...') }}
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning" 
                                        data-id="{{ $sec->id }}" 
                                        data-judul="{{ $sec->judul }}" 
                                        data-isi="{{ $sec->isi }}"
                                        onclick="editSection(this)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('profil.hapusSection', ['role'=>Auth::user()->role,'id'=>$sec->id]) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus section ini?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="fas fa-folder-open fa-2x mb-2 opacity-50"></i>
                                    <p class="mb-0">Belum ada section tambahan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Preview gambar logo
    document.getElementById('image')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('previewLogo').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Preview gambar tentang kami
    document.getElementById('image_tentang')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('previewTentang').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Edit Layanan
    function editLayanan(btn) {
        const id = btn.dataset.id;
        const judul = btn.dataset.judul;
        const deskripsi = btn.dataset.deskripsi;

        const form = document.getElementById('layananForm');
        form.action = "{{ route('layanan.update', ['role' => Auth::user()->role, 'id' => ':id']) }}".replace(':id', id);

        form.querySelector('input[name="judul"]').value = judul;
        form.querySelector('textarea[name="deskripsi"]').value = deskripsi;

        // Ubah method ke PUT
        let methodInput = form.querySelector('input[name="_method"]');
        if (!methodInput) {
            methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);
        } else {
            methodInput.value = 'PUT';
        }

        // Buka collapse
        document.getElementById('tambahLayanan').classList.add('show');
    }

    // Edit Section
    function editSection(btn) {
        const id = btn.dataset.id;
        const judul = btn.dataset.judul;
        const isi = btn.dataset.isi;

        const form = document.getElementById('sectionForm');
        const methodInput = document.getElementById('sectionMethod');

        form.action = "{{ route('profil.editSection', ['role' => Auth::user()->role, 'id' => ':id']) }}".replace(':id', id);
        methodInput.value = 'PUT';

        form.querySelector('input[name="judul"]').value = judul;
        form.querySelector('textarea[name="isi"]').value = isi;

        // Buka collapse
        document.getElementById('tambahSection').classList.add('show');
    }
</script>
@endsection