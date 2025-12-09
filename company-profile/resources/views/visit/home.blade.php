@extends('layout.main')

@section('content')

<style>
    :root {
        --primary-purple: #7D3C98;
        --dark-bg: #212121;
        --light-bg: #F7F9FC;
        --shadow-color: rgba(125, 60, 152, 0.3);
        --text-dark: #343a40;
        --card-radius: 18px;
    }

    body {
        background-color: var(--light-bg);
        color: var(--text-dark);
        font-family: 'Poppins', sans-serif;
    }

    /* === HERO SECTION === */
    .hero-banner {
        position: relative;
        width: 100%;
        height: 100vh;
        overflow: hidden;
    }

    .hero-banner .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.6);
    }

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
        max-width: 900px;
    }

    .hero-text h1 {
        font-size: 3.5rem;
        font-weight: 900;
        letter-spacing: 2px;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.8);
        line-height: 1.2;
    }

    .hero-text h3 {
        font-size: 1.5rem;
        font-weight: 600;
        text-shadow: 0 2px 10px rgba(0,0,0,.7);
        margin-top: 1rem;
    }

    /* Responsif hero text */
    @media (max-width: 768px) {
        .hero-text h1 { font-size: 2.2rem; }
        .hero-text h3 { font-size: 1.2rem; }
    }

    /* === GENERAL STYLING === */
    .section-title {
        position: relative;
        font-size: 2.25rem;
        font-weight: 800;
        color: var(--primary-purple);
        text-align: center;
        margin: 4rem 0 3rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: -10px;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background-color: var(--primary-purple);
        border-radius: 2px;
    }

    /* Dark section override */
    .dark-section .section-title {
        color: white;
    }

    .dark-section .section-title::after {
        background-color: white !important;
    }

    .dynamic-card {
        transition: transform 0.4s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: var(--card-radius);
        background: white;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .dynamic-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px var(--shadow-color);
    }

    /* === CATEGORY CARDS === */
    .category-card img {
        height: 140px;
        object-fit: cover;
        border-radius: var(--card-radius) var(--card-radius) 0 0;
    }

    /* === WHY US SECTION === */
    .why-card {
        background: #2c2c2c;
        color: white;
        border-radius: var(--card-radius);
        padding: 1.5rem;
        height: 100%;
        box-shadow: none;
    }

    .why-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    }

    /* === ABOUT SECTION === */
    .about-text {
        white-space: pre-line;
        text-align: justify;
        border-left: 4px solid var(--primary-purple);
        padding-left: 1.5rem;
        font-size: 1.05rem;
        line-height: 1.7;
    }

    /* === MARKETPLACE === */
    .marketplace-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1.25rem;
        height: 100%;
    }

    .marketplace-card img {
        max-height: 60px;
        margin-bottom: 0.75rem;
    }

    /* === CONTACT SECTION === */
    .contact-box-modern {
        background: white;
        padding: 2.5rem;
        border-radius: var(--card-radius);
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    }

    .separator {
        border-right: 1px solid #e0e0e0 !important;
    }

    @media (max-width: 768px) {
        .separator {
            border-right: none !important;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }
    }
</style>

<div class="container-fluid px-0">
    {{-- HERO SLIDER --}}
    <div class="hero-banner">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @forelse($sliders as $slide)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/'.$slide->image) }}" alt="Slider Image">
                    </div>
                @empty
                    <div class="swiper-slide">
                        <img src="https://via.placeholder.com/1600x900?text=No+Slider" alt="Placeholder">
                    </div>
                @endforelse
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="hero-text">
            <h1>{{ $content->title ?? 'Solusi Cetak Terbaik' }}</h1>
            <h3>{{ $content->subtitle ?? 'Cepat, Berkualitas, dan Terpercaya' }}</h3>
        </div>
    </div>
</div>

