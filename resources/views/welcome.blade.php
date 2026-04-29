<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PT Cahaya Baru - Solusi Bahan Bangunan Terpercaya</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>

    @include('partials.header', ['activePage' => 'beranda'])

    <!-- Hero Section -->
    <section id="beranda" class="hero">
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <h1 class="fade-up">Solusi Bahan Bangunan Terpercaya untuk Semua Kebutuhan Anda</h1>
            <p class="fade-up" style="transition-delay: 0.1s">Menyediakan material konstruksi berkualitas tinggi dengan pelayanan profesional sejak 2004. Bangun impian Anda bersama kami.</p>
            <div class="hero-buttons fade-up" style="transition-delay: 0.2s">
                <a href="/produk" class="btn btn-primary">Lihat Produk</a>
                <a href="https://wa.me/6283834079959" class="btn btn-hero-outline" target="_blank">Hubungi Kami</a>
            </div>
        </div>
    </section>

    <!-- Produk Unggulan Section -->
    <section id="produk" class="section-padding produk-bg">
        <div class="container">
            <div class="section-header fade-up">
                <h2>Produk Unggulan</h2>
                <a href="/produk" class="link-all">Lihat Semua <i class="ri-arrow-right-line"></i></a>
            </div>

            <div class="product-grid">
                @php
                    $fallbacks = [
                        'Semen' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?w=500&q=80',
                        'Cat Tembok' => 'https://images.unsplash.com/photo-1562259929-b7e181d8d002?w=500&q=80',
                        'Besi' => 'https://images.unsplash.com/photo-1590496734187-57ce3dd3045d?w=500&q=80',
                        'Keramik' => 'https://images.unsplash.com/photo-1523413363574-c30aa1c2a516?w=500&q=80',
                        'Pipa' => 'https://images.unsplash.com/photo-1621252179027-94459d278660?w=500&q=80',
                        'Kabel' => 'https://images.unsplash.com/photo-1558222218-b7b54eede3f3?w=500&q=80',
                        'Kayu' => 'https://images.unsplash.com/photo-1628744448829-01297db3c800?w=500&q=80',
                    ];
                    $defaultFallback = 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=500&q=80';
                @endphp
                @foreach($featuredProducts as $index => $product)
                    @php
                        $catName = $product->category ? $product->category->name : 'Lainnya';
                        $imgUrl = $product->image
                            ? asset('storage/' . $product->image)
                            : ($fallbacks[$catName] ?? $defaultFallback);
                        $stockOk = $product->current_stock > 0;
                    @endphp
                    <div class="product-card fade-up" style="transition-delay: {{ $index * 0.1 }}s">
                        <div class="product-img-wrap">
                            <img src="{{ $imgUrl }}" alt="{{ $product->name }}" class="product-img">
                        </div>
                        <div class="product-content">
                            <div class="product-meta">
                                <span class="product-category">{{ strtoupper($catName) }}</span>
                                <span class="product-stock-badge {{ $stockOk ? 'in-stock' : 'out-stock' }}">
                                    <i class="ri-circle-fill"></i> {{ $stockOk ? 'Tersedia' : 'Pre-order' }}
                                </span>
                            </div>
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <p class="product-price">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</p>
                            <a href="/produk/{{ $product->id }}" class="btn-detail">Lihat Detail</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Jasa & Layanan Section -->
    <section id="layanan" class="section-padding layanan-bg">
        <div class="container">
            <div class="section-title fade-up">
                <h2>Jasa &amp; Layanan</h2>
                <p>Selain menjual produk, kami juga menyediakan layanan pendukung untuk proyek Anda</p>
            </div>

            <div class="layanan-grid">
                <div class="layanan-card fade-up">
                    <div class="layanan-icon-wrap">
                        <i class="ri-truck-fill layanan-icon"></i>
                    </div>
                    <h3 class="layanan-title">Pengiriman Barang</h3>
                    <p class="layanan-desc">Layanan pengiriman material bangunan langsung ke lokasi proyek Anda dengan armada kami yang aman dan terpercaya.</p>
                    <a href="https://wa.me/6283834079959?text=Halo%2C%20saya%20ingin%20menggunakan%20layanan%20pengiriman%20barang" class="btn btn-wa" target="_blank">
                        <i class="ri-whatsapp-line"></i> Hubungi via WhatsApp
                    </a>
                </div>

                <div class="layanan-card fade-up" style="transition-delay: 0.1s">
                    <div class="layanan-icon-wrap">
                        <i class="ri-home-gear-fill layanan-icon"></i>
                    </div>
                    <h3 class="layanan-title">Konsultasi Bangunan</h3>
                    <p class="layanan-desc">Konsultasikan kebutuhan material dan estimasi biaya bangunan Anda dengan tim ahli kami secara gratis.</p>
                    <a href="https://wa.me/6283834079959?text=Halo%2C%20saya%20ingin%20konsultasi%20kebutuhan%20bangunan" class="btn btn-wa" target="_blank">
                        <i class="ri-whatsapp-line"></i> Hubungi via WhatsApp
                    </a>
                </div>

                <div class="layanan-card fade-up" style="transition-delay: 0.2s">
                    <div class="layanan-icon-wrap">
                        <i class="ri-tools-fill layanan-icon"></i>
                    </div>
                    <h3 class="layanan-title">Jasa Pemasangan</h3>
                    <p class="layanan-desc">Tersedia tukang profesional untuk pemasangan keramik, atap baja ringan, plafon, dan instalasi lainnya.</p>
                    <a href="https://wa.me/6283834079959?text=Halo%2C%20saya%20ingin%20menggunakan%20jasa%20pemasangan" class="btn btn-wa" target="_blank">
                        <i class="ri-whatsapp-line"></i> Hubungi via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Section -->
    <section id="testimoni" class="section-padding testimoni-bg">
        <div class="container">
            <div class="section-title fade-up">
                <h2>Apa Kata Mereka</h2>
            </div>

            <div class="testimoni-grid">
                <div class="testimoni-card fade-up">
                    <div class="testimoni-quote">"</div>
                    <div class="testimoni-stars">
                        <i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i>
                    </div>
                    <p class="testimoni-text">"Material selalu lengkap dan kualitasnya terjamin. Pengiriman ke lokasi proyek di Jakarta Selatan selalu tepat waktu. Sangat membantu operasional kontraktor."</p>
                    <div class="testimoni-author">
                        <div class="testimoni-avatar" style="background-color: #E8D5B7;">B</div>
                        <div class="testimoni-info">
                            <strong>Budi Santoso</strong>
                            <span>Kontraktor Independen</span>
                        </div>
                    </div>
                </div>

                <div class="testimoni-card fade-up" style="transition-delay: 0.1s">
                    <div class="testimoni-quote">"</div>
                    <div class="testimoni-stars">
                        <i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i>
                    </div>
                    <p class="testimoni-text">"Pelayanan stafnya luar biasa. Saat saya renovasi rumah, mereka sabar merekomendasikan jenis cat dan keramik yang pas dengan budget. Toko langganan!"</p>
                    <div class="testimoni-author">
                        <div class="testimoni-avatar" style="background-color: #D4B896;">R</div>
                        <div class="testimoni-info">
                            <strong>Rina Wijaya</strong>
                            <span>Pemilik Rumah</span>
                        </div>
                    </div>
                </div>

                <div class="testimoni-card fade-up" style="transition-delay: 0.2s">
                    <div class="testimoni-quote">"</div>
                    <div class="testimoni-stars">
                        <i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i>
                    </div>
                    <p class="testimoni-text">"Harga sangat bersaing terutama untuk pembelian partai besar. Proses PO jelas dan tagihan selalu rapi. Mitra bisnis yang solid."</p>
                    <div class="testimoni-author">
                        <div class="testimoni-avatar" style="background-color: #C4A882;">A</div>
                        <div class="testimoni-info">
                            <strong>Andi Pratama</strong>
                            <span>Purchasing Manager</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="tentang" class="section-padding tentang-bg">
        <div class="container">
            <div class="tentang-content">
                <div class="tentang-text fade-up">
                    <h3>Mengenal PT Cahaya Baru</h3>
                    <p>Berdiri sejak 2010, PT Cahaya Baru telah menjadi mitra terpercaya bagi ribuan proyek pembangunan di Indonesia. Kami berkomitmen untuk selalu menyediakan produk material bahan bangunan berkualitas tinggi dengan standar SNI dan harga yang bersaing.</p>
                    <p>Dengan pengalaman lebih dari satu dekade, kami memahami betul kebutuhan pelanggan dari skala perumahan hingga proyek komersial besar. Tim kami siap memberikan pelayanan prima dan solusi terbaik untuk setiap kebutuhan konstruksi Anda.</p>
                </div>
                <div class="stats-grid fade-up" style="transition-delay: 0.15s">
                    <div class="stat-card">
                        <i class="ri-history-line stat-icon"></i>
                        <div class="stat-info">
                            <h4>14+</h4>
                            <span>Tahun Beroperasi</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <i class="ri-store-3-line stat-icon"></i>
                        <div class="stat-info">
                            <h4>5000+</h4>
                            <span>Produk Tersedia</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <i class="ri-truck-line stat-icon"></i>
                        <div class="stat-info">
                            <h4>50+</h4>
                            <span>Mitra Supplier</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <i class="ri-user-smile-line stat-icon"></i>
                        <div class="stat-info">
                            <h4>10k+</h4>
                            <span>Pelanggan Puas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/welcome.js') }}"></script>
</body>
</html>
