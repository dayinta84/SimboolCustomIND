@extends('layout.main')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')

<style>
    :root {
        --primary-purple: #7D3C98;
        --accent-pink: #f472ff;
        --dark-bg: #0b0b12;
        --dark-card-1: rgba(30, 30, 45, 0.92);
        --dark-card-2: rgba(20, 20, 35, 0.92);
        --border-glow: rgba(168, 85, 247, 0.25);
        --border-glow-strong: rgba(168, 85, 247, 0.6);
        --text-soft: #d1d5db;
        --text-white: #e5e7eb;
        --card-radius: 18px;
    }

    body {
        color: var(--text-white);
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
        color: #f3f4f6;
    }

    @media (max-width: 768px) {
        .hero-text h1 { font-size: 2.2rem; }
        .hero-text h3 { font-size: 1.2rem; }
    }

    /* === SECTION TITLE === */
    .section-title {
        position: relative;
        font-size: 2.25rem;
        font-weight: 900;
        text-align: center;
        margin: 4rem 0 3rem;

        background: linear-gradient(90deg, #ff4fd8, #a855f7);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 0 10px rgba(168, 85, 247, 0.35);
        letter-spacing: 2px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: -12px;
        transform: translateX(-50%);
        width: 90px;
        height: 4px;
        background: linear-gradient(90deg, #ff4fd8, #a855f7);
        border-radius: 2px;
    }

    /* === DARK GLASS CARD (GLOBAL) === */
    .dark-card {
        background: linear-gradient(145deg, var(--dark-card-1), var(--dark-card-2));
        border: 1px solid var(--border-glow);
        border-radius: var(--card-radius);
        color: var(--text-white);
        box-shadow: 0 10px 26px rgba(0,0,0,0.35);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .dark-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 34px rgba(168, 85, 247, 0.20);
        border-color: var(--border-glow-strong);
    }

    .dark-card h4, .dark-card h5 {
        color: var(--accent-pink);
        text-shadow: 0 0 10px rgba(168, 85, 247, 0.45);
        letter-spacing: 1px;
    }

    .dark-card p, .dark-card small, .dark-card li {
        color: var(--text-soft);
    }

    /* === CATEGORY CARDS (SOLUSI CETAKMU) === */
    .category-card img {
        height: 140px;
        object-fit: cover;
        border-radius: var(--card-radius) var(--card-radius) 0 0;
    }

    .category-box {
        text-align: center;
        height: 100%;
    }

    .category-box .card-body h5 {
        color: var(--text-white);
    }

    /* === WHY SWIPER CARD (PERBAIKI: jangan white) === */
    .whySwiper .dynamic-card {
        background: linear-gradient(145deg, var(--dark-card-1), var(--dark-card-2));
        border: 1px solid var(--border-glow);
        border-radius: var(--card-radius);
        box-shadow: 0 10px 26px rgba(0,0,0,0.35);
        transition: all 0.3s ease;
    }
    .whySwiper .dynamic-card:hover {
        transform: translateY(-6px);
        border-color: var(--border-glow-strong);
        box-shadow: 0 14px 34px rgba(168, 85, 247, 0.2);
    }
    .whySwiper .dynamic-card p { color: var(--text-soft) !important; }
    .whySwiper .dynamic-card h4 { color: var(--accent-pink) !important; }

    /* === ABOUT TEXT === */
    .about-text {
        white-space: pre-line;
        text-align: justify;
        border-left: 4px solid #a855f7;
        padding-left: 1.5rem;
        font-size: 1.05rem;
        line-height: 1.7;
        color: var(--text-soft);
    }

    /* Visi / Misi card kecil di about */
    .mini-info-card {
        padding: 14px 16px;
    }
    .mini-info-card small { color: var(--text-soft) !important; }

    /* === MARKETPLACE === */
    .marketplace-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1.25rem;
        height: 100%;
        text-align: center;
    }

    .marketplace-card img {
        max-height: 60px;
        margin-bottom: 0.75rem;
        filter: drop-shadow(0 8px 18px rgba(0,0,0,0.35));
    }

    /* === CONTACT SECTION (FIX: jangan putih, jadikan dark, rapihin layout) === */
    .contact-box-modern {
        padding: 2rem;
    }

    .contact-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        align-items: start;
    }

    @media (max-width: 768px) {
        .contact-row {
            grid-template-columns: 1fr;
        }
    }

    .contact-item {
        padding: 18px 18px;
        border-radius: 14px;
        border: 1px solid rgba(255,255,255,0.06);
        background: rgba(255,255,255,0.02);
    }

    .contact-item h4 {
        margin-bottom: 10px;
        font-weight: 800;
    }

    .wa-list a {
        color: #93c5fd;
        text-decoration: none;
    }
    .wa-list a:hover {
        text-decoration: underline;
    }

</style>

<div class="container-fluid px-0">
    {{-- HERO SLIDER --}}
    <div class="hero-banner">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @forelse($sliders as $slide)
                    <div class="swiper-slide">
                        <img src="{{ Storage::disk('uploads')->url($slide->image) }}" alt="Slider Image">
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
            <h1>{{ $content->title ?? '' }}</h1>
            <h3>{{ $content->subtitle ?? '' }}</h3>
        </div>
    </div>
</div>

