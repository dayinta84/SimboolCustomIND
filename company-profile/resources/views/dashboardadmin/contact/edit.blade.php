@extends('layout.adminlte')
@section('title', 'Edit Halaman Kontak')

@php use Illuminate\Support\Facades\Storage; @endphp


@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-outline card-dark shadow-lg rounded-3 border-0">
                <div class="card-header bg-gradient-dark text-white d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0"><i class="fas fa-edit me-2"></i> Edit Halaman Kontak</h4>
                </div>
                <div class="card-body p-4">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('admin.contact.updatepage', ['role' => Auth::user()->role]) }}" 
                          method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Gambar -->
                        <div class="form-group mb-4">
                            <label for="gambar" class="form-label"><i class="fas fa-image me-1"></i> Gambar Header</label>
                            <div class="text-center mb-3">
                                @if(!empty($contact->gambar) && Storage::disk('uploads')->exists($contact->gambar))
                                    <img id="previewImage" src="{{ Storage::disk('uploads')->url($contact->gambar) }}" 
                                         class="img-fluid rounded border shadow-sm" style="max-height: 200px; object-fit: contain;" 
                                         alt="Preview Gambar Kontak">
                                @else
                                    <img id="previewImage" src="https://placehold.co/300x200?text=No+Image&bg=343a40&fg=adb5bd" 
                                         class="img-fluid rounded border shadow-sm" style="max-height: 200px; object-fit: contain;" 
                                         alt="No Image">
                                @endif
                            </div>
                            <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="form-group mb-4">
                            <label for="alamat" class="form-label"><i class="fas fa-map-marker-alt me-1"></i> Alamat</label>
                            <input type="text" name="alamat" id="alamat" 
                                   value="{{ old('alamat', $contact->alamat ?? '') }}" 
                                   class="form-control @error('alamat') is-invalid @enderror" 
                                   placeholder="Masukkan alamat lengkap...">
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- WhatsApp -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-bold"><i class="fab fa-whatsapp me-1 text-success"></i> Nomor WhatsApp</label>
                            <small class="text-muted d-block mb-2">Tambahkan satu atau lebih nomor WhatsApp.</small>

                            <div id="whatsapp-container">
                                @php
                                    $whatsapps = $contact->whatsapp ?? [''];
                                @endphp

                                @foreach($whatsapps as $wa)
                                    <div class="d-flex align-items-center mb-2">
                                        <input type="text" name="whatsapp[]" 
                                               class="form-control @error('whatsapp.*') is-invalid @enderror"
                                               value="{{ $wa }}" 
                                               placeholder="0877xxxxxxx"
                                               maxlength="13" 
                                               pattern="[0-9]{10,13}"
                                               title="Nomor harus terdiri dari 10–13 digit angka">
                                        <button type="button" class="btn btn-danger btn-sm ms-2" onclick="removeField(this)">Hapus</button>
                                    </div>
                                @endforeach
                                @error('whatsapp.*')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="button" class="btn btn-success btn-sm mt-2" onclick="addField()">
                                <i class="fas fa-plus me-1"></i> Tambah Nomor
                            </button>
                        </div>

                        <!-- Google Maps -->
                        <div class="form-group mb-4">
                            <label for="map" class="form-label"><i class="fas fa-map-marked-alt me-1"></i> Link Google Maps</label>
                            <input type="text" name="map" id="map"
                                   value="{{ old('map', $contact->map ?? '') }}"
                                   class="form-control @error('map') is-invalid @enderror"
                                   placeholder="Masukkan link Google Maps (contoh: https://www.google.com/maps/place/...)">
                            <small class="text-muted">
                                Masukkan link Google Maps.
                            </small>
                            @error('map')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-dark btn-lg w-100">
                                <i class="fas fa-save me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Tambah field WhatsApp
    function addField() {
        const container = document.getElementById('whatsapp-container');
        const div = document.createElement('div');
        div.classList.add('d-flex', 'align-items-center', 'mb-2');
        div.innerHTML = `
            <input type="text" name="whatsapp[]" 
                   class="form-control"
                   placeholder="0877xxxxxxx"
                   maxlength="13" 
                   pattern="[0-9]{10,13}"
                   title="Nomor harus terdiri dari 10–13 digit angka">
            <button type="button" class="btn btn-danger btn-sm ms-2" onclick="removeField(this)">Hapus</button>
        `;
        container.appendChild(div);
    }

    // Hapus field WhatsApp
    function removeField(button) {
        button.parentElement.remove();
    }

    // Preview gambar
    document.getElementById('gambar')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('previewImage').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection