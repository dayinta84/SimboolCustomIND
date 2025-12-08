@extends('auth.admin')

@section('content')

@php
    $role = Auth::user()->role;
@endphp

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">
            <i class="fas fa-home me-2 text-muted"></i> Edit Halaman Depan
        </h2>
        <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-eye me-1"></i> Preview
        </a>
    </div>

    <!-- ======================= SLIDER ======================= -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-light py-2">
            <h5 class="mb-0 fw-bold text-dark">
                <i class="fas fa-images me-2 text-primary"></i> Slider
            </h5>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.slider.store', ['role' => $role]) }}" method="POST" enctype="multipart/form-data" class="mb-3">
                @csrf
                <div class="row g-2 align-items-end">
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-dark">Upload Gambar</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-plus me-1"></i> Tambah Slider
                        </button>
                    </div>
                </div>
            </form>

            @if($slides->count())
                <div class="row g-3 mt-1">
                    @foreach($slides as $slide)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card h-100 shadow-sm border">
                                <img src="{{ asset('storage/'.$slide->image) }}" 
                                     class="card-img-top" 
                                     alt="Slider"
                                     style="height: 140px; object-fit: cover;">
                                <div class="card-body p-2">
                                    <p class="text-muted small mb-1">{{ Str::limit($slide->title ?? '—', 25) }}</p>
                                </div>
                                <div class="card-footer bg-white p-2 border-top">
                                    <form action="{{ route('admin.slider.delete', ['role' => $role, 'id' => $slide->id]) }}" method="POST" class="d-grid">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Yakin hapus slider ini?')">
                                            <i class="fas fa-trash-alt me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-light text-center border mb-0">
                    <i class="fas fa-info-circle text-muted me-1"></i> Belum ada slider.
                </div>
            @endif

        </div>
    </div>

    <hr class="my-4">

    <!-- ======================= KONTEN UTAMA ======================= -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-light py-2">
            <h5 class="mb-0 fw-bold text-dark">
                <i class="fas fa-heading me-2 text-info"></i> Konten Utama
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.home_content.update', $role) }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-medium">Judul Halaman</label>
                        <input type="text" name="title" class="form-control" value="{{ $content->title ?? '' }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-medium">Sub Judul</label>
                        <input type="text" name="subtitle" class="form-control" value="{{ $content->subtitle ?? '' }}">
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fas fa-save me-1"></i> Simpan Konten Utama
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <hr class="my-4">

    <!-- ======================= MENGAPA KAMI (WHY) ======================= -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-light py-2 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-dark">
                <i class="fas fa-question-circle me-2 text-purple"></i> Mengapa Kami
            </h5>
            <button class="btn btn-sm btn-outline-purple" data-bs-toggle="collapse" data-bs-target="#addWhyForm">
                <i class="fas fa-plus me-1"></i> Tambah
            </button>
        </div>
        <div class="card-body">

            <!-- Form Tambah (dengan collapse agar rapi) -->
            <div class="collapse {{ $errors->has('title') ? 'show' : '' }}" id="addWhyForm">
                <form action="{{ route('admin.why.store', $role) }}" method="POST" class="mb-4 p-3 bg-light rounded">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label fw-medium">Judul</label>
                            <input type="text" name="title" class="form-control" placeholder="Contoh: Tim Profesional" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="2" placeholder="Penjelasan singkat..." required></textarea>
                        </div>
                        <div class="col-md-1">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-purple w-100">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tabel WHY -->
            @if($whys->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($whys as $index => $why)
                                <tr>
                                    <td class="fw-bold text-muted">{{ $index + 1 }}</td>
                                    <td><strong>{{ $why->title }}</strong></td>
                                    <td class="text-muted">{{ Str::limit($why->description, 60) }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning me-1"
                                            onclick="openWhyEdit({{ $why->id }}, '{{ addslashes($why->title) }}', '{{ addslashes($why->description) }}')">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <form action="{{ route('admin.why.delete', ['role'=>$role, 'id'=>$why->id]) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4 text-muted">
                    <i class="fas fa-exclamation-circle fa-2x mb-2"></i>
                    <p class="mb-0">Belum ada poin "Mengapa Kami".</p>
                </div>
            @endif

            <!-- Form Edit (tetap hidden, hanya tampilan diperbaiki) -->
            <div id="editWhyBox" class="mt-4 p-4 border rounded bg-light" style="display:none;">
                <h5 class="fw-bold text-dark mb-3">
                    <i class="fas fa-edit me-2 text-warning"></i> Edit Poin "Mengapa Kami"
                </h5>
                <form id="editWhyForm" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-medium">Judul</label>
                            <input type="text" name="title" id="why_title" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-medium">Deskripsi</label>
                            <textarea name="description" id="why_desc" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-secondary me-2" onclick="document.getElementById('editWhyBox').style.display='none'">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-1"></i> Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
.text-purple { color: #7E22CE !important; }
.btn-purple {
    background-color: #7E22CE;
    border-color: #7E22CE;
    color: white;
}
.btn-purple:hover {
    background-color: #6B21A8;
    border-color: #581C87;
}
.btn-outline-purple {
    color: #7E22CE;
    border-color: #7E22CE;
}
.btn-outline-purple:hover {
    background-color: #f5f3ff;
    color: #581C87;
}
</style>
@endpush

@section('scripts')
<script>
function openWhyEdit(id, title, description) {
    document.getElementById("editWhyBox").style.display = "block";
    document.getElementById("why_title").value = title;
    document.getElementById("why_desc").value = description;
    document.getElementById("editWhyForm").action = "/{{ $role }}/home_content/why/update/" + id;
}
</script>
@endsection