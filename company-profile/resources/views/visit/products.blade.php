@extends('layout.main')

@section('content')

<div class="container mt-5">

    <h2 class="text-center mb-4 fw-bold">TEMUKAN SOLUSI CETAKMU</h2>

    {{-- FILTER KATEGORI --}}
    @php
        $categories = ['Banner', 'Decal', 'Sablon Kaos', 'Sticker', 'Striping'];
        $active = request('category');
    @endphp

    <div class="text-center mb-4">
        <a href="{{ route('products.index') }}" 
           class="mx-2 {{ $active ? '' : 'fw-bold text-primary' }}">
            All
        </a>

        @foreach($categories as $cat)
            <a href="{{ route('products.index', ['category' => $cat]) }}"
                class="mx-2 {{ $active === $cat ? 'fw-bold text-primary' : '' }}">
                {{ $cat }}
            </a>
        @endforeach
    </div>

    {{-- LIST PRODUK --}}
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0">

                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}"
                             class="card-img-top" 
                             style="height:220px; object-fit:cover;">
                    @endif

                    <div class="card-body text-center">
                        <h6 class="fw-bold text-uppercase">{{ $product->name }}</h6>
                        <small class="text-muted d-block">{{ $product->category }}</small>

                        <a href="{{ route('products.show', $product->id) }}" 
                           class="btn btn-outline-dark btn-sm mt-2">
                            Lihat Detail
                        </a>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">
                Tidak ada produk pada kategori ini.
            </div>
        @endforelse
    </div>

</div>

@endsection
