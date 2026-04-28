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
    <style>
        :root {
            --primary: #854F0B; /* Warm Amber/Orange */
            --primary-hover: #6a3e08;
            --bg-white: #FFFFFF;
            --bg-beige: #F5F2EB;
            --text-dark: #3E2723; /* Dark Brown */
            --text-muted: #6D4C41;
            --border-color: #E8E0D5;
            --shadow-sm: 0 2px 4px rgba(62, 39, 35, 0.05);
            --shadow-md: 0 4px 6px rgba(62, 39, 35, 0.07);
            --shadow-lg: 0 10px 15px rgba(62, 39, 35, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg-white);
            color: var(--text-dark);
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            border: 2px solid var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-wa {
            background-color: #25D366;
            color: white;
            border: 2px solid #25D366;
        }
        
        .btn-wa:hover {
            background-color: #128C7E;
            border-color: #128C7E;
            transform: translateY(-2px);
        }

        /* Navbar */
        header {
            background-color: var(--bg-white);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 80px;
        }

        .logo {
            font-size: 24px;
            font-weight: 800;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            font-weight: 500;
            color: var(--text-dark);
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .mobile-menu-btn {
            display: none;
            font-size: 24px;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-dark);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(245, 242, 235, 0.85), rgba(245, 242, 235, 0.85)), url('https://images.unsplash.com/photo-1589939705384-5185137a7f0f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover;
            padding: 120px 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 20px;
            color: var(--text-dark);
            line-height: 1.2;
        }

        .hero p {
            font-size: 18px;
            color: var(--text-muted);
            margin-bottom: 40px;
            max-width: 650px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        /* Section Titles */
        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            font-size: 36px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .section-title p {
            color: var(--text-muted);
            font-size: 16px;
        }

        /* Padding Utility */
        .section-padding {
            padding: 80px 0;
        }

        /* Produk Unggulan */
        .produk-bg {
            background-color: var(--bg-white);
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 30px;
        }

        .product-card {
            background-color: var(--bg-white);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-5px);
            border-color: var(--primary);
        }

        .product-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid var(--border-color);
        }

        .product-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .product-badge {
            background-color: var(--bg-beige);
            color: var(--primary);
            font-size: 12px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            align-self: flex-start;
            margin-bottom: 12px;
        }

        .product-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .product-brand {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 15px;
        }
        
        .product-stock {
            font-size: 13px;
            color: #2e7d32;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 5px;
            background: #e8f5e9;
            padding: 4px 8px;
            border-radius: 4px;
            align-self: flex-start;
        }

        .product-price {
            font-size: 20px;
            font-weight: 800;
            color: var(--primary);
            margin-top: auto;
        }

        .view-all-container {
            text-align: center;
            margin-top: 50px;
        }

        /* Jasa & Layanan */
        .layanan-bg {
            background-color: var(--bg-beige);
        }

        .layanan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .layanan-card {
            background-color: var(--bg-white);
            padding: 40px 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .layanan-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-5px);
            border-color: var(--border-color);
        }

        .layanan-icon {
            font-size: 48px;
            color: var(--primary);
            margin-bottom: 20px;
            display: inline-block;
            background: var(--bg-beige);
            padding: 15px;
            border-radius: 50%;
        }

        .layanan-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .layanan-desc {
            color: var(--text-muted);
            margin-bottom: 25px;
        }

        /* Promo */
        .promo-banner {
            background: linear-gradient(135deg, var(--primary), #A05F0D);
            border-radius: 16px;
            padding: 50px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--shadow-lg);
            margin: 40px auto;
        }

        .promo-content h3 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .promo-content p {
            font-size: 18px;
            opacity: 0.9;
        }

        .promo-btn {
            background-color: white;
            color: var(--primary);
            border: none;
            padding: 15px 30px;
            font-size: 16px;
            white-space: nowrap;
        }

        .promo-btn:hover {
            background-color: var(--bg-beige);
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* Tentang Kami */
        .tentang-bg {
            background-color: var(--bg-white);
        }

        .tentang-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .tentang-text h3 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 20px;
            color: var(--text-dark);
        }

        .tentang-text p {
            color: var(--text-muted);
            margin-bottom: 20px;
            font-size: 16px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .stat-card {
            background-color: var(--bg-beige);
            padding: 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .stat-icon {
            font-size: 32px;
            color: var(--primary);
        }

        .stat-info h4 {
            font-size: 24px;
            font-weight: 800;
            color: var(--text-dark);
        }

        .stat-info span {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Footer */
        footer {
            background-color: var(--text-dark);
            color: white;
            padding: 80px 0 20px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 60px;
        }

        .footer-about .logo {
            color: white;
            margin-bottom: 20px;
        }

        .footer-about p {
            color: #bcaaa4;
            margin-bottom: 25px;
            padding-right: 20px;
        }

        .social-icons {
            display: flex;
            gap: 15px;
        }

        .social-icons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transition: all 0.3s ease;
            color: white;
        }

        .social-icons a:hover {
            background-color: var(--primary);
            transform: translateY(-3px);
        }

        .footer-links h4 {
            font-size: 18px;
            margin-bottom: 20px;
            font-weight: 700;
            color: white;
        }

        .footer-links ul li {
            margin-bottom: 12px;
        }

        .footer-links ul li a {
            color: #bcaaa4;
            transition: color 0.3s ease;
        }

        .footer-links ul li a:hover {
            color: var(--primary);
            padding-left: 5px;
        }

        .footer-contact li {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            color: #bcaaa4;
            align-items: flex-start;
        }

        .footer-contact i {
            color: var(--primary);
            font-size: 20px;
            margin-top: 2px;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #bcaaa4;
            font-size: 14px;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .tentang-content {
                grid-template-columns: 1fr;
            }
            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
            .promo-banner {
                flex-direction: column;
                text-align: center;
                gap: 30px;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
                position: absolute;
                top: 80px;
                left: 0;
                width: 100%;
                background-color: var(--bg-white);
                flex-direction: column;
                padding: 20px;
                box-shadow: var(--shadow-md);
                gap: 15px;
            }
            .nav-links.active {
                display: flex;
            }
            .nav-links .btn {
                width: 100%;
            }
            .mobile-menu-btn {
                display: block;
            }
            .hero h1 {
                font-size: 36px;
            }
            .hero-buttons {
                flex-direction: column;
            }
            .footer-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <header>
        <div class="container navbar">
            <a href="#" class="logo">
                <i class="ri-building-4-fill"></i> PT Cahaya Baru
            </a>
            
            <nav class="nav-links">
                <a href="#beranda">Beranda</a>
                <a href="/produk">Produk</a>
                <a href="#layanan">Jasa & Layanan</a>
                <a href="#tentang">Tentang Kami</a>
                <a href="#kontak">Kontak</a>
                <a href="https://wa.me/6281234567890" class="btn btn-primary" target="_blank">Hubungi Kami</a>
            </nav>

            <button class="mobile-menu-btn" aria-label="Menu">
                <i class="ri-menu-line"></i>
            </button>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="beranda" class="hero">
        <div class="container">
            <h1>Solusi Bahan Bangunan Terpercaya</h1>
            <p>Menyediakan berbagai macam kebutuhan material bangunan berkualitas dengan harga kompetitif dan pelayanan terbaik untuk proyek impian Anda.</p>
            <div class="hero-buttons">
                <a href="/produk" class="btn btn-primary">Lihat Produk</a>
                <a href="https://wa.me/6281234567890" class="btn btn-outline" target="_blank">Hubungi Kami</a>
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
            <a href="https://wa.me/6281234567890" class="btn btn-primary promo-btn" target="_blank"><i class="ri-coupon-3-fill"></i> Klaim Promo</a>
        </div>
    </section>

    <!-- Jasa & Layanan Section -->
    <section id="layanan" class="section-padding layanan-bg">
        <div class="container">
            <div class="section-title">
                <h2>Jasa & Layanan</h2>
                <p>Selain menjual produk, kami juga menyediakan layanan pendukung untuk proyek Anda</p>
            </div>

            <div class="layanan-grid">
                <!-- Layanan 1 -->
                <div class="layanan-card">
                    <i class="ri-truck-fill layanan-icon"></i>
                    <h3 class="layanan-title">Pengiriman Barang</h3>
                    <p class="layanan-desc">Layanan antar jemput material bahan bangunan langsung ke lokasi proyek Anda dengan armada kami sendiri secara aman.</p>
                    <a href="https://wa.me/6281234567890" class="btn btn-wa" target="_blank"><i class="ri-whatsapp-line"></i> Pesan Pengiriman</a>
                </div>

                <!-- Layanan 2 -->
                <div class="layanan-card">
                    <i class="ri-home-gear-fill layanan-icon"></i>
                    <h3 class="layanan-title">Konsultasi Bangunan</h3>
                    <p class="layanan-desc">Konsultasikan kebutuhan material dan estimasi biaya bangunan Anda dengan tim ahli kami secara gratis dan akurat.</p>
                    <a href="https://wa.me/6281234567890" class="btn btn-wa" target="_blank"><i class="ri-whatsapp-line"></i> Chat Konsultan</a>
                </div>

                <!-- Layanan 3 -->
                <div class="layanan-card">
                    <i class="ri-tools-fill layanan-icon"></i>
                    <h3 class="layanan-title">Jasa Pemasangan</h3>
                    <p class="layanan-desc">Kami menyediakan tukang profesional untuk pemasangan keramik, atap baja ringan, plafon, dan instalasi lainnya.</p>
                    <a href="https://wa.me/6281234567890" class="btn btn-wa" target="_blank"><i class="ri-whatsapp-line"></i> Order Tukang</a>
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

    <!-- Footer -->
    <footer id="kontak">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-about">
                    <div class="logo">
                        <i class="ri-building-4-fill"></i> PT Cahaya Baru
                    </div>
                    <p>Pusat perbelanjaan bahan bangunan terlengkap dan termurah. Menjadi solusi utama untuk segala kebutuhan proyek konstruksi Anda.</p>
                    <div class="social-icons">
                        <a href="#"><i class="ri-facebook-fill"></i></a>
                        <a href="#"><i class="ri-instagram-line"></i></a>
                        <a href="#"><i class="ri-twitter-x-line"></i></a>
                        <a href="#"><i class="ri-youtube-fill"></i></a>
                    </div>
                </div>

                <div class="footer-links">
                    <h4>Tautan Cepat</h4>
                    <ul>
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="/produk">Katalog Produk</a></li>
                        <li><a href="#layanan">Layanan Kami</a></li>
                        <li><a href="#tentang">Profil Perusahaan</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4>Bantuan</h4>
                    <ul>
                        <li><a href="#">Cara Pembelian</a></li>
                        <li><a href="#">Syarat & Ketentuan Pengiriman</a></li>
                        <li><a href="#">Kebijakan Retur</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>

                <div class="footer-contact">
                    <h4>Kontak Kami</h4>
                    <ul>
                        <li>
                            <i class="ri-map-pin-fill"></i>
                            <span>Jl. Jendral Sudirman No. 123, Jakarta Pusat, DKI Jakarta 10220</span>
                        </li>
                        <li>
                            <i class="ri-phone-fill"></i>
                            <span>(021) 1234-5678<br>0812-3456-7890</span>
                        </li>
                        <li>
                            <i class="ri-mail-fill"></i>
                            <span>info@ptcahayabaru.com</span>
                        </li>
                        <li>
                            <i class="ri-time-fill"></i>
                            <span>Senin - Sabtu: 08:00 - 17:00</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} PT Cahaya Baru. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            document.querySelector('.nav-links').classList.toggle('active');
        });
    </script>
</body>
</html>