<div class="container py-5 my-5">

    {{-- SOLUSI CETAKMU --}}
    <h3 class="section-title">TEMUKAN SOLUSI CETAKMU</h3>
    <div class="row justify-content-center g-4">
        @php
            $categories = ['Banner', 'Decal', 'Sablon Kaos', 'Sticker', 'Striping'];
        @endphp
        @foreach($categories as $cat)
            @php
                $product = \App\Models\Product::where('category', $cat)->first();
                $image = $product ? asset('storage/'.$product->image) : 'https://via.placeholder.com/300x180?text=Coming+Soon';
            @endphp
            <div class="col-6 col-sm-4 col-md-2">
                <a href="{{ route('products.index', ['category' => $cat]) }}" class="text-decoration-none">
                    <div class="dynamic-card text-center h-100">
                        <img src="{{ $image }}" alt="{{ $cat }}" class="category-card img-fluid w-100">
                        <div class="card-body py-3">
                            <h5 class="fw-bold mb-0" style="font-size: 16px;">{{ $cat }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    {{-- MENGAPA KAMI --}}
    <div class="mt-5 pt-5">
        <h3 class="section-title">MENGAPA KAMI PILIHAN TEPAT</h3>

        @if(isset($whys) && $whys->count())
            <div class="swiper whySwiper mt-4">
                <div class="swiper-wrapper">
                    @foreach($whys as $why)
                        <div class="swiper-slide d-flex justify-content-center">
                            <div class="dynamic-card p-4 text-center"
                                style="width: 100%; max-width: 320px;">
                                <h4 class="fw-bold mb-3" style="color: var(--primary-purple);">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    {{ $why->title }}
                                </h4>
                                <p class="text-muted mb-0" style="font-size: 0.95rem; line-height: 1.6;">
                                    {{ $why->description }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination mt-4"></div>
            </div>
        @else
            <p class="text-center text-muted">Belum ada data "Mengapa Kami".</p>
        @endif
    </div>

    {{-- Perbaiki script Swiper di bawah --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.querySelector('.whySwiper')) {
                new Swiper('.whySwiper', {
                    loop: true,
                    autoplay: {
                        delay: 3500,
                        disableOnInteraction: false,
                    },
                    spaceBetween: 24,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        320: { slidesPerView: 1.1, spaceBetween: 12 },
                        480: { slidesPerView: 1.4, spaceBetween: 16 },
                        640: { slidesPerView: 2, spaceBetween: 20 },
                        992: { slidesPerView: 3, spaceBetween: 24 }
                    },
                    speed: 700,
                });
            }
        });
    </script>


    {{-- TENTANG KAMI --}}
    <div class="mt-5 pt-5">
        <h3 class="section-title">TENTANG KAMI</h3>
        <div class="row align-items-center g-4">
            @if(isset($profil->image_tentang))
                <div class="col-md-6 text-center">
                    <img src="{{ asset('storage/' . $profil->image_tentang) }}" 
                         alt="Tentang Kami" 
                         class="img-fluid rounded-4 shadow" 
                         style="max-height: 400px; object-fit: cover;">
                </div>
            @endif
            <div class="col-md-6">
                <p class="about-text">{{ $profil->tentang }}</p>
                <div class="row g-3 mt-3">
                    <div class="col-12">
                        <div class="dynamic-card p-3">
                            <h5 class="fw-bold" style="color: var(--primary-purple);">
                                <i class="bi bi-eye-fill me-2"></i>VISI
                            </h5>
                            <small class="text-muted">{{ $profil->visi }}</small>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="dynamic-card p-3">
                            <h5 class="fw-bold" style="color: var(--primary-purple);">
                                <i class="bi bi-bullseye me-2"></i>MISI
                            </h5>
                            <small class="text-muted">{{ $profil->misi }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MARKETPLACE KAMI --}}
    <div class="mt-5 pt-5">
        <h3 class="section-title">MARKETPLACE KAMI</h3>
        <div class="row justify-content-center g-4">
            @foreach($marketplaces as $market)
                @php
                    $image = $market->icon ? asset('storage/' . $market->icon) : 'https://via.placeholder.com/80x80?text=M';
                    $url = $market->link ?? '#';
                @endphp
                <div class="col-4 col-sm-3 col-md-2">
                    <a href="{{ $url }}" target="_blank" class="text-decoration-none">
                        <div class="dynamic-card marketplace-card">
                            <img src="{{ $image }}" alt="{{ $market->platform }}">
                            <small class="fw-semibold">{{ $market->platform }}</small>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    {{-- KONTAK KAMI --}}
    <div class="mt-5 pt-5">
        <h3 class="section-title">HUBUNGI KAMI SEKARANG</h3>
        <div class="contact-box-modern mx-auto">
            <div class="row g-4">
                <div class="col-md-6 text-center text-md-start separator">
                    <h4 class="fw-bold"><i class="bi bi-geo-alt-fill me-2"></i>Alamat Workshop</h4>
                    <p class="mb-0">{{ $contact->alamat ?? 'Belum ada alamat.' }}</p>
                </div>
                <div class="col-md-6 text-center text-md-start">
                    <h4 class="fw-bold"><i class="bi bi-whatsapp me-2"></i>Admin WhatsApp</h4>
                    @if(!empty($contact->whatsapp))
                        <ul class="list-unstyled">
                            @foreach($contact->whatsapp as $index => $wa)
                                <li class="mb-2">
                                    Admin {{ $index + 1 }}:
                                    <a href="https://wa.me/{{ $wa }}" target="_blank" class="text-decoration-none text-primary">
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

{{-- SWIPER JS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    new Swiper(".mySwiper", {
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        speed: 900,
        effect: "fade",
        fadeEffect: {
            crossFade: true
        }
    });
</script>

@endsection