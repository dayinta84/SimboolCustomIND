@extends('layout.adminlte') {{-- Gunakan layout adminlte Anda --}}
@section('title', 'Kelola Produk')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-box-open"></i> {{ isset($product) ? 'Edit Produk' : 'Tambah Produk Baru' }}
                    </h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <form 
                        action="{{ isset($product) 
                            ? route('admin.products.update', $product->id) 
                            : route('admin.products.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($product)) @method('PUT') @endif

                        <div class="row">
                            <!-- Kolom Gambar -->
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="image">Gambar Produk</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image">
                                            <label class="custom-file-label" for="image">Pilih Gambar</label>
                                        </div>
                                    </div>
                                    <!-- Preview Gambar -->
                                    <div class="mt-2 text-center">
                                        @if(isset($product) && $product->image)
                                            <img id="preview" src="{{ asset('storage/'.$product->image) }}" 
                                                 class="img-fluid img-thumbnail" style="max-height: 200px;" alt="Preview Gambar">
                                        @else
                                            <img id="preview" src="https://placehold.co/300x200?text=No+Image" 
                                                 class="img-fluid img-thumbnail" style="max-height: 200px;" alt="No Image">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Form -->
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="name">Nama Produk</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name', $product->name ?? '') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="category">Kategori</label>
                                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="Banner" {{ old('category', $product->category ?? '')=='Banner'?'selected':'' }}>Banner</option>
                                        <option value="Decal" {{ old('category', $product->category ?? '')=='Decal'?'selected':'' }}>Decal</option>
                                        <option value="Sablon Kaos" {{ old('category', $product->category ?? '')=='Sablon Kaos'?'selected':'' }}>Sablon Kaos</option>
                                        <option value="Sticker" {{ old('category', $product->category ?? '')=='Sticker'?'selected':'' }}>Sticker</option>
                                        <option value="Striping" {{ old('category', $product->category ?? '')=='Striping'?'selected':'' }}>Striping</option>
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="editor">Deskripsi Produk</label>
                                    <textarea id="editor" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description ?? '') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> {{ isset($product) ? 'Perbarui Produk' : 'Tambah Produk' }}
                                    </button>
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-default">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title"><i class="fas fa-list"></i> Daftar Produk</h3>
                    <div class="card-tools">
                        <form method="GET" class="form-inline">
                            <div class="input-group input-group-sm">
                                <select name="category" class="form-control float-right" onchange="this.form.submit()">
                                    <option value="all" {{ request('category') ? '' : 'selected' }}>-- Semua Kategori --</option>
                                    <option value="Banner" {{ request('category')=='Banner' ? 'selected' : '' }}>Banner</option>
                                    <option value="Decal" {{ request('category')=='Decal' ? 'selected' : '' }}>Decal</option>
                                    <option value="Sablon Kaos" {{ request('category')=='Sablon Kaos' ? 'selected' : '' }}>Sablon Kaos</option>
                                    <option value="Sticker" {{ request('category')=='Sticker' ? 'selected' : '' }}>Sticker</option>
                                    <option value="Striping" {{ request('category')=='Striping' ? 'selected' : '' }}>Striping</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
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
                                @forelse($products as $i => $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($p->image)
                                                <img src="{{ asset('storage/'.$p->image) }}" width="60" class="img-thumbnail" alt="Gambar Produk">
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $p->name }}</td>
                                        <td><span class="badge bg-info">{{ $p->category ?? '-' }}</span></td>
                                        <td style="max-width:260px; white-space: normal;">
                                             {{ Str::limit(str_replace('&nbsp;', ' ', strip_tags($p->description)), 90) }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.products.edit', $p->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger flex-fill" onclick="return confirm('Hapus produk ini?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">Tidak ada produk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
@endsection

@section('scripts')
    <!-- Summernote -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>

    {{-- kalau AdminLTE kamu belum include plugin ini, aktifkan: --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script> --}}

    <script>
        $(function () {

            // Inisialisasi Summernote
            $('#editor').summernote({
                placeholder: 'Tulis deskripsi produk...',
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']]
                ],
                callbacks: {
                    onChange: function(contents) {
                        // hapus inline color biar tidak jadi hitam di halaman dark
                        contents = contents.replace(/color\s*:\s*[^;"']+;?/gi, '');
                        contents = contents.replace(/<span\s+style="[^"]*">\s*<\/span>/gi, '');
                        $('textarea[name="description"]').val(contents);
                    }
                }
            });

            // Update nama file pada label input gambar
            if (window.bsCustomFileInput) {
                bsCustomFileInput.init();
            }

            // Preview gambar sebelum upload + set label nama file
            const imageInput = document.getElementById('image');
            if (imageInput) {
                imageInput.addEventListener('change', function(e) {
                    const file = e.target.files && e.target.files[0];
                    if (!file) return;

                    // preview
                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        const preview = document.getElementById('preview');
                        if (preview) preview.src = ev.target.result;
                    };
                    reader.readAsDataURL(file);

                    // label nama file (fallback kalau bsCustomFileInput tidak jalan)
                    const label = document.querySelector('label[for="image"].custom-file-label');
                    if (label) label.textContent = file.name;
                });
            }

        });
    </script>
@endsection