<div class="container py-5 my-5">

    {{-- SOLUSI CETAKMU --}}
<h3 class="section-title">TEMUKAN SOLUSI CETAKMU</h3>
<div class="row justify-content-center g-4">
    @php
        use App\Models\Product;

        // AMBIL KATEGORI LANGSUNG DARI DATABASE
        $categories = Product::whereNotNull('category')
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');
    @endphp

    @forelse($categories as $cat)
        @php
            $product = Product::where('category', $cat)->first();
            $image = ($product && $product->image)
                ? Storage::disk('uploads')->url($product->image)
                : 'https://via.placeholder.com/300x180?text=Coming+Soon';
        @endphp

        <div class="col-6 col-sm-4 col-md-2">
            <a href="{{ route('products.index', ['category' => $cat]) }}" class="text-decoration-none">
                <div class="dark-card category-box h-100">
                    <img src="{{ $image }}" alt="{{ $cat }}" class="category-card img-fluid w-100">
                    <div class="card-body py-3">
                        <h5 class="fw-bold mb-0" style="font-size: 16px;">{{ $cat }}</h5>
                    </div>
                </div>
            </a>
        </div>

    @empty
        <div class="col-12 text-center text-muted">
            Belum ada kategori produk.
        </div>
    @endforelse
</div>

{{-- ================= SWIPER ================= --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    new Swiper(".mySwiper", {
        loop: true,
        autoplay: { delay: 4000 },
        pagination: { el: ".swiper-pagination", clickable: true },
        effect: "fade"
    });
</script>


    {{-- MENGAPA KAMI --}}
    <div class="mt-5 pt-5">
        <h3 class="section-title">MENGAPA KAMI PILIHAN TEPAT</h3>

        @if(isset($whys) && $whys->count())
            <div class="swiper whySwiper mt-4">
                <div class="swiper-wrapper">
                    @foreach($whys as $why)
                        <div class="swiper-slide d-flex justify-content-center">
                            <div class="dynamic-card p-4 text-center" style="width: 100%; max-width: 340px;">
                                <h4 class="fw-bold mb-3">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    {{ $why->title }}
                                </h4>
                                <p class="mb-0" style="font-size: 0.95rem; line-height: 1.6;">
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.querySelector('.whySwiper')) {
                new Swiper('.whySwiper', {
                    loop: true,
                    autoplay: { delay: 3500, disableOnInteraction: false },
                    spaceBetween: 24,
                    pagination: { el: '.swiper-pagination', clickable: true },
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
    <div class="mt-5 pt-5 about-section">
        <h3 class="section-title">TENTANG KAMI</h3>
        <div class="row align-items-center g-4">
            @if(isset($profil->image_tentang))
                <div class="col-md-6 text-center">
                    <img src="{{ Storage::disk('uploads')->url($profil->image_tentang) }}"
                         alt="Tentang Kami"
                         class="img-fluid rounded-4 shadow"
                         style="max-height: 420px; object-fit: cover;">
                </div>
            @endif

            <div class="col-md-6">
                <div class="dark-card p-4">
                    <p class="about-text mb-0">{{ $profil->tentang }}</p>

                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="dark-card mini-info-card">
                                <h5 class="fw-bold mb-2">
                                    <i class="bi bi-eye-fill me-2"></i>VISI
                                </h5>
                                <small>{{ $profil->visi }}</small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="dark-card mini-info-card">
                                <h5 class="fw-bold mb-2">
                                    <i class="bi bi-bullseye me-2"></i>MISI
                                </h5>
                                <small>{{ $profil->misi }}</small>
                            </div>
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
                    $image = $market->icon ? Storage::disk('uploads')->url($market->icon) : 'https://via.placeholder.com/80x80?text=M';
                    $url = $market->link ?? '#';
                @endphp
                <div class="col-4 col-sm-3 col-md-2">
                    <a href="{{ $url }}" target="_blank" class="text-decoration-none">
                        <div class="dark-card marketplace-card">
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

        <div class="dark-card contact-box-modern mx-auto">
            <div class="contact-row">

                <div class="contact-item">
                    <h4 class="fw-bold">
                        <i class="bi bi-geo-alt-fill me-2"></i>Alamat Workshop
                    </h4>
                    <p class="mb-0">{{ $contact->alamat ?? 'Belum ada alamat.' }}</p>
                </div>

                <div class="contact-item">
                    <h4 class="fw-bold">
                        <i class="bi bi-whatsapp me-2"></i>Admin WhatsApp
                    </h4>

                    @if(!empty($contact->whatsapp))
                        <ul class="list-unstyled wa-list mb-0">
                            @foreach($contact->whatsapp as $index => $wa)
                                @php
                                    // bersihkan spasi/karakter aneh biar wa.me aman
                                    $waClean = preg_replace('/[^0-9]/', '', $wa);
                                @endphp
                                <li class="mb-2">
                                    Admin {{ $index + 1 }}:
                                    <a href="https://wa.me/{{ $waClean }}" target="_blank">
                                        +{{ $waClean }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mb-0">Belum ada nomor WhatsApp.</p>
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
        autoplay: { delay: 4000, disableOnInteraction: false },
        pagination: { el: ".swiper-pagination", clickable: true },
        speed: 900,
        effect: "fade",
        fadeEffect: { crossFade: true }
    });
</script>

@endsection
