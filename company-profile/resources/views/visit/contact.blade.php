@extends('layout.main')

@section('content')
<div class="container py-5">

    @if ($contact->gambar)
    <img src="{{ asset('storage/' . $contact->gambar) }}" alt="Gambar Lokasi" class="img-fluid"></br></br>
    @endif

    {{-- Bagian Map --}}
    @if(!empty($contact->map))
    <div class="text-center mb-5">
        <div class="map-wrapper mx-auto rounded-4 shadow" style="max-width: 900px; background-color: #343434ff; border: 2px solid #ffffffff; padding: 15px;">
            <br><h3 class="fw-bold mb-3 text-white">TEMUKAN KAMI DI SINI</h3></br>
            <div class="ratio ratio-16x9 rounded-3 overflow-hidden">
                {!! $contact->map !!}
            </div>
        </div>
    </div>
    @endif

    {{-- Kotak Informasi --}}
    <div class=" text-center mb-5 contact-box mx-auto rounded-4 p-4 shadow" style="max-width: 900px; background-color: #343434ff; border: 2px solid #ffffffff; color: #ffffff;">
        <div class="row">
            {{-- Kolom Alamat --}}
            <div class="col-md-6 mb-3 mb-md-0 border-end border-light">
                <h5 class="fw-bold text-white">Alamat</h5>
                <p class="mt-2 mb-0" style="white-space: pre-line; color: #f0f0f0;">
                    {{ $contact->alamat ?? 'Belum ada alamat.' }}
                </p>
            </div>

            {{-- Kolom WhatsApp --}}
            <div class="col-md-6 ps-md-4">
                <h5 class="fw-bold text-white">WhatsApp</h5>
                @if(!empty($contact->whatsapp))
                    <ul class="list-unstyled mt-2 mb-0">
                        @foreach($contact->whatsapp as $index => $wa)
                            <li class="mb-2" style="color: #f0f0f0;">
                                <i class="bi bi-whatsapp text-success"></i>
                                Admin {{ $index + 1 }}:
                                <a href="https://wa.me/{{ $wa }}" target="_blank" class="text-white text-decoration-none">
                                    +{{ $wa }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p style="color: #f0f0f0;">Belum ada nomor WhatsApp.</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Footer Nama Perusahaan --}}
    <div class="text-center mt-5">
        <h5 class="fw-bold" style="
            background: linear-gradient(90deg, #a500ff, #ff00aa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 1px;
        ">
            SIMBOOL CUSTOM INDUSTRIES
        </h5>
    </div>
</div>

{{-- Styling tambahan --}}
<style>
    body {
        background-color: #f8fff8;
    }

    .map-wrapper iframe {
        width: 100%;
        height: 400px;
        border: none;
        border-radius: 10px;
    }

    .contact-box {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .contact-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(255, 255, 255, 0.15);
    }
</style>
@endsection
