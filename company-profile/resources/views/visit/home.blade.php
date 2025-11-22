@extends('layout.main')

@section('content')

<style>
    /* ==== HERO + SLIDER BACKGROUND ==== */
    .hero-banner {
        position: relative;
        width: 100%;
        height: 380px;
        overflow: hidden;
    }

    .hero-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(70%);
    }

    .hero-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
        z-index: 10;
    }

    .hero-text h1 {
        font-size: 40px;
        font-weight: 800;
        text-shadow: 0 3px 10px rgba(0, 0, 0, .7);
    }

    .hero-text h3 {
        font-size: 22px;
        margin-top: 10px;
        font-weight: 600;
        text-shadow: 0 3px 8px rgba(0, 0, 0, .7);
    }

    /* ==== Swiper ==== */
    .swiper-slide img {
        width: 100%;
        height: 380px;
        object-fit: cover;
    }

    /* ==== LAYANAN ==== */
    .layanan-box {
        border: 2px solid #E639E6;
        background: #fff;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        transition: .3s;
    }

    .layanan-box:hover {
        transform: scale(1.05);
    }
</style>


<div class="container-fluid px-0">

    {{-- ======================================
         HERO (Judul di atas slider)
    ======================================= --}}
    <div class="hero-banner">

        {{-- TEXT DI ATAS SLIDER --}}
        <div class="hero-text">
            <h1>{{ $content->title ?? 'Judul Belum Diatur' }}</h1>
            <h3>{{ $content->subtitle ?? 'Subjudul Belum Diatur' }}</h3>
        </div>

        {{-- SLIDER --}}
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

                @forelse($sliders as $slide)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/'.$slide->image) }}" alt="Slider Image">
                    </div>
                @empty
                    <div class="swiper-slide">
                        <img src="https://via.placeholder.com/1600x400?text=No+Slider" alt="">
                    </div>
                @endforelse

            </div>
        </div>
    </div>




    {{-- ======================================
     LAYANAN KAMI (Tampilan seperti produk)
======================================= --}}
<div class="mt-5 container">

    <h2 class="fw-bold text-center mb-4">LAYANAN KAMI</h2>

    <div class="row">

        @forelse($layanan as $item)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0">

                    {{-- GAMBAR --}}
                    @if($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}"
                             class="card-img-top"
                             style="height:220px; object-fit:cover;">
                    @else
                        <img src="https://via.placeholder.com/220"
                             class="card-img-top"
                             style="height:220px; object-fit:cover;">
                    @endif

                    {{-- BODY --}}
                    <div class="card-body text-center">
                        <h6 class="fw-bold text-uppercase">{{ $item->nama_layanan }}</h6>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-4">
                Belum ada layanan yang ditambahkan.
            </div>
        @endforelse

    </div>

</div>




    {{-- ======================================
         MENGAPA KAMI
    ======================================= --}}
    <section class="mt-5 text-center">

        <h3 class="fw-bold">Mengapa Kami</h3>

        <div class="row mt-4 justify-content-center">

            @if($content)
                <div class="col-md-3 bg-black text-white p-4 rounded-4 m-2">
                    <h4 class="fw-bold">{{ $content->why_1_title }}</h4>
                    <p>{{ $content->why_1_desc }}</p>
                </div>

                <div class="col-md-3 bg-black text-white p-4 rounded-4 m-2">
                    <h4 class="fw-bold">{{ $content->why_2_title }}</h4>
                    <p>{{ $content->why_2_desc }}</p>
                </div>

                <div class="col-md-3 bg-black text-white p-4 rounded-4 m-2">
                    <h4 class="fw-bold">{{ $content->why_3_title }}</h4>
                    <p>{{ $content->why_3_desc }}</p>
                </div>
            @else
                <p class="text-muted">Konten "Mengapa Kami" belum diatur.</p>
            @endif

        </div>
    </section>

</div>

@endsection