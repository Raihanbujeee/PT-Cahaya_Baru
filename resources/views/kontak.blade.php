<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kontak Kami - TB Cahaya Baru</title>
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
    <section class="kontak-hero" @if(isset($kontakSetting->hero_image)) style="background: url('{{ asset('storage/' . $kontakSetting->hero_image) }}') center/cover no-repeat; position: relative;" @endif>
        @if(isset($kontakSetting->hero_image))
            <div style="position: absolute; inset: 0; background: rgba(0, 0, 0, 0.6);"></div>
        @endif
        <div class="container" style="position: relative; z-index: 2;">
            <h1 class="fade-up">{{ $kontakSetting->hero_title ?? 'Kami Siap Membantu Anda' }}</h1>
            <p class="fade-up" style="transition-delay: 0.1s">
                {{ $kontakSetting->hero_description ?? 'Hubungi kami melalui berbagai saluran komunikasi yang tersedia atau kunjungi toko kami langsung di Kota Malang.' }}
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
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kontakSetting->phone ?? '6283834079959') }}" target="_blank" class="btn btn-outline">Chat Sekarang</a>
            </div>

            <!-- Telepon -->
            <div class="contact-card fade-up" style="transition-delay: 0.1s">
                <div class="card-icon"><i class="ri-phone-line"></i></div>
                <h3>Telepon</h3>
                <p>Layanan pelanggan untuk konsultasi teknis proyek dan bantuan mendesak.</p>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $kontakSetting->phone ?? '+6283834079959') }}" class="btn btn-outline">Hubungi Kami</a>
            </div>

            <!-- Email -->
            <div class="contact-card fade-up" style="transition-delay: 0.2s">
                <div class="card-icon"><i class="ri-mail-send-line"></i></div>
                <h3>Email</h3>
                <p>Kirimkan permintaan penawaran harga (RFQ) atau dokumen resmi perusahaan.</p>
                <a href="mailto:{{ $kontakSetting->email ?? 'info@ptcahayabaru.com' }}" class="btn btn-outline">Kirim Email</a>
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
                        {!! nl2br(e($kontakSetting->address ?? "Jl. Saxophone No.65, Tunggulwulung, Kec. Lowokwaru,\nKota Malang, Jawa Timur 65143")) !!}
                    </p>
                    <a href="https://maps.google.com/?q=Jl.+Saxophone+No.65+Tunggulwulung+Lowokwaru+Malang" target="_blank" class="btn btn-primary" style="padding: 10px 20px; font-size: 13px;">
                        <i class="ri-map-pin-line"></i> Buka Petunjuk Jalan
                    </a>
                </div>

                <div class="info-box">
                    <h3><i class="ri-time-fill"></i> Jam Operasional</h3>
                    <div class="jam-row">
                        <span>Senin - Jumat</span>
                        <span class="time">{{ $kontakSetting->hours_weekday ?? '08.00 - 17.00' }}</span>
                    </div>
                    <div class="jam-row">
                        <span>Sabtu</span>
                        <span class="time">{{ $kontakSetting->hours_saturday ?? '08.00 - 15.00' }}</span>
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

    <!-- ── REVIEW SECTION ── -->
    <section class="container" id="ulasan" style="padding-top: 60px; padding-bottom: 60px;">
        <div style="text-align: center; margin-bottom: 40px;">
            <div style="display: inline-block; background: #FEF3E2; color: #C27A1A; font-size: 13px; font-weight: 600; padding: 6px 16px; border-radius: 20px; margin-bottom: 12px;">
                <i class="ri-star-fill"></i> Ulasan Pelanggan
            </div>
            <h2 style="font-size: 28px; font-weight: 800; color: #1a1a1a; margin-bottom: 10px;">Bagikan Pengalaman Anda</h2>
            <p style="color: #777; font-size: 15px; max-width: 500px; margin: 0 auto;">Pendapat Anda sangat berarti bagi kami untuk terus meningkatkan pelayanan.</p>
        </div>

        <div style="max-width: 620px; margin: 0 auto; background: #fff; border-radius: 16px; padding: 40px; box-shadow: 0 4px 24px rgba(0,0,0,0.08); border: 1px solid #f0f0f0;">
            <div id="review-success-msg" style="display:none; text-align:center; padding: 20px;">
                <i class="ri-checkbox-circle-fill" style="font-size: 48px; color: #2e7d32;"></i>
                <h3 style="margin-top: 12px; color: #1a1a1a;">Terima Kasih!</h3>
                <p style="color: #777;">Ulasan Anda telah berhasil dikirim.</p>
            </div>
            <div id="review-form-wrap">
                <div style="margin-bottom: 20px;">
                    <label style="display:block; font-weight: 600; margin-bottom: 8px; color: #1a1a1a; font-size: 14px;">Nama Anda</label>
                    <input type="text" id="review-name" placeholder="Masukkan nama lengkap Anda"
                        style="width:100%; padding: 12px 16px; border: 1.5px solid #e5e5e5; border-radius: 8px; font-size: 14px; outline: none; transition: border 0.2s; box-sizing: border-box;"
                        onfocus="this.style.borderColor='#C27A1A'" onblur="this.style.borderColor='#e5e5e5'">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display:block; font-weight: 600; margin-bottom: 10px; color: #1a1a1a; font-size: 14px;">Rating</label>
                    <div id="star-rating" style="display: flex; gap: 8px; cursor: pointer;">
                        <i class="ri-star-fill" data-val="1" style="font-size: 32px; color: #C27A1A; transition: transform 0.1s;"></i>
                        <i class="ri-star-fill" data-val="2" style="font-size: 32px; color: #C27A1A; transition: transform 0.1s;"></i>
                        <i class="ri-star-fill" data-val="3" style="font-size: 32px; color: #C27A1A; transition: transform 0.1s;"></i>
                        <i class="ri-star-fill" data-val="4" style="font-size: 32px; color: #C27A1A; transition: transform 0.1s;"></i>
                        <i class="ri-star-fill" data-val="5" style="font-size: 32px; color: #C27A1A; transition: transform 0.1s;"></i>
                    </div>
                    <input type="hidden" id="review-rating" value="5">
                </div>

                <div style="margin-bottom: 28px;">
                    <label style="display:block; font-weight: 600; margin-bottom: 8px; color: #1a1a1a; font-size: 14px;">Ulasan Anda</label>
                    <textarea id="review-comment" rows="5" placeholder="Ceritakan pengalaman Anda berbelanja di PT Cahaya Baru..."
                        style="width:100%; padding: 12px 16px; border: 1.5px solid #e5e5e5; border-radius: 8px; font-size: 14px; outline: none; resize: vertical; transition: border 0.2s; box-sizing: border-box; font-family: inherit;"
                        onfocus="this.style.borderColor='#C27A1A'" onblur="this.style.borderColor='#e5e5e5'"></textarea>
                </div>

                <button onclick="submitReviewKontak()" id="btn-kirim-ulasan"
                    style="width: 100%; padding: 14px; background: #C27A1A; color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: background 0.2s;"
                    onmouseover="this.style.background='#A86710'" onmouseout="this.style.background='#C27A1A'">
                    <i class="ri-send-plane-fill"></i> Kirim Ulasan
                </button>
            </div>
        </div>
    </section>

    <script>
        // Star rating logic for review form on kontak page
        (function() {
            let currentRating = 5;
            const stars = document.querySelectorAll('#star-rating i');

            function setRating(val) {
                currentRating = val;
                document.getElementById('review-rating').value = val;
                stars.forEach(s => {
                    s.style.color = parseInt(s.dataset.val) <= val ? '#C27A1A' : '#ddd';
                });
            }

            stars.forEach(star => {
                star.addEventListener('click', function() { setRating(parseInt(this.dataset.val)); });
                star.addEventListener('mouseover', function() {
                    stars.forEach(s => { s.style.color = parseInt(s.dataset.val) <= parseInt(this.dataset.val) ? '#C27A1A' : '#ddd'; });
                });
                star.addEventListener('mouseout', function() { setRating(currentRating); });
            });
        })();

        async function submitReviewKontak() {
            const name    = document.getElementById('review-name').value.trim();
            const rating  = document.getElementById('review-rating').value;
            const comment = document.getElementById('review-comment').value.trim();

            if (!name || !comment) {
                alert('Mohon lengkapi nama dan ulasan Anda.');
                return;
            }

            const btn = document.getElementById('btn-kirim-ulasan');
            btn.innerHTML = '<i class="ri-loader-4-line"></i> Mengirim...';
            btn.disabled = true;

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
                const baseUrl = (window.APP_URL || window.location.origin).replace(/\/$/, '');

                const res = await fetch(baseUrl + '/api/reviews', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                    body: JSON.stringify({ customer_name: name, rating: parseInt(rating), comment: comment }),
                });

                const data = await res.json();
                if (res.ok && data.success) {
                    document.getElementById('review-form-wrap').style.display = 'none';
                    document.getElementById('review-success-msg').style.display = 'block';
                } else {
                    alert('Gagal mengirim: ' + (data.message || 'Terjadi kesalahan.'));
                    btn.innerHTML = '<i class="ri-send-plane-fill"></i> Kirim Ulasan';
                    btn.disabled = false;
                }
            } catch(e) {
                alert('Terjadi kesalahan koneksi.');
                btn.innerHTML = '<i class="ri-send-plane-fill"></i> Kirim Ulasan';
                btn.disabled = false;
            }
        }

        // Auto-scroll to form if URL has #ulasan hash
        if (window.location.hash === '#ulasan') {
            setTimeout(function() {
                const el = document.getElementById('ulasan');
                if (el) el.scrollIntoView({ behavior: 'smooth' });
            }, 300);
        }
    </script>

    @include('partials.footer')

    <!-- Scripts -->
    <script>window.APP_URL = "{{ url('/') }}";</script>
    <script src="{{ asset('js/welcome.js') }}"></script>
</body>

</html>