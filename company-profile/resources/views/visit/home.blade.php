@extends('layout.main')

@section('content')

<style>
    :root {
        --primary-purple: #7D3C98;
        --dark-bg: #212121;
        --light-bg: #F7F9FC;
        --shadow-color: rgba(125, 60, 152, 0.4);
    }

    body {
        background-color: var(--light-bg);
        color: #343a40;
        font-family: 'Poppins', sans-serif;
    }

    /* ==== HERO WRAPPER (FULLSCREEN – DARI KODE 2) ==== */
    .hero-banner {
        position: relative;
        width: 100%;
        height: 100vh;
        overflow: hidden;
    }

    /* ==== GAMBAR SLIDER ==== */
    .swiper-slide img {
        width: 100%;
        height: 100vh;
        object-fit: cover;
        object-position: center;
        filter: brightness(70%);
    }

    /* ==== TEXT SLIDER ==== */
    .hero-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
        z-index: 20;
        width: 100%;
        padding: 0 20px;
        text-transform: uppercase;
    }

    .hero-text h1 {
        font-size: 55px;
        font-weight: 900;
        letter-spacing: 3px;
        text-shadow: 0 6px 20px rgba(0, 0, 0, 1);
    }

    .hero-text h3 {
        font-size: 24px;
        margin-top: 10px;
        font-weight: 600;
        text-shadow: 0 4px 12px rgba(0,0,0,.7);
    }

    @media(max-width: 768px) {
        .hero-text h1 { font-size: 35px; }
        .hero-text h3 { font-size: 18px; }
    }

    /* ==== STYLE LAIN DARI KODE 1 (TIDAK DIUBAH) ==== */
    .section-title {
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 70px;
        font-size: 36px;
        font-weight: 800;
        color: var(--dark-bg);
    }

    .section-title::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        width: 100px;
        height: 5px;
        background-color: var(--primary-purple);
        border-radius: 3px;
    }

    .dynamic-card {
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        border: 1px solid #e0e0e0;
        overflow: hidden;
        border-radius: 18px;
        background-color: #ffffff;
    }

    .dynamic-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px var(--shadow-color);
    }
</style>

<div class="container-fluid px-0">

    {{-- ============================
         HERO FULLSCREEN SLIDER
    ============================= --}}
    <div class="hero-banner">

        <div class="hero-text">
            <h1>{{ $content->title ?? 'Solusi Cetak Terbaik' }}</h1>
            <h3>{{ $content->subtitle ?? 'Cepat, Berkualitas, dan Terpercaya' }}</h3>
        </div>

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

                @forelse($sliders as $slide)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/'.$slide->image) }}" alt="Slider Image">
                    </div>
                @empty
                    <div class="swiper-slide">
                        <img src="https://via.placeholder.com/1600x900?text=No+Slider" alt="">
                    </div>
                @endforelse

            </div>

            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

        </div>
    </div>

</div>


