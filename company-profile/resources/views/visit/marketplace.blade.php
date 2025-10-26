@extends('layout.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Marketplace Kami</h2>

    <div class="row justify-content-center">
        @foreach($marketplaces as $market)
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card text-center shadow-sm border-0">
                    <div class="card-body">
                        @if($market->icon)
                            <img src="{{ asset('storage/' . $market->icon) }}" alt="{{ $market->platform }}" class="img-fluid mb-3" style="max-height: 80px;">
                        @endif
                        <h5 class="card-title">{{ $market->platform }}</h5>
                        @if($market->username)
                            <p class="mb-1 text-muted">@ {{ $market->username }}</p>
                        @endif
                        @if($market->followers)
                            <p class="small text-secondary">Followers: {{ $market->followers }}</p>
                        @endif
                        @if($market->description)
                            <p class="small">{{ $market->description }}</p>
                        @endif
                        @if($market->link)
                            <a href="{{ $market->link }}" target="_blank" class="btn btn-outline-primary btn-sm">Kunjungi</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
