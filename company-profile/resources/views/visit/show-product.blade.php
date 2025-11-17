@extends('layout.main')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-body">

            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" 
                     class="img-fluid rounded mb-3">
            @endif

            <h3 class="fw-bold">{{ $product->name }}</h3>
            <p><strong>Kategori:</strong> {{ $product->category }}</p>

            <p>{{ $product->description }}</p>

            <a href="{{ route('products.index') }}" 
               class="btn btn-secondary mt-3">Kembali</a>

        </div>
    </div>

</div>

@endsection
