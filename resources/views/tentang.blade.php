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

    @include('partials.footer')

</body>
</html>
