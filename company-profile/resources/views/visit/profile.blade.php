@extends('layout.main')
@section('title', 'Profil Perusahaan')

@section('content')
<style>
    /* ====== BACKGROUND & FONT ====== */
    body {
        background: linear-gradient(160deg, #0b0014 0%, #1a001f 50%, #000000 100%);
        color: #fff;
        font-family: 'Poppins', sans-serif;
    }

    h1, h2, h3, h4 {
        color: #e66bff;
        font-weight: 700;
        text-shadow: 0 0 5px rgba(230, 107, 255, 0.4);
    }

    /* ====== HERO SECTION ====== */
    .hero-section {
        position: relative;
        height: 50vh;
        padding-bottom: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        background: radial-gradient(circle at top, rgba(255, 0, 204, 0.15), transparent 70%);
        overflow: hidden;
    }

    .hero-section img {
        display: block;
        margin: 0 auto 25px auto;
        max-height: 220px;
        max-width: 90%;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 0 25px rgba(255, 0, 204, 0.3);
        animation: fadeInDown 1s ease-out;
    }

    .hero-section h1 {
        font-size: 2.5rem;
        letter-spacing: 2px;
        animation: fadeInUp 1s ease-out;
    }

    .hero-section p {
        max-width: 700px;
        margin: 15px auto 0 auto;
        color: #ddd;
        font-size: 1.1rem;
        animation: fadeIn 1.2s ease-out;
    }

    /* ====== CONTENT SECTIONS ====== */
    section.content {
        margin-top: 10px;
    }

    .tentang, .visi-misi, .layanan, .extra-section {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 0, 204, 0.15);
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 50px;
        box-shadow: 0 0 15px rgba(255, 0, 204, 0.1);
    }

    .tentang {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        padding: 40px 30px;
        margin-bottom: 50px;
        box-shadow: 0 0 15px rgba(255, 0, 204, 0.15);
    }

    .tentang .row {
        align-items: center;
        /*gap: 20px;*/
    }

    .tentang img {
        width: 100%;
        max-width: 450px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(255, 0, 204, 0.25);
    }
    
    .tentang p {
        text-align: justify;
        font-size: 1.05rem;
        color: #ddd;
    }


    /* ====== VISI & MISI ====== */
    .visi-misi {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 25px;
    }

    .visi-misi .box {
        flex: 1 1 350px;
        background: rgba(255, 255, 255, 0.07);
        border-radius: 12px;
        padding: 30px;
        text-align: center;
        transition: 0.3s;
    }

    .visi-misi .box:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-5px);
        box-shadow: 0 0 20px rgba(255, 0, 204, 0.25);
    }

    .visi-misi p {
        white-space: pre-line;
    }

    /* ====== LAYANAN KAMI ====== */
    .layanan {
        text-align: center;
    }

    .layanan .card {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 0, 204, 0.15);
        border-radius: 12px;
        color: #fff;
        transition: 0.3s;
        height: 100%;
    }

    .layanan .card:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-5px);
        box-shadow: 0 0 15px rgba(255, 0, 204, 0.25);
    }

    @media (min-width: 768px) {
        .layanan .col-md-6 {
            flex: 0 0 45%;
            max-width: 45%;
        }
    }

    /* ====== ANIMASI ====== */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

{{-- ====== HERO SECTION ====== --}}
<div class="hero-section">
    @if($profil->image)
        <img src="{{ asset('storage/' . $profil->image) }}" alt="Profil">
    @endif
    <h1>{{ strtoupper($profil->title) }}</h1>
    <!-- <p>{{ $profil->tentang }}</p> -->
</div>

{{-- ====== MAIN CONTENT ====== --}}
<section class="container content py-5">

    {{-- Tentang Kami --}}
    <div class="tentang container">
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
        <div class="box">
            <h4>VISI</h4>
            <p>{{ $profil->visi }}</p>
        </div>
        <div class="box">
            <h4>MISI</h4>
            <p>{{ $profil->misi }}</p>
        </div>
    </div>

    {{-- Layanan Kami --}}
    <div class="layanan">
        <h3>LAYANAN KAMI</h3>
        <div class="row mt-4 g-4 justify-content-center">
            @foreach($layanans as $layanan)
                <div class="col-md-6 mb-4">
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
        <div class="extra-section text-center">
            <h4>{{ strtoupper($sec->judul) }}</h4>
            <p>{{ $sec->isi }}</p>
        </div>
    @endforeach

</section>
@endsection
