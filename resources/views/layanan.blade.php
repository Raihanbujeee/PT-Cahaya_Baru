<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jasa & Layanan - PT Cahaya Baru</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layanan.css') }}">
</head>

<body>

    @include('partials.header', ['activePage' => 'layanan'])

    <!-- ── HERO SECTION ── -->
    <section class="layanan-hero" @if(isset($layananSetting->hero_image)) style="background: url('{{ asset('storage/' . $layananSetting->hero_image) }}') center/cover no-repeat; position: relative;" @endif>
        @if(isset($layananSetting->hero_image))
            <div style="position: absolute; inset: 0; background: rgba(0, 0, 0, 0.6);"></div>
        @endif
        <div class="container" style="position: relative; z-index: 2;">
            <nav class="hero-breadcrumb fade-up">
                Beranda &nbsp; > &nbsp; <strong>Jasa & Layanan</strong>
            </nav>
            <h1 class="fade-up">{{ $layananSetting->hero_title ?? 'Layanan Lengkap untuk Kebutuhan Bangunan Anda' }}</h1>
            <p class="fade-up" style="transition-delay: 0.1s">{{ $layananSetting->hero_description ?? 'Dari konsultasi hingga instalasi, kami menyediakan solusi terpadu dengan standar kualitas tinggi untuk menjamin kesuksesan proyek Anda.' }}</p>
            <div class="hero-actions fade-up" style="transition-delay: 0.2s">
                <a href="https://wa.me/6283834079959?text=Halo%2C%20saya%20ingin%20konsultasi%20gratis" class="btn btn-primary">Konsultasi Gratis</a>
                <a href="/produk" class="btn btn-hero-blur">Lihat Produk Kami</a>
            </div>
        </div>
    </section>

    <!-- ── ADVANTAGES SECTION ── -->
    <section class="section-padding bg-white">
        <div class="container">
            <div class="section-title fade-up">
                <h2>Kenapa Memilih Layanan Kami</h2>
            </div>
            <div class="advantages-grid">
                <div class="advantage-card fade-up">
                    <div class="advantage-icon">
                        <i class="ri-medal-line"></i>
                    </div>
                    <h3>Pengalaman 10+ Tahun</h3>
                    <p>Terpercaya dalam ratusan proyek di seluruh wilayah.</p>
                </div>
                <div class="advantage-card fade-up" style="transition-delay: 0.1s">
                    <div class="advantage-icon">
                        <i class="ri-team-line"></i>
                    </div>
                    <h3>Tim Profesional</h3>
                    <p>Tenaga ahli bersertifikat yang dedikatif.</p>
                </div>
                <div class="advantage-card fade-up" style="transition-delay: 0.2s">
                    <div class="advantage-icon">
                        <i class="ri-shield-check-line"></i>
                    </div>
                    <h3>Garansi Kepuasan</h3>
                    <p>Kualitas pengerjaan dijamin sesuai standar tertinggi.</p>
                </div>
                <div class="advantage-card fade-up" style="transition-delay: 0.3s">
                    <div class="advantage-icon">
                        <i class="ri-time-line"></i>
                    </div>
                    <h3>Respons Cepat</h3>
                    <p>Penyelesaian tepat waktu sesuai jadwal proyek.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ── MAIN SERVICES SECTION ── -->
    <section class="section-padding" style="background-color: #F4F3F0;">
        <div class="container">
            <div class="section-title fade-up">
                <h2>Layanan Utama Kami</h2>
            </div>
            <div class="services-main-grid">
                @php
                    $icons = [
                        'kirim' => 'ri-truck-line',
                        'angkut' => 'ri-truck-line',
                        'pasang' => 'ri-tools-line',
                        'konsultasi' => 'ri-discuss-line',
                        'survey' => 'ri-map-pin-user-line',
                    ];
                @endphp
                @foreach($services as $index => $service)
                    @php
                        $icon = 'ri-customer-service-2-line';
                        foreach($icons as $key => $value) {
                            if(strpos(strtolower($service->name), $key) !== false) {
                                $icon = $value;
                                break;
                            }
                        }
                    @endphp
                    <div class="service-main-card fade-up" style="transition-delay: {{ $index * 0.1 }}s">
                        <div class="service-badge">{{ $service->price > 0 ? 'Rp ' . number_format($service->price, 0, ',', '.') : 'Gratis' }}</div>
                        <div class="service-main-icon">
                            <i class="{{ $icon }}"></i>
                        </div>
                        <h3>{{ $service->name }}</h3>
                        <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 20px; line-height: 1.6;">
                            {{ $service->description }}
                        </p>
                        <div class="service-actions">
                            <a href="https://wa.me/6283834079959?text=Halo%2C%20saya%20ingin%20tanya%20tentang%20layanan%20{{ urlencode($service->name) }}" class="btn btn-pesan">Tanya Layanan</a>
                            <a href="https://wa.me/6283834079959" class="btn btn-chat"><i class="ri-whatsapp-line"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/welcome.js') }}"></script>
</body>

</html>
