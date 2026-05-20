<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kontak Kami - PT Cahaya Baru</title>
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kontak.css') }}">
    <style>
        .breadcrumb-bar {
            background: var(--bg-light);
            padding: 16px 0;
            font-size: 14px;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-color);
        }
        .breadcrumb-bar a { color: var(--text-muted); transition: color 0.3s; }
        .breadcrumb-bar a:hover { color: var(--primary); }
        .breadcrumb-bar span { color: var(--text-dark); font-weight: 600; }
    </style>
</head>

<body>

    @include('partials.header', ['activePage' => 'kontak'])

    <!-- ── BREADCRUMB ── -->
    <div class="breadcrumb-bar">
        <div class="container">
            <a href="/">Beranda</a> &nbsp; / &nbsp; <span>Kontak</span>
        </div>
    </div>

    <!-- ── HERO SECTION ── -->
    <section class="kontak-hero">
        <div class="container">
            <h1 class="fade-up">Kami Siap Membantu Anda</h1>
            <p class="fade-up" style="transition-delay: 0.1s">
                Hubungi kami melalui berbagai saluran komunikasi yang tersedia atau kunjungi toko kami langsung di <strong>Kota Malang</strong>.
            </p>
        </div>
    </section>

    <!-- ── CONTACT CARDS ── -->
    <section class="container">
        <div class="cards-grid">
            <!-- WhatsApp -->
            <div class="contact-card fade-up">
                <div class="card-icon"><i class="ri-whatsapp-line"></i></div>
                <h3>WhatsApp</h3>
                <p>Respon cepat untuk pertanyaan produk, stok, dan pemesanan online.</p>
                <a href="https://wa.me/6283834079959" target="_blank" class="btn btn-outline">Chat Sekarang</a>
            </div>

            <!-- Telepon -->
            <div class="contact-card fade-up" style="transition-delay: 0.1s">
                <div class="card-icon"><i class="ri-phone-line"></i></div>
                <h3>Telepon</h3>
                <p>Layanan pelanggan untuk konsultasi teknis proyek dan bantuan mendesak.</p>
                <a href="tel:+6283834079959" class="btn btn-outline">Hubungi Kami</a>
            </div>

            <!-- Email -->
            <div class="contact-card fade-up" style="transition-delay: 0.2s">
                <div class="card-icon"><i class="ri-mail-send-line"></i></div>
                <h3>Email</h3>
                <p>Kirimkan permintaan penawaran harga (RFQ) atau dokumen resmi perusahaan.</p>
                <a href="mailto:info@ptcahayabaru.com" class="btn btn-outline">Kirim Email</a>
            </div>
        </div>
    </section>

    <!-- ── BOTTOM SECTION ── -->
    <section class="container">
        <div class="bottom-section">
            
            <!-- Left: Info -->
            <div class="info-col fade-up">
                <div class="info-box">
                    <h3><i class="ri-map-pin-2-fill"></i> Alamat Toko</h3>
                    <p style="color: var(--text-muted); font-size: 15px; line-height: 1.8; margin-bottom: 24px;">
                        Jl. Saxophone No.65, Tunggulwulung, Kec. Lowokwaru,<br>
                        Kota Malang, Jawa Timur 65143
                    </p>
                    <a href="https://maps.google.com/?q=Jl.+Saxophone+No.65+Tunggulwulung+Lowokwaru+Malang" target="_blank" class="btn btn-primary" style="padding: 10px 20px; font-size: 13px;">
                        <i class="ri-map-pin-line"></i> Buka Petunjuk Jalan
                    </a>
                </div>

                <div class="info-box">
                    <h3><i class="ri-time-fill"></i> Jam Operasional</h3>
                    <div class="jam-row">
                        <span>Senin - Jumat</span>
                        <span class="time">08.00 - 17.00</span>
                    </div>
                    <div class="jam-row">
                        <span>Sabtu</span>
                        <span class="time">08.00 - 15.00</span>
                    </div>
                    <div class="jam-row">
                        <span>Minggu & Libur Nasional</span>
                        <span class="tutup">Tutup</span>
                    </div>
                </div>
            </div>

            <!-- Right: Form -->
            <div class="form-box fade-up" style="transition-delay: 0.15s">
                <h3>Kirim Pesan</h3>
                <p class="form-sub">Punya pertanyaan khusus? Isi formulir di bawah dan kami akan membalas dalam 1x24 jam.</p>
                
                <form action="#" method="POST">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nomor WhatsApp</label>
                            <input type="tel" placeholder="0812..." required>
                        </div>
                        <div class="form-group">
                            <label>Email (Opsional)</label>
                            <input type="email" placeholder="nama@email.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Pesan Anda</label>
                        <textarea placeholder="Tuliskan detail pertanyaan atau kebutuhan material Anda..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-submit">
                        <i class="ri-send-plane-fill"></i> Kirim Sekarang
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- ── MAP SECTION ── -->
    <section class="container map-container fade-up">
        <div class="map-card">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.3178!2d112.6242!3d-7.9386!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd629c5e0a3d9b5%3A0x1b2f2f2f2f2f2f2f!2sJl.%20Saxophone%20No.65%2C%20Tunggulwulung%2C%20Kec.%20Lowokwaru%2C%20Kota%20Malang%2C%20Jawa%20Timur%2065143!5e0!3m2!1sid!2sid!4v1714000000000!5m2!1sid!2sid"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>

    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/welcome.js') }}"></script>
</body>

</html>