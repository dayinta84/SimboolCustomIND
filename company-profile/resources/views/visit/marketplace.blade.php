@extends('layout.main')
@php use Illuminate\Support\Facades\Storage; @endphp


@section('content')

<style>
    .market-card {
        width: 80%;
        max-width: 420px;
        padding: 25px;
        border-radius: 18px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
        transition: 0.3s ease;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35);
    }

    .market-card:hover {
        transform: translateY(-6px);
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
        border-color: rgba(255, 255, 255, 0.45);
    }

    .market-img {
        max-height: 90px;
        filter: drop-shadow(0 0 5px rgba(255,255,255,0.4));
    }

    .market-btn {
        border-radius: 10px;
        padding: 8px 20px;
        border: 1px solid rgba(255,255,255,0.6);
        transition: 0.25s;
    }

    .market-btn:hover {
        background: rgba(255,255,255,0.9);
        color: #000 !important;
    }
</style>

<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold text-white">Temukan kami di Marketplace dan Sosial Media</h2>

    <div class="row justify-content-center gx-2 gy-4">
        @foreach($marketplaces as $market)
            <div class="col-md-6 col-sm-12 mb-4 d-flex justify-content-center">
                
                <div class="market-card text-center text-white">

                    @if($market->icon && Storage::disk('uploads')->exists($market->icon))
                        <img src="{{ Storage::disk('uploads')->url($market->icon) }}" 
                            class="img-fluid mb-3 market-img"
                            alt="{{ $market->platform }}">
                    @endif

                    <h5 class="fw-bold mb-1">{{ $market->platform }}</h5>

                    @if($market->username)
                        <p class="mb-1">@ {{ $market->username }}</p>
                    @endif

                    @if($market->followers)
                        <p class="small text-light mb-3">{{ $market->followers }} Pengikut</p>
                    @endif

                    @if($market->link)
                        <a href="{{ $market->link }}" target="_blank" 
                           class="btn btn-outline-light market-btn">Kunjungi</a>
                    @endif

                </div>

            </div>
        @endforeach
    </div>
</div>

@endsection
