@extends('layout.main')
@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')

<style>
/* SEMI TRANSPARAN CARD */
.detail-card {
    max-width: 900px;
    margin: auto;
    border-radius: 16px;
    background: rgba(255,255,255,0.12);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.25);
    position: relative;
}

/* TOMBOL KEMBALI DI POJOK KIRI ATAS CARD PERTAMA */
.back-btn {
    position: absolute;
    top: 12px;
    left: 12px;
    background: rgba(0,0,0,0.45);
    backdrop-filter: blur(5px);
    border: none;
    color: #fff;
    font-size: 18px;
    padding: 6px 10px;
    border-radius: 8px;
    transition: .2s ease;
    z-index: 10;
    text-decoration: none;
}

.back-btn:hover {
    background: rgba(0,0,0,0.7);
}

/* GAMBAR */
.detail-img {
    width: 100%;
    max-height: 350px;
    object-fit: cover;
    border-radius: 14px;
}

/* TEXT STYLING (PUTIH) */
.product-title {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 5px;
    color: white;
}

.product-category {
    color: #e5e5e5;
    font-size: 13px;
    margin-bottom: 0;
}

.product-desc {
    font-size: 14px;
    line-height: 1.6;
    color: white;
}

.desc-title {
    color: white;
}

/* JARAK DARI FOOTER */
.content-wrapper {
    padding-bottom: 100px; /* Bisa disesuaikan sesuai tinggi footer */
}
</style>

<div class="container mt-4 content-wrapper">

    {{-- BOX 1 : GAMBAR + JUDUL --}}
    <div class="card shadow-sm detail-card p-3 mb-3">

        {{-- TOMBOL KEMBALI --}}
        <a href="{{ route('products.index') }}" class="back-btn">
            <i class="bi bi-arrow-left"></i>
        </a>

        @if($product->image && Storage::disk('uploads')->exists($product->image))
            <img src="{{ Storage::disk('uploads')->url($product->image) }}" class="detail-img mb-3">
        @endif

        <h3 class="product-title">{{ $product->name }}</h3>
        <p class="product-category">
            <strong>Kategori:</strong> {{ $product->category }}
        </p>

    </div>

    {{-- BOX 2 : DESKRIPSI --}}
    <div class="card shadow-sm detail-card p-3">

        <h5 class="fw-bold mb-2 desc-title">Deskripsi Produk</h5>

        <div class="product-desc">
            {!! $product->description !!}
        </div>

    </div>

</div>

@endsection
