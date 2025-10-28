@extends('layout.main')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold text-white">Temukan kami di Marketplace dan Sosial Media</h2>

    <div class="row justify-content-center gx-2 gy-4">
        @foreach($marketplaces as $market)
            <div class="col-md-6 col-sm-12 mb-4 d-flex justify-content-center">
                <div class="card text-center shadow-sm p-4" 
                     style="width: 80%; max-width: 400px; border-radius: 15px; background-color: #2a2929ff; border: 2px solid #fff;">
                    <div class="card-body text-white">
                        @if($market->icon)
                            <img src="{{ asset('storage/' . $market->icon) }}" 
                                 alt="{{ $market->platform }}" 
                                 class="img-fluid mb-3" 
                                 style="max-height: 90px;">
                        @endif

                        <h5 class="card-title fw-bold text-white">{{ $market->platform }}</h5>

                        @if($market->username)
                            <p class="mb-1 text-white">@ {{ $market->username }}</p>
                        @endif

                        @if($market->followers)
                            <p class="small text-light mb-1">{{ $market->followers }} Pengikut</p>
                        @endif

                        @if($market->link)
                            <a href="{{ $market->link }}" target="_blank" 
                               class="btn btn-outline-light btn-sm px-4">Kunjungi</a>
                        @endif  
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
