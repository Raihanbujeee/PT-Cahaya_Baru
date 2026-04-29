<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang Kami - PT Cahaya Baru</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Base CSS -->
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

    <style>
        /* ── Breadcrumb ── */
        .breadcrumb-bar {
            background: var(--bg-beige);
            padding: 14px 0;
            font-size: 14px;
            color: var(--text-muted);
        }
        .breadcrumb-bar a { color: var(--primary); font-weight: 500; }
        .breadcrumb-bar span { margin: 0 6px; }

        /* ── Page hero ── */
        .about-hero {
            width: 100%;
            padding: 70px 0 50px;
            text-align: center;
            background: var(--bg-white);
        }
        .about-hero h1 { font-size: 44px; font-weight: 800; color: var(--text-dark); line-height: 1.2; margin-bottom: 16px; }
        .about-hero p  { font-size: 18px; color: var(--text-muted); }

        /* ── Tentang box ── */
        .about-box {
            width: 100%;
            background: #f8f8f8;
            padding: 60px 40px;
            border-radius: 18px;
            margin-bottom: 60px;
        }
        .about-box-inner { display: flex; gap: 50px; align-items: center; }
        .about-box-img { flex: 1; }
        .about-box-img img { width: 100%; height: 420px; object-fit: cover; border-radius: 14px; box-shadow: var(--shadow-lg); }
        .about-box-text { flex: 1; }
        .about-label { display: flex; align-items: center; gap: 12px; margin-bottom: 14px; }
        .about-label-line { width: 50px; height: 2px; background: #f59e0b; }
        .about-label span { color: #f59e0b; font-size: 14px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; }
        .about-box-text h2 { color: var(--text-dark); font-size: 26px; font-weight: 800; margin-bottom: 18px; line-height: 1.3; }
        .about-box-text p { color: var(--text-muted); font-size: 14px; line-height: 1.9; margin-bottom: 16px; }

        /* ── Stats row ── */
        .stats-row { display: flex; gap: 25px; width: 100%; margin-bottom: 60px; }
        .stat-box {
            flex: 1; background: var(--bg-white);
            padding: 35px 20px; border-radius: 16px; text-align: center;
            box-shadow: var(--shadow-sm); border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }
        .stat-box:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); }
        .stat-box .number { font-size: 42px; font-weight: 800; color: #f59e0b; }
        .stat-box .label  { font-size: 15px; color: var(--text-muted); margin-top: 8px; font-weight: 500; }

        /* ── Visi Misi ── */
        .visimisi-wrapper {
            background: var(--bg-white);
            padding: 40px;
            border-radius: 18px;
            margin-bottom: 60px;
            border: 1px solid var(--border-color);
        }
        .visimisi-grid { display: flex; gap: 25px; }
        .vm-card { flex: 1; background: #f3f4f6; padding: 28px; border-radius: 16px; }
        .vm-title { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; }
        .vm-title i { color: #f59e0b; font-size: 20px; }
        .vm-title span { color: #f59e0b; font-size: 18px; font-weight: 800; }
        .vm-card p { color: var(--text-dark); line-height: 1.8; font-size: 15px; }
        .misi-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 14px; }
        .misi-list li { display: flex; gap: 10px; align-items: flex-start; color: var(--text-dark); font-size: 15px; }
        .misi-list li i { color: #f59e0b; margin-top: 3px; flex-shrink: 0; }

        /* ── Nilai Inti ── */
        .nilai-section { margin-bottom: 70px; text-align: center; }
        .nilai-section .section-h2 { font-size: 36px; font-weight: 800; color: var(--text-dark); margin-bottom: 12px; }
        .nilai-section .section-sub { color: var(--text-muted); font-size: 16px; margin-bottom: 40px; }
        .nilai-grid { display: flex; gap: 25px; }
        .nilai-card {
            flex: 1; background: var(--bg-white);
            padding: 35px 25px; border-radius: 18px; text-align: center;
            box-shadow: var(--shadow-sm); border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }
        .nilai-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-lg); border-color: #f59e0b; }
        .nilai-card .icon { font-size: 38px; color: #f59e0b; margin-bottom: 18px; }
        .nilai-card h3 { font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 12px; }
        .nilai-card p { font-size: 15px; color: var(--text-muted); line-height: 1.8; }

        /* ── Tim Kami ── */
        .tim-section { margin-bottom: 60px; text-align: center; }
        .tim-section .section-h2 { font-size: 36px; font-weight: 800; color: var(--text-dark); margin-bottom: 12px; }
        .tim-section .section-sub { font-size: 16px; color: var(--text-muted); max-width: 650px; margin: 0 auto 40px; line-height: 1.8; }
        .tim-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px; text-align: center; }
        .tim-card {
            background: var(--bg-beige); border-radius: 18px; padding: 30px 20px;
            border: 1px solid var(--border-color); transition: all 0.3s ease;
        }
        .tim-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-lg); }
        .tim-card img { width: 110px; height: 110px; border-radius: 50%; object-fit: cover; margin: 0 auto 16px; display: block; border: 3px solid #f59e0b; }
        .tim-card h3 { font-size: 18px; font-weight: 800; color: var(--text-dark); margin-bottom: 6px; }
        .tim-card .role { font-size: 14px; color: #f59e0b; font-weight: 700; margin-bottom: 10px; }
        .tim-card p { font-size: 14px; color: var(--text-muted); line-height: 1.7; }

        /* ── CTA ── */
        .cta-section {
            background: linear-gradient(135deg, var(--primary), #A05F0D);
            padding: 70px 40px; border-radius: 18px;
            text-align: center; color: white; margin-bottom: 60px;
        }
        .cta-section h2 { font-size: 34px; font-weight: 800; margin-bottom: 14px; }
        .cta-section p { font-size: 17px; opacity: 0.9; margin-bottom: 35px; max-width: 580px; margin-left: auto; margin-right: auto; }
        .cta-buttons { display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; }
        .btn-white {
            background: white; color: var(--primary); border: 2px solid white;
            display: inline-flex; align-items: center; gap: 8px;
            padding: 14px 28px; border-radius: 8px; font-weight: 700; font-size: 16px;
            transition: all 0.3s ease; text-decoration: none;
        }
        .btn-white:hover { background: var(--bg-beige); transform: translateY(-2px); }
        .btn-outline-white {
            background: transparent; color: white; border: 2px solid white;
            display: inline-flex; align-items: center; gap: 8px;
            padding: 14px 28px; border-radius: 8px; font-weight: 700; font-size: 16px;
            transition: all 0.3s ease; text-decoration: none;
        }
        .btn-outline-white:hover { background: rgba(255,255,255,0.15); transform: translateY(-2px); }

        /* ── Responsive ── */
        @media (max-width: 992px) {
            .about-box-inner { flex-direction: column; }
            .stats-row { flex-wrap: wrap; }
            .stats-row .stat-box { flex: calc(50% - 13px); min-width: 180px; }
            .visimisi-grid { flex-direction: column; }
            .nilai-grid { flex-direction: column; }
            .tim-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .about-hero h1 { font-size: 32px; }
            .tim-grid { grid-template-columns: repeat(2, 1fr); }
            .cta-buttons { flex-direction: column; align-items: center; }
        }
    </style>
</head>
<body>

    <!-- ── Navbar ── -->
    <header>
        <div class="container navbar">
            <a href="/" class="logo">
                <i class="ri-building-4-fill"></i> PT Cahaya Baru
            </a>
            <nav class="nav-links">
                <a href="/#beranda">Beranda</a>
                <a href="/produk">Produk</a>
                <a href="/#layanan">Jasa &amp; Layanan</a>
                <a href="/tentang-kami" class="active">Tentang Kami</a>
                <a href="/kontak">Kontak</a>
                <a href="https://wa.me/6283834079959" class="btn btn-primary" target="_blank">Hubungi Kami</a>
            </nav>
            <button class="mobile-menu-btn" aria-label="Menu">
                <i class="ri-menu-line"></i>
            </button>
        </div>
    </header>

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
                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                         alt="PT Cahaya Baru">
                </div>
                <div class="about-box-text">
                    <div class="about-label">
                        <div class="about-label-line"></div>
                        <span>Tentang Kami</span>
                    </div>
                    <h2>PT Cahaya Baru — Solusi Bahan Bangunan Sejak 2010</h2>
                    <p>
                        Berawal dari sebuah toko kecil di Surabaya, PT Cahaya Baru didirikan dengan satu tujuan sederhana:
                        menyediakan bahan bangunan berkualitas dengan harga yang jujur. Selama lebih dari 14 tahun, kami telah
                        berkembang menjadi salah satu distributor terkemuka di Jawa Timur, melayani kontraktor, pemborong hingga
                        pemilik rumah perorangan.
                    </p>
                    <p>
                        Kami percaya bahwa fondasi bangunan yang kuat dimulai dari material yang tepat dan hubungan jangka panjang
                        yang didasari rasa saling percaya. Tim kami selalu siap memberikan konsultasi profesional untuk memastikan
                        setiap proyek Anda berjalan lancar tanpa kendala suplai material.
                    </p>
                    <div style="display:flex;gap:15px;flex-wrap:wrap;margin-top:20px;">
                        <a href="/produk" class="btn btn-primary"><i class="ri-store-2-line"></i> Lihat Produk</a>
                        <a href="/kontak" class="btn btn-outline"><i class="ri-phone-line"></i> Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistik 4 kolom --}}
        <div class="stats-row">
            <div class="stat-box">
                <div class="number">14+</div>
                <div class="label">Tahun Pengalaman</div>
            </div>
            <div class="stat-box">
                <div class="number">500+</div>
                <div class="label">Jenis Produk</div>
            </div>
            <div class="stat-box">
                <div class="number">50+</div>
                <div class="label">Mitra Supplier</div>
            </div>
            <div class="stat-box">
                <div class="number">100.000+</div>
                <div class="label">Pelanggan Puas</div>
            </div>
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

        {{-- Tim Kami --}}
        <div class="tim-section">
            <h2 class="section-h2">Mengenal Tim Kami</h2>
            <p class="section-sub">
                Tim profesional kami siap membantu Anda dengan pengalaman, dedikasi,
                dan pelayanan terbaik di setiap kebutuhan proyek bangunan.
            </p>
            <div class="tim-grid">
                <div class="tim-card">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Budi Santoso">
                    <h3>Budi Santoso</h3>
                    <div class="role">Direktur Utama</div>
                    <p>Memimpin perusahaan dengan visi jangka panjang dan inovasi berkelanjutan.</p>
                </div>
                <div class="tim-card">
                    <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Sinta Dewi">
                    <h3>Sinta Dewi</h3>
                    <div class="role">Manajer Operasional</div>
                    <p>Menjaga alur distribusi dan operasional berjalan efisien.</p>
                </div>
                <div class="tim-card">
                    <img src="https://randomuser.me/api/portraits/men/52.jpg" alt="Andi Pratama">
                    <h3>Andi Pratama</h3>
                    <div class="role">Supervisor Gudang</div>
                    <p>Mengatur stok dan memastikan pengiriman tepat waktu.</p>
                </div>
                <div class="tim-card">
                    <img src="https://randomuser.me/api/portraits/women/60.jpg" alt="Rina Maharani">
                    <h3>Rina Maharani</h3>
                    <div class="role">Customer Service</div>
                    <p>Siap membantu kebutuhan pelanggan dengan ramah dan cepat.</p>
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

    <!-- ── Footer ── -->
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
                        <li><a href="/">Beranda</a></li>
                        <li><a href="/produk">Katalog Produk</a></li>
                        <li><a href="/#layanan">Layanan Kami</a></li>
                        <li><a href="/tentang-kami">Profil Perusahaan</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Bantuan</h4>
                    <ul>
                        <li><a href="#">Cara Pembelian</a></li>
                        <li><a href="#">Syarat &amp; Ketentuan</a></li>
                        <li><a href="#">Kebijakan Retur</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h4>Kontak Kami</h4>
                    <ul>
                        <li>
                            <i class="ri-map-pin-fill"></i>
                            <span>Jl. Raya Darmo No. 123, Wonokromo, Surabaya, Jawa Timur 60241</span>
                        </li>
                        <li>
                            <i class="ri-phone-fill"></i>
                            <span>0838-3407-9959</span>
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

    <script>
        // Mobile menu toggle
        const mobileBtn = document.querySelector('.mobile-menu-btn');
        const navLinks = document.querySelector('.nav-links');
        if (mobileBtn) {
            mobileBtn.addEventListener('click', () => {
                navLinks.classList.toggle('active');
            });
        }
    </script>
</body>
</html>
