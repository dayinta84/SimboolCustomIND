@extends('layout.main')

@section('content')
<div class="container py-5">

    {{-- Gambar Header --}}
    @if (!empty($contact?->gambar))
        <div class="text-center mb-5">
            <img src="{{ asset('storage/' . $contact->gambar) }}" alt="Gambar Lokasi" class="img-fluid rounded-3 shadow-sm" style="max-height: 300px; object-fit: cover;">
        </div>
    @endif

    {{-- Google Maps --}}
    @if(!empty($contact?->map))
        @php
            $coords = trim((string) $contact->map);
            $embedUrl = 'https://maps.google.com/maps?q=' . urlencode($coords) . '&z=17&output=embed';
        @endphp

        <div class="text-center mb-5">
            <div class="map-wrapper mx-auto rounded-4 shadow"
                style="max-width: 900px; background-color: #343434ff; border: 2px solid #ffffffff; padding: 15px;">

                <h3 class="fw-bold mb-3 text-white">
                    TEMUKAN KAMI DI SINI
                </h3>

                <div class="ratio ratio-16x9 rounded-3 overflow-hidden">
                    <iframe
                        src="{{ $embedUrl }}"
                        style="border:0;"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen>
                    </iframe>
                </div>

            </div>
        </div>
    @endif

    {{-- Informasi Kontak --}}
    <div class="text-center mb-5 mx-auto rounded-4 p-4 shadow"
        style="max-width:900px; background: rgba(102, 51, 153, 0.15); backdrop-filter: blur(6px); border: 1px solid rgba(180, 120, 255, 0.4); color: #ffffff;">
        <div class="row">

            {{-- Alamat --}}
            <div class="col-md-6 mb-3 mb-md-0 border-end" style="border-color: rgba(200, 160, 255, 0.3);">
                <h5 class="fw-bold" style="color: #e0c0ff;">📍 Alamat</h5>
                <p class="mt-2 mb-0" style="white-space:pre-line; color: #f8f8ff; line-height: 1.6;">
                    {{ $contact?->alamat ?? 'Belum ada alamat.' }}
                </p>
            </div>

            {{-- WhatsApp --}}
            <div class="col-md-6 ps-md-4">
                <h5 class="fw-bold" style="color: #e0c0ff;">💬 WhatsApp</h5>

                @if(!empty($contact?->whatsapp))
                    <ul class="list-unstyled mt-2 mb-0">
                        @foreach(($contact->whatsapp ?? []) as $i => $wa)
                            <li class="mb-2">
                                <i class="bi bi-whatsapp me-2" style="color: #00ffcc;"></i>
                                Admin {{ $i + 1 }}:
                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $wa) }}"
                                target="_blank"
                                class="text-decoration-none fw-medium"
                                style="color: #ffffff;">
                                    +{{ $wa }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-light mt-2">Belum ada nomor WhatsApp.</p>
                @endif
            </div>

        </div>
    </div>

    {{-- Footer --}}
    <div class="text-center mt-5">
        <h5 class="fw-bold text-uppercase" style="color: #6a0dad; letter-spacing: 1px; font-size: 1.25rem;">
            SIMBOOL CUSTOM INDUSTRIES
        </h5>
    </div>

</div>
@endsection