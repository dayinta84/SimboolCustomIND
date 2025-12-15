@extends('layout.main')
@section('title', 'Profil Perusahaan')

@section('content')
<style>
    body {
        color: #212529; /* default text color */
        font-family: 'Poppins', sans-serif;
    }

    /* ====== HERO SECTION ====== */
    .hero-section {
        position: relative;
        height: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 0 15px;
        margin-bottom: 0;
    }

    .hero-section img {
        display: block;
        margin: 0 auto 20px auto;
        max-height: 180px;
        max-width: 90%;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        animation: fadeInDown 0.8s ease-out;
    }

    .hero-section h1 {
        font-size: 2.4rem;
        letter-spacing: 2px;
        animation: fadeInUp 0.8s ease-out;

        /* GRADIENT LOGO STYLE */
        background: linear-gradient(90deg, #ff4fd8, #a855f7, #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;

        text-shadow:
            0 0 8px rgba(168, 85, 247, 0.6),
            0 0 16px rgba(124, 58, 237, 0.4);
    }

    .hero-section p {
        max-width: 700px;
        margin: 12px auto 0 auto;
        color: #555;
        font-size: 1rem;
        animation: fadeIn 1s ease-out;
    }

    /* ====== CONTENT SECTIONS ====== */
    section.content {
        margin-top: 0;
        padding: 2rem 0;
    }

    /* Default card container spacing (tanpa warna) */
    .tentang, .visi-misi .box, .layanan .card, .extra-section {
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .tentang:hover,
    .visi-misi .box:hover,
    .layanan .card:hover,
    .extra-section:hover {
        transform: translateY(-3px);
    }

    .tentang {
        padding: 35px;
    }

    .tentang img {
        width: 100%;
        max-width: 400px;
        border-radius: 10px;
        margin: 0 auto;
        box-shadow: 0 3px 8px rgba(0,0,0,0.08);
    }

    .tentang p {
        text-align: justify;
        font-size: 1.02rem;
        line-height: 1.7;
    }

    /* ====== VISI & MISI ====== */
    .visi-misi {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 25px;
    }

    .visi-misi .box {
        flex: 1 1 320px;
        text-align: center;
    }

    .visi-misi p {
        white-space: pre-line;
    }

    /* ====== LAYANAN KAMI ====== */
    .layanan {
        text-align: center;
    }

    .layanan h3 {
        font-weight: 800;
        margin-bottom: 1.8rem;
        letter-spacing: 2px;

        background: linear-gradient(90deg, #ff4fd8, #a855f7);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;

        text-shadow: 0 0 10px rgba(168, 85, 247, 0.5);
    }

    /* ====== DARK CARD STYLE (SAMAKAN DENGAN LAYANAN KAMI) ====== */
    .dark-card {
        background: linear-gradient(
            145deg,
            rgba(30, 30, 45, 0.95),
            rgba(20, 20, 35, 0.95)
        );
        border: 1px solid rgba(168, 85, 247, 0.25);
        border-radius: 14px;
        color: #e5e7eb;
        box-shadow: 0 6px 18px rgba(0,0,0,0.35);
        transition: all 0.3s ease;
    }

    .dark-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(168, 85, 247, 0.25);
        border-color: rgba(168, 85, 247, 0.6);
    }

    .dark-card h4,
    .dark-card h5 {
        color: #f472ff;
        letter-spacing: 1px;
        text-shadow: 0 0 10px rgba(168, 85, 247, 0.6);
    }

    .dark-card p {
        color: #d1d5db;
    }

    /* Layanan card tetap sama, tapi kita arahkan juga pakai dark-card agar konsisten */
    .layanan .card {
        background: linear-gradient(
            145deg,
            rgba(30, 30, 45, 0.95),
            rgba(20, 20, 35, 0.95)
        );
        border: 1px solid rgba(168, 85, 247, 0.25);
        border-radius: 14px;
        color: #e5e7eb;

        box-shadow: 0 5px 15px rgba(0,0,0,0.35);
        transition: all 0.3s ease;

        /* Atur lebar maksimum */
        max-width: 80%;
        width: 80%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 18px 20px;
        text-align: center;

        /* Jarak antar card */
        margin: 0 auto 20px auto;
    }

    .layanan .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(168, 85, 247, 0.25);
        border-color: rgba(168, 85, 247, 0.6);
    }

    .layanan .card h5 {
        color: #f472ff;
        letter-spacing: 1px;
        font-size: 1.1rem;
        margin-bottom: 8px;
        text-shadow: 0 0 10px rgba(168, 85, 247, 0.6);
    }

    .layanan .card p {
        color: #d1d5db;
        font-size: 0.95rem;
        line-height: 1.5;
        margin: 0;
        max-width: 90%;
    }

    @media (min-width: 768px) {
        .layanan .col-md-6 {
            flex: 0 0 calc(50% - 15px);
        }
    }

    /* ====== ANIMASI ====== */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

{{-- ====== HERO SECTION ====== --}}
<div class="hero-section py-5">
    @if($profil->image)
        <img src="{{ asset('storage/' . $profil->image) }}" alt="Profil">
    @endif
    <h1>{{ strtoupper($profil->title) }}</h1>
    <!-- <p>{{ $profil->tentang }}</p> -->
</div>

{{-- ====== MAIN CONTENT ====== --}}
<section class="container content py-2">

    {{-- Tentang Kami --}}
    <div class="tentang container dark-card">
        <h4 class="text-center mb-4">Tentang Kami</h4>
        <div class="row align-items-center">
            @if($profil->image_tentang)
                <div class="col-md-6 text-center mb-3 mb-md-0">
                    <img src="{{ asset('storage/' . $profil->image_tentang) }}" alt="Tentang Kami" class="img-fluid rounded shadow">
                </div>
            @endif
            <div class="col-md-6">
                <p style="white-space: pre-line;">{{ $profil->tentang }}</p>
            </div>
        </div>
    </div>

    {{-- Visi & Misi --}}
    <div class="visi-misi">
        <div class="box dark-card">
            <h4>VISI</h4>
            <p>{{ $profil->visi }}</p>
        </div>
        <div class="box dark-card">
            <h4>MISI</h4>
            <p>{{ $profil->misi }}</p>
        </div>
    </div>

    {{-- Layanan Kami --}}
    <div class="layanan">
        <h3>LAYANAN KAMI</h3>
        <div class="row mt-4 g-4 justify-content-center">
            @foreach($layanans as $layanan)
                <div class="col-md-6 mb-4 mx-auto">
                    <div class="card p-4 shadow-sm">
                        <h5 class="fw-bold text-uppercase">{{ $layanan->judul }}</h5>
                        <p>{{ $layanan->deskripsi }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Section Tambahan --}}
    @foreach($sections as $sec)
        <div class="extra-section text-center dark-card">
            <h4>{{ strtoupper($sec->judul) }}</h4>
            <p>{{ $sec->isi }}</p>
        </div>
    @endforeach

</section>
@endsection
