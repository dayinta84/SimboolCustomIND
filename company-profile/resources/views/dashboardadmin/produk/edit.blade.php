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
                                    <label>Kategori</label>

                                    <input list="category-list"
                                        name="category"
                                        class="form-control"
                                        placeholder="Pilih atau ketik kategori baru"
                                        value="{{ old('category', $product->category ?? '') }}">

                                    <datalist id="category-list">
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat }}">
                                        @endforeach
                                    </datalist>
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
                                    <option value="">-- Semua Kategori --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                            {{ $cat }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover text-nowrap">
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
                                        <td class="text-truncate" style="max-width: 200px;" title="{{ strip_tags($p->description) }}">{!! strip_tags($p->description) !!}</td>
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
                    onImageUpload: function(files) {
                        // Jika ingin menangani upload gambar langsung ke editor, tambahkan logika di sini
                        // Contoh sederhana (tanpa backend):
                        // for(let i = 0; i < files.length; i++) {
                        //     let reader = new FileReader();
                        //     reader.onload = function(event) {
                        //         $('#editor').summernote('insertImage', event.target.result);
                        //     }
                        //     reader.readAsDataURL(files[i]);
                        // }
                    }
                }
            });

            // Update nama file pada label input gambar
            bsCustomFileInput.init();

            // Preview gambar sebelum upload
            document.getElementById('image').addEventListener('change', function(e) {
                const [file] = e.target.files;
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('preview').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection