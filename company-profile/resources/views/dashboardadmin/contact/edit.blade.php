@extends('layout.adminlte')

@section('title', 'Edit Halaman Kontak')

@section('content')
<div class="container mt-5">
    <h2>Edit Kontak</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.contact.updatepage', ['role' => Auth::user()->role]) }}" 
      method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
             <label>Gambar:</label><br> 
             @if(!empty($contact->gambar)) 
             <img src="{{ asset('storage/'.$contact->gambar) }}" width="150" alt="Gambar kontak"><br><br> 
             @endif 
             <input type="file" name="gambar" class="form-control"> 
        </div>

        {{-- Alamat --}}
        <div class="mb-3">
            <label>Alamat:</label>
            <input type="text" name="alamat" value="{{ old('alamat', $contact->alamat ?? '') }}" class="form-control">
        </div>

        {{-- WhatsApp --}}
        <div class="mb-3">
            <label class="form-label fw-bold">WhatsApp</label>

            <div id="whatsapp-container">
                @php
                    // Jika data sudah di-cast ke array di model
                    $whatsapps = $contact->whatsapp ?? [''];
                @endphp

                @foreach($whatsapps as $wa)
                    <div class="d-flex align-items-center mb-2">
                        <input type="text" name="whatsapp[]" class="form-control me-2"
                               value="{{ $wa }}" placeholder="0877xxxxxxx"
                                maxlength="13" pattern="[0-9]{10,13}"
                                title="Nomor harus terdiri dari 10–13 digit angka">
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeField(this)">Hapus</button>
                    </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-success btn-sm mt-2" onclick="addField()">Tambah Nomor</button>
        </div>

        {{-- Google Maps --}}
        <div class="mb-3">
            <label for="map" class="form-label">Link Google Maps:</label>
            <input type="text" name="map" id="map"
                value="{{ $contact->map ?? '' }}"
                class="form-control"
                placeholder="Masukkan link Google Maps (contoh: https://www.google.com/maps/place/...)">
            <small class="text-muted">
                Cukup masukkan link Google Maps biasa, bukan link embed.
            </small>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

{{-- Script tambah/hapus field --}}
<script>
    function addField() {
        const container = document.getElementById('whatsapp-container');
        const div = document.createElement('div');
        div.classList.add('d-flex', 'align-items-center', 'mb-2');
        div.innerHTML = `
            <input type="text" name="whatsapp[]" class="form-control me-2" placeholder="0877xxxxxxx">
            <button type="button" class="btn btn-danger btn-sm" onclick="removeField(this)">Hapus</button>
        `;
        container.appendChild(div);
    }

    function removeField(button) {
        button.parentElement.remove();
    }
</script>
@endsection
