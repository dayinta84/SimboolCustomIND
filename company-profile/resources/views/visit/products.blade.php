@extends('layout.main')

@section('content')

<style>
    h3.text-center.mb-4.fw-bold {
        color: white;
        font-weight: 800;
        letter-spacing: 1px;
    }

    .product-card {
        background: rgba(0,0,0,0.12);
        backdrop-filter: blur(4px);
        border: 1px solid rgba(255,255,255,0.2); /* GARIS PUTIH TIPIS */
        border-radius: 16px;
        overflow: hidden;
        transition: .25s ease;
    }

    .product-card:hover {
        background: rgba(0,0,0,0.20);
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,.15);
    }

    .card-img-top {
        height: 180px;
        object-fit: cover;
    }

    /* TEXT PUTIH */
    .product-name {
        font-size: 14px;
        font-weight: 600;
        color: #ffffff;
    }

    .product-category {
        font-size: 11px;
        color: #e2e2e2;
    }

    /* BUTTON PUTIH */
    .btn-detail {
        font-size: 11px;
        padding: 5px 12px;
        border-radius: 8px;
        color: #ffffff;
        border: 1px solid rgba(255,255,255,0.5);
        background: transparent;
    }

    .btn-detail:hover {
        background: rgba(255,255,255,0.15);
        color: #ffffff;
        border-color: #ffffff;
    }

    /* BADGE FILTER (All & Kategori) */
    .category-pill {
        font-size: 12px;
        font-weight: 500;
        padding: 5px 12px;
        transition: all 0.2s ease;
    }

    .category-pill.bg-primary {
        background: #7D3C98 !important;
        color: white !important;
        border: none;
    }

    .category-pill.bg-light {
        background: rgba(255,255,255,0.15) !important;
        color: white !important;
        border: 1px solid rgba(255,255,255,0.3);
    }

    .category-pill:hover {
        transform: scale(1.05);
    }
</style>


<div class="container py-4">

    <h3 class="text-center mb-4 fw-bold">TEMUKAN SOLUSI CETAKMU</h3>

    {{-- FILTER KATEGORI --}}
    @php
    $active = request('category');
@endphp

<div class="text-center mb-4">
    <a href="{{ route('products.index') }}"
       class="badge category-pill rounded-pill px-3 py-2 mx-1
       {{ $active ? 'bg-light text-dark' : 'bg-primary text-white border-0' }}">
        All
    </a>

    @foreach($categories as $cat)
        <a href="{{ route('products.index', ['category' => $cat]) }}"
           class="badge category-pill rounded-pill px-3 py-2 mx-1
           {{ $active === $cat ? 'bg-primary text-white border-0' : 'bg-light text-dark' }}">
            {{ $cat }}
        </a>
    @endforeach
</div>



    {{-- LIST PRODUK --}}
    <div class="row g-3">
        @forelse($products as $product)
            <div class="col-6 col-md-3">
                <div class="card product-card shadow-sm h-100">

                    {{-- GAMBAR --}}
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}"
                             class="card-img-top">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center"
                             style="height:180px;">
                            <span class="text-muted small">No Image</span>
                        </div>
                    @endif

                    {{-- BODY --}}
                    <div class="card-body text-center p-2">

                        {{-- NAMA PRODUK (PUTIH) --}}
                        <h6 class="product-name text-uppercase mb-1">
                            {{ $product->name }}
                        </h6>

                        {{-- KATEGORI (PUTIH MUDA) --}}
                        <small class="product-category d-block mb-1">
                            {{ $product->category }}
                        </small>

                        {{-- BUTTON DETAIL (PUTIH) --}}
                        <a href="{{ route('products.show', $product->id) }}"
                        class="btn-detail mt-1 d-inline-block">
                            Detail
                        </a>

                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">
                Tidak ada produk untuk kategori ini.
            </div>
        @endforelse
    </div>

</div>

@endsection