{{-- ============================================================
     SOLUSI CETAK MU (DARI KODE 1 - TIDAK DIUBAH)
=============================================================== --}}
<div class="container py-5 my-5">
    <h3 class="text-center section-title" style="color: var(--primary-purple);">TEMUKAN SOLUSI CETAKMU</h3>

    @php
        $categories = ['Banner', 'Decal', 'Sablon Kaos', 'Sticker', 'Striping'];
    @endphp

    <div class="row justify-content-center g-5 mt-4">
        @foreach($categories as $cat)
            @php
                $product = \App\Models\Product::where('category', $cat)->first();
                $image = $product ? asset('storage/'.$product->image) : 'https://via.placeholder.com/300x180?text=Produk+Segera+Hadir';
            @endphp

            <div class="col-6 col-sm-4 col-md-2 mb-3">
                <a href="{{ route('products.index', ['category' => $cat]) }}" class="text-decoration-none d-block h-100">
                    <div class="card dynamic-card text-center shadow-lg h-100 p-0">
                        <div class="card-img-top">
                            <img src="{{ $image }}" 
                                 alt="{{ $cat }}" 
                                 class="img-fluid"
                                 style="height: 140px; width: 100%; object-fit: cover; border-radius: 17px 17px 0 0;">
                        </div>
                        <div class="card-body py-3">
                            <h5 class="fw-bold mb-0" style="font-size: 17px; color: var(--dark-bg);">
                                {{ $cat }}
                            </h5>
                        </div>
                    </div>
                </a>
            </div>

        @endforeach
    </div>


    {{-- ============================================================
         MENGAPA KAMI (TIDAK DIUBAH)
    =============================================================== --}}
    <div class="mt-5 pt-5 text-white" style="background-color: var(--dark-bg); margin: 0 -15px; padding: 80px 15px; border-radius: 20px;">
        <h3 class="text-center section-title" style="color: white;">MENGAPA KAMI PILIHAN TEPAT</h3>

        <style>
            .section-title[style*="color: white"]::after {
                background-color: white !important;
            }
        </style>

        <div class="row mt-5 justify-content-center g-5">
            @if($content)
                <div class="col-md-4">
                    <div class="card dynamic-card text-center p-4 h-100 shadow-lg"
                         style="border-radius: 20px; background-color: #343434; color: white;">
                        <h4 class="fw-bold mb-3" style="color: #ffc107;">
                            <i class="bi bi-gear-fill me-2"></i>{{ $content->why_1_title }}
                        </h4>
                        <p class="mb-0 text-white-50">{{ $content->why_1_desc }}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card dynamic-card text-center p-4 h-100 shadow-lg"
                         style="border-radius: 20px; background-color: #343434; color: white;">
                        <h4 class="fw-bold mb-3" style="color: #ffc107;">
                            <i class="bi bi-clock-history me-2"></i>{{ $content->why_2_title }}
                        </h4>
                        <p class="mb-0 text-white-50">{{ $content->why_2_desc }}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card dynamic-card text-center p-4 h-100 shadow-lg"
                         style="border-radius: 20px; background-color: #343434; color: white;">
                        <h4 class="fw-bold mb-3" style="color: #ffc107;">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ $content->why_3_title }}
                        </h4>
                        <p class="mb-0 text-white-50">{{ $content->why_3_desc }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>


    {{-- ============================================================
         TENTANG KAMI (TIDAK DIUBAH)
    =============================================================== --}}
    <div class="mt-5 pt-5">
        <h3 class="text-center section-title">TENTANG KAMI</h3>

        <div class="row align-items-center g-5 mt-4">
            @if(isset($profil->image_tentang) && $profil->image_tentang)
                <div class="col-md-6 text-center">
                    <img src="{{ asset('storage/' . $profil->image_tentang) }}"
                         alt="Tentang Kami"
                         class="img-fluid rounded-4 shadow-lg"
                         style="max-height: 400px; width: 100%; object-fit: cover;">
                </div>
            @endif

            <div class="col-md-6">
                <p class="lead"
                   style="white-space: pre-line; text-align: justify; border-left: 5px solid var(--primary-purple); padding-left: 20px;">
                    {{ $profil->tentang }}
                </p>

                <div class="row g-3 mt-4">
                    <div class="col-sm-6">
                        <div class="p-4 rounded-3 dynamic-card">
                            <h5 class="fw-bold mb-1" style="color: var(--primary-purple);">
                                <i class="bi bi-eye-fill me-2"></i>VISI
                            </h5>
                            <small class="text-muted">{{ $profil->visi }}</small>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="p-4 rounded-3 dynamic-card">
                            <h5 class="fw-bold mb-1" style="color: var(--primary-purple);">
                                <i class="bi bi-bullseye me-2"></i>MISI
                            </h5>
                            <small class="text-muted">{{ $profil->misi }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ============================================================
         MARKETPLACE KAMI (TIDAK DIUBAH)
    =============================================================== --}}
    <div class="mt-5 pt-5">
        <h3 class="text-center section-title">MARKETPLACE KAMI</h3>

        <div class="row justify-content-center g-4 mt-5">
            @foreach($marketplaces as $market)
                @php
                    $image = $market->icon ? asset('storage/' . $market->icon) : 'https://via.placeholder.com/80x80?text=M';
                    $url = $market->link ?? '#';
                @endphp

                <div class="col-4 col-sm-3 col-md-2 text-center">
                    <a href="{{ $url }}" target="_blank" class="text-decoration-none d-block">
                        <div class="dynamic-card p-3 shadow-sm rounded-3 h-100 marketplace-card"
                             style="border: 1px solid #dee2e6;">
                            <img src="{{ $image }}" alt="{{ $market->platform }}"
                                 class="img-fluid mx-auto"
                                 style="max-height: 70px; width: auto; object-fit: contain;">
                            <div class="mt-2">
                                <small class="text-dark fw-semibold">{{ $market->platform }}</small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>


    {{-- ============================================================
         KONTAK KAMI (TIDAK DIUBAH)
    =============================================================== --}}
    <div class="mt-5 pt-5">
        <h3 class="text-center section-title">HUBUNGI KAMI SEKARANG</h3>

        <div class="mb-5 mx-auto contact-box-modern text-center" style="max-width: 900px;">
            <div class="row">

                <div class="col-md-6 mb-4 mb-md-0 border-end border-light separator pe-md-4">
                    <h4 class="fw-bold mb-3"><i class="bi bi-geo-alt-fill me-2"></i>Alamat Workshop</h4>
                    <p class="mb-0" style="white-space: pre-line;">
                        {{ $contact->alamat ?? 'Belum ada alamat.' }}
                    </p>
                </div>

                <div class="col-md-6 ps-md-4">
                    <h4 class="fw-bold mb-3"><i class="bi bi-whatsapp me-2"></i>Admin WhatsApp</h4>
                    @if(!empty($contact->whatsapp))
                        <ul class="list-unstyled mb-0">
                            @foreach($contact->whatsapp as $index => $wa)
                                <li class="mb-2">
                                    Admin {{ $index + 1 }}:
                                    <a href="https://wa.me/{{ $wa }}" target="_blank" class="text-decoration-none">
                                        +{{ $wa }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Belum ada nomor WhatsApp.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>

</div>


{{-- ==== SWIPER JS ==== --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        speed: 800,
        effect: "slide",
    });
</script>

@endsection
