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
        <div class="container">
            <h1>Solusi Bahan Bangunan Terpercaya</h1>
            <p>Menyediakan berbagai macam kebutuhan material bangunan berkualitas dengan harga kompetitif dan pelayanan terbaik untuk proyek impian Anda.</p>
            <div class="hero-buttons">
                <a href="/produk" class="btn btn-primary">Lihat Produk</a>
                <a href="https://wa.me/6283834079959" class="btn btn-outline" target="_blank">Hubungi Kami</a>
            </div>
        </div>
    </section>

    <!-- Produk Unggulan Section -->
    <section id="produk" class="section-padding produk-bg">
        <div class="container">
            <div class="section-title">
                <h2>Produk Unggulan Kami</h2>
                <p>Material bahan bangunan pilihan dengan kualitas standar nasional</p>
            </div>

            <div class="product-grid">
                <!-- Product 1 -->
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1518709268805-4e9042af9f23?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Semen" class="product-img">
                    <div class="product-content">
                        <span class="product-badge">Semen</span>
                        <h3 class="product-title">Semen Portland 50Kg</h3>
                        <p class="product-brand">Semen Tiga Roda</p>
                        <div class="product-stock"><i class="ri-checkbox-circle-fill"></i> Stok Tersedia</div>
                        <p class="product-price">Rp 65.000</p>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1562259929-b7e181d8d002?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Cat Tembok" class="product-img">
                    <div class="product-content">
                        <span class="product-badge">Cat</span>
                        <h3 class="product-title">Cat Tembok Interior 25Kg</h3>
                        <p class="product-brand">Dulux Catylac</p>
                        <div class="product-stock"><i class="ri-checkbox-circle-fill"></i> Stok Tersedia</div>
                        <p class="product-price">Rp 185.000</p>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1590496734187-57ce3dd3045d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Besi Beton" class="product-img">
                    <div class="product-content">
                        <span class="product-badge">Besi</span>
                        <h3 class="product-title">Besi Beton Polos 10mm</h3>
                        <p class="product-brand">Krakatau Steel</p>
                        <div class="product-stock"><i class="ri-checkbox-circle-fill"></i> Stok Tersedia</div>
                        <p class="product-price">Rp 75.000</p>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1523413363574-c30aa1c2a516?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Keramik" class="product-img">
                    <div class="product-content">
                        <span class="product-badge">Keramik</span>
                        <h3 class="product-title">Keramik Lantai 40x40</h3>
                        <p class="product-brand">Milan</p>
                        <div class="product-stock"><i class="ri-checkbox-circle-fill"></i> Stok Tersedia</div>
                        <p class="product-price">Rp 55.000 / Dus</p>
                    </div>
                </div>
            </div>

            <div class="view-all-container">
                <a href="/produk" class="btn btn-outline">Lihat Semua Produk</a>
            </div>
        </div>
    </section>

    <!-- Promo / Penawaran Section -->
    <section class="container">
        <div class="promo-banner">
            <div class="promo-content">
                <h3>Promo Spesial Bulan Ini!</h3>
                <p>Dapatkan diskon hingga 15% untuk pembelian semen minimal 100 sak. Syarat dan ketentuan berlaku.</p>
            </div>
            <a href="https://wa.me/6283834079959" class="btn btn-primary promo-btn" target="_blank"><i class="ri-coupon-3-fill"></i> Klaim Promo</a>
        </div>
    </section>

    <!-- Jasa & Layanan Section -->
    <section id="layanan" class="section-padding layanan-bg">
        <div class="container">
            <div class="section-title">
                <h2>Jasa &amp; Layanan</h2>
                <p>Selain menjual produk, kami juga menyediakan layanan pendukung untuk proyek Anda</p>
            </div>

            <div class="layanan-grid">
                <!-- Layanan 1 -->
                <div class="layanan-card">
                    <i class="ri-truck-fill layanan-icon"></i>
                    <h3 class="layanan-title">Pengiriman Barang</h3>
                    <p class="layanan-desc">Layanan antar jemput material bahan bangunan langsung ke lokasi proyek Anda dengan armada kami sendiri secara aman.</p>
                    <a href="https://wa.me/6283834079959" class="btn btn-wa" target="_blank"><i class="ri-whatsapp-line"></i> Pesan Pengiriman</a>
                </div>

                <!-- Layanan 2 -->
                <div class="layanan-card">
                    <i class="ri-home-gear-fill layanan-icon"></i>
                    <h3 class="layanan-title">Konsultasi Bangunan</h3>
                    <p class="layanan-desc">Konsultasikan kebutuhan material dan estimasi biaya bangunan Anda dengan tim ahli kami secara gratis dan akurat.</p>
                    <a href="https://wa.me/6283834079959" class="btn btn-wa" target="_blank"><i class="ri-whatsapp-line"></i> Chat Konsultan</a>
                </div>

                <!-- Layanan 3 -->
                <div class="layanan-card">
                    <i class="ri-tools-fill layanan-icon"></i>
                    <h3 class="layanan-title">Jasa Pemasangan</h3>
                    <p class="layanan-desc">Kami menyediakan tukang profesional untuk pemasangan keramik, atap baja ringan, plafon, dan instalasi lainnya.</p>
                    <a href="https://wa.me/6283834079959" class="btn btn-wa" target="_blank"><i class="ri-whatsapp-line"></i> Order Tukang</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="tentang" class="section-padding tentang-bg">
        <div class="container">
            <div class="tentang-content">
                <div class="tentang-text">
                    <h3>Mengenal PT Cahaya Baru</h3>
                    <p>Berdiri sejak 2010, PT Cahaya Baru telah menjadi mitra terpercaya bagi ribuan proyek pembangunan di Indonesia. Kami berkomitmen untuk selalu menyediakan produk material bahan bangunan berkualitas tinggi dengan standar SNI dan harga yang bersaing.</p>
                    <p>Dengan pengalaman lebih dari satu dekade, kami memahami betul kebutuhan pelanggan dari skala perumahan hingga proyek komersial besar. Tim kami siap memberikan pelayanan prima dan solusi terbaik untuk setiap kebutuhan konstruksi Anda.</p>
                </div>

                <div class="stats-grid">
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

</body>
</html>
