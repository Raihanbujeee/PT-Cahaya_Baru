<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kontak - PT Cahaya Baru</title>
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/kontak.css') }}">
</head>

<body>

    <!-- ── HEADER ── -->
    <header>
        <div class="container navbar">
            <a href="/" class="logo">
                <i class="ri-building-4-fill"></i> PT Cahaya Baru
            </a>
            <nav class="nav-links">
                <a href="/#beranda">Beranda</a>
                <a href="/produk">Produk</a>
                <a href="/#layanan">Jasa & Layanan</a>
                <a href="/tentang-kami">Tentang Kami</a>
                <a href="/kontak"class="active">Kontak</a>
                <a href="https://wa.me/6283834079959" class="btn btn-primary" target="_blank">Hubungi Kami</a>
            </nav>
            <button class="mobile-menu-btn" aria-label="Menu">
                <i class="ri-menu-line"></i>
            </button>
        </div>
    </header>

    <!-- ── BREADCRUMB ── -->
    <div class="breadcrumb">
        <div class="container">
            <a href="/">Beranda</a> &nbsp;/&nbsp; <span>Kontak</span>
        </div>
    </div>

    <!-- ── MAIN ── -->
    <main style="flex:1;">
        <div class="container">

            <!-- Hero -->
            <section class="hero">
                <h1>Kami Siap Membantu Anda</h1>
                <p>Hubungi kami melalui berbagai saluran komunikasi yang tersedia atau kunjungi toko kami langsung di Surabaya.</p>
            </section>

            <!-- Contact Cards -->
            <section class="cards-section">
                <div class="cards-grid">

                    <!-- WhatsApp -->
                    <div class="contact-card">
                        <div class="card-icon"><i class="ri-whatsapp-line"></i></div>
                        <h3>WhatsApp</h3>
                        <p>Respon cepat untuk pertanyaan produk dan pemesanan.</p>
                        <a href="https://wa.me/6283834079959" target="_blank" class="btn btn-outline">
                            Chat Sekarang
                        </a>
                    </div>

                    <!-- Telepon -->
                    <div class="contact-card">
                        <div class="card-icon"><i class="ri-phone-line"></i></div>
                        <h3>Telepon</h3>
                        <p>Layanan pelanggan untuk konsultasi teknis dan proyek.</p>
                        <a href="tel:+6283834079959" class="btn btn-outline">
                            Hubungi Kami
                        </a>
                    </div>

                    <!-- Email -->
                    <div class="contact-card">
                        <div class="card-icon"><i class="ri-mail-line"></i></div>
                        <h3>Email</h3>
                        <p>Kirimkan permintaan penawaran harga atau dokumen resmi.</p>
                        <a href="mailto:info@cahayabaru.com" class="btn btn-outline">
                            Kirim Email
                        </a>
                    </div>

                </div>
            </section>

            <!-- Bottom: Alamat + Form -->
            <section class="bottom-section">

                <!-- Left: Alamat & Jam Operasional -->
                <div class="info-col">

                    <div class="info-box">
                        <h3><i class="ri-map-pin-2-line"></i> Alamat Toko</h3>
                        <p class="address-text">
                            Jl. Raya Darmo No. 123<br>
                            Kecamatan Wonokromo, Surabaya<br>
                            Jawa Timur 60241
                        </p>
                        <a href="https://maps.google.com" target="_blank" class="btn btn-outline" style="font-size:13px; padding:8px 16px;">
                            <i class="ri-map-pin-line"></i> Buka di Google Maps
                        </a>
                    </div>

                    <div class="info-box">
                        <h3><i class="ri-time-line"></i> Jam Operasional</h3>
                        <div class="jam-row">
                            <span class="label">Senin - Jumat</span>
                            <span class="time">08.00 - 17.00</span>
                        </div>
                        <div class="jam-row">
                            <span class="label">Sabtu</span>
                            <span class="time">08.00 - 15.00</span>
                        </div>
                        <div class="jam-row">
                            <span class="label">Minggu & Libur Nasional</span>
                            <span class="tutup">Tutup</span>
                        </div>
                    </div>

                </div>

                <!-- Right: Form -->
                <div class="form-box">
                    <h3>Kirim Pesan</h3>
                    <p class="form-sub">Silakan isi formulir di bawah ini. Tim kami akan membalas pesan Anda maksimal dalam 1×24 jam hari kerja.</p>

                    <?php if (isset($_GET['success'])): ?>
                        <div style="background:#e8f5e9; border:1px solid #a5d6a7; color:#2e7d32; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13.5px;">
                            <i class="ri-checkbox-circle-line"></i> Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.
                        </div>
                    <?php endif; ?>

                    <form action="/kontak/kirim" method="POST">
                        <?php if (function_exists('csrf_field')) { echo csrf_field(); } ?>

                        <div class="form-group">
                            <label for="nama">NAMA LENGKAP</label>
                            <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="whatsapp">NOMOR WHATSAPP</label>
                                <input type="tel" id="whatsapp" name="whatsapp" placeholder="Contoh: 0812..." required>
                            </div>
                            <div class="form-group">
                                <label for="email">EMAIL (OPSIONAL)</label>
                                <input type="email" id="email" name="email" placeholder="nama@email.com">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="keperluan">KEPERLUAN</label>
                            <select id="keperluan" name="keperluan" required>
                                <option value="" disabled selected>Pilih keperluan Anda</option>
                                <option value="penawaran">Permintaan Penawaran Harga</option>
                                <option value="konsultasi">Konsultasi Produk</option>
                                <option value="pemesanan">Pemesanan</option>
                                <option value="keluhan">Keluhan / Komplain</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="pesan">PESAN</label>
                            <textarea id="pesan" name="pesan" placeholder="Tuliskan detail pertanyaan atau kebutuhan Anda..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-submit">
                            <i class="ri-send-plane-line"></i> Kirim Pesan
                        </button>
                    </form>
                </div>

            </section>
        </div><!-- /container -->

        <!-- Map -->
        <div class="map-section">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.4755!2d112.7295!3d-7.2936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMTcnMzYuNiJTIDExMsKwNDMnNDYuMiJF!5e0!3m2!1sid!2sid!4v1620000000000!5m2!1sid!2sid"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

    </main>

    <!-- ── FOOTER ── -->
    <footer>
        <div class="container footer-inner">
            <span class="footer-brand">PT CAHAYA BARU</span>
            <span>© 2024 PT Cahaya Baru. Reliable Hardware & Construction Solutions.</span>
            <div class="footer-links">
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Syarat & Ketentuan</a>
                <a href="#">Pusat Bantuan</a>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileBtn = document.querySelector('.mobile-menu-btn');
        const navLinks  = document.querySelector('.nav-links');
        if (mobileBtn) {
            mobileBtn.addEventListener('click', () => {
                navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
                navLinks.style.flexDirection = 'column';
                navLinks.style.position = 'absolute';
                navLinks.style.top = '64px';
                navLinks.style.left = '0';
                navLinks.style.right = '0';
                navLinks.style.background = '#fff';
                navLinks.style.padding = '16px 24px';
                navLinks.style.borderBottom = '1px solid #e0d8cc';
                navLinks.style.zIndex = '99';
            });
        }
    </script>

</body>
</html>