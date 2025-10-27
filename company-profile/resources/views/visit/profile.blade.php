@extends('layout.main') {{-- atau layouts/main.blade.php kalau kamu pakai frontend layout --}}
@section('title', 'Profil Perusahaan')

@section('content')
<section class="py-5 container">
    {{-- Header Profil --}}
    <div class="text-center mb-4">
        @if($profil->image)
            <img src="{{ asset('storage/' . $profil->image) }}" alt="Profil" class="rounded mb-3" style="max-height:200px;">
        @endif
        <h2>{{ $profil->title }}</h2>
    </div>

    {{-- Tentang --}}
    <div class="mb-4">
        <h4>Tentang Kami</h4>
        <p>{{ $profil->tentang }}</p>
    </div>

    {{-- Visi & Misi --}}
    <div class="row mb-5">
        <div class="col-md-6">
            <h4>Visi</h4>
            <p>{{ $profil->visi }}</p>
        </div>
        <div class="col-md-6">
            <h4>Misi</h4>
            <p>{{ $profil->misi }}</p>
        </div>
    </div>

    {{-- Layanan Kami --}}
    <div class="text-center mb-5">
        <h3>LAYANAN KAMI</h3>
        <div class="row justify-content-center mt-4">
            @foreach($layanans as $layanan)
                <div class="col-md-3 mb-3">
                    <div class="card h-100 p-3 shadow-sm">
                        <h5 class="fw-bold">{{ $layanan->judul_layanan }}</h5>
                        <p>{{ $layanan->deskripsi }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Section Tambahan --}}
    @foreach($sections as $sec)
        <div class="mb-5">
            <h4>{{ strtoupper($sec->judul) }}</h4>
            <p>{{ $sec->isi }}</p>
        </div>
    @endforeach
</section>
@endsection
