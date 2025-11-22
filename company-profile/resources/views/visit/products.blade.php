@extends('layout.main')

@section('content')

<style>
    .product-card {
        transition: .25s ease;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
    }
    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 18px rgba(0,0,0,.15);
    }

    .category-pill {
        font-size: 13px;
        cursor: pointer;
        border: 1px solid #dcdcdc;
        transition: .2s;
    }
    .category-pill:hover {
        opacity: .85;
    }

    .card-img-top {
        border-bottom: 1px solid #eee;
    }
</style>

<div class="container py-4">

    <h3 class="text-center mb-4 fw-bold">TEMUKAN SOLUSI CETAKMU</h3>

    {{-- FILTER KATEGORI --}}
    @php
        $categories = ['Banner', 'Decal', 'Sablon Kaos', 'Sticker', 'Striping'];
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
                             class="card-img-top"
                             style="height:170px; object-fit:cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center"
                             style="height:170px;">
                            <span class="text-muted small">No Image</span>
                        </div>
                    @endif

                    {{-- BODY --}}
                    <div class="card-body text-center p-2">
                        <h6 class="fw-bold text-uppercase mb-1" style="font-size: 13px;">
                            {{ $product->name }}
                        </h6>
                        <small class="text-muted d-block mb-1" style="font-size: 11px;">
                            {{ $product->category }}
                        </small>

                        <a href="{{ route('products.show', $product->id) }}"
                        class="btn btn-outline-dark btn-sm mt-1"
                        style="font-size: 11px; padding: 4px 10px;">
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
