@php
    $about_contents = \App\Models\AboutContents::first();
    // dd($about_contents);
    $stats = \App\Models\CompanyStats::orderBy('id', 'asc')->get(); 
    // return view('tentang', compact('about_contents', 'stats')); 
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang Kami - PT Cahaya Baru</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Base CSS -->
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tentang.css') }}">
</head>
<body>

    @include('partials.header', ['activePage' => 'tentang'])

    <!-- ── Breadcrumb ── -->
    <div class="breadcrumb-bar">
        <div class="container">
            <a href="/">Beranda</a><span>/</span><strong>Tentang Kami</strong>
        </div>
    </div>

    <!-- ── Main Content (Konten dari about-us.blade.php) ── -->
    <div class="container" style="padding-top: 0; padding-bottom: 0;">

        {{-- Header atas --}}
        <div class="about-hero">
            <h1>
                Mitra Terpercaya Untuk Setiap<br>
                Proyek Bangunan Anda
            </h1>
            <p>Kami hadir memberikan solusi terbaik untuk kebutuhan bangunan Anda.</p>
        </div>

        {{-- Kotak tengah dengan foto --}}
        <div class="about-box">
            <div class="about-box-inner">
                <div class="about-box-img">
                    @if($about_contents->image)
                        <img src="{{ asset('storage/' . $about_contents->image) }}" alt="Tentang Kami">
                    @endif
                </div>
                <div class="about-box-text">
                    <div class="about-label">
                        <div class="about-label-line"></div>
                        <span>Tentang Kami</span>
                    </div>
                    <h2>{{ $about_contents->title }}</h2>
                    <p>{!! $about_contents->description !!}</p>
                    <div style="display:flex;gap:15px;flex-wrap:wrap;margin-top:20px;">
                        <a href="/produk" class="btn btn-primary"><i class="ri-store-2-line"></i> Lihat Produk</a>
                        <a href="/kontak" class="btn btn-outline"><i class="ri-phone-line"></i> Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistik 4 kolom --}}
        <div class="stats-row">
            @foreach($stats as $stat)
                <div class="stat-box">
                    <div class="number">{{ $stat->value }}</div>
                    <div class="label">{{ $stat->label }}</div>
                </div>
            @endforeach
        </div>

        {{-- Visi & Misi --}}
        <div class="visimisi-wrapper">
            <div class="visimisi-grid">
                {{-- Visi --}}
                <div class="vm-card">
                    <div class="vm-title">
                        <i class="fa-regular fa-eye"></i>
                        <span>Visi</span>
                    </div>
                    <p>
                        Menjadi penyedia solusi bahan bangunan paling terpercaya di Indonesia
                        yang mendasari setiap pembangunan dengan integritas, inovasi dan pelayanan prima.
                    </p>
                </div>

                {{-- Misi --}}
                <div class="vm-card">
                    <div class="vm-title">
                        <i class="fa-solid fa-bullseye"></i>
                        <span>Misi</span>
                    </div>
                    <ul class="misi-list">
                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Menyediakan produk berkualitas tinggi dengan harga yang kompetitif</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Memberikan kemitraan strategis yang saling menguntungkan</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Memberikan pelayanan pelanggan yang responsif dan solutif</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Nilai-Nilai Inti --}}
        <div class="nilai-section">
            <h2 class="section-h2">Nilai-Nilai Inti Kami</h2>
            <p class="section-sub">Prinsip yang menjadi landasan setiap langkah kami</p>
            <div class="nilai-grid">
                <div class="nilai-card">
                    <div class="icon"><i class="fa-regular fa-handshake"></i></div>
                    <h3>Kejujuran</h3>
                    <p>Kami menjunjung kejujuran dan tanggung jawab dalam setiap transaksi dan layanan.</p>
                </div>
                <div class="nilai-card">
                    <div class="icon"><i class="fa-regular fa-star"></i></div>
                    <h3>Kualitas</h3>
                    <p>Produk dan pelayanan terbaik menjadi standar utama kami setiap hari.</p>
                </div>
                <div class="nilai-card">
                    <div class="icon"><i class="fa-solid fa-shield"></i></div>
                    <h3>Kepercayaan</h3>
                    <p>Hubungan jangka panjang dengan pelanggan adalah prioritas utama kami.</p>
                </div>
            </div>
        </div>


        {{-- CTA --}}
        <div class="cta-section">
            <h2>Siap Bekerja Sama dengan Kami?</h2>
            <p>Hubungi tim kami sekarang untuk konsultasi gratis dan penawaran terbaik untuk proyek Anda.</p>
            <div class="cta-buttons">
                <a href="https://wa.me/6283834079959" class="btn-white" target="_blank">
                    <i class="ri-whatsapp-line"></i> Chat via WhatsApp
                </a>
                <a href="/produk" class="btn-outline-white">
                    <i class="ri-store-2-line"></i> Lihat Katalog Produk
                </a>
            </div>
        </div>

    </div><!-- /container -->

    @include('partials.footer')

</body>
</html>
