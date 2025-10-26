@extends('layout.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Hubungi Kami</h1>

    <div class="card shadow-sm p-4">
        <div class="row align-items-center">
            {{-- Gambar Kontak --}}
            @if(!empty($contact->gambar))
                <div class="col-md-4 text-center mb-3 mb-md-0">
                    <img src="{{ asset('storage/' . $contact->gambar) }}" 
                         alt="Gambar Kontak" 
                         class="img-fluid rounded" 
                         style="max-height: 250px; object-fit: cover;">
                </div>
            @endif

            {{-- Info Kontak --}}
            <div class="col-md-8">
               <p> <strong>📞 WhatsApp:</strong>
                    @if(!empty($contact->whatsapp) && is_array($contact->whatsapp))
                    @foreach($contact->whatsapp as $wa)
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $wa) }}"
                    target="_blank"
                    class="text-success text-decoration-none d-block">
                    {{ $wa }}
                    </a>
                    @endforeach
                    @else
                    -
                @endif
            </p>x

            </div>
        </div>
    </div>
</div>
@endsection
