<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jasa &amp; Layanan - TB Cahaya Baru</title>

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
    <section class="section-padding" style="background: rgba(0, 0, 0, 0.15); border-top: 1px solid rgba(255, 255, 255, 0.05); border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
        <div class="container">
            <div class="section-title fade-up">
                <h2>Layanan Utama Kami</h2>
            </div>

            <!-- Search & Filter Controls -->
            <div class="search-filter-container fade-up">
                <div class="search-box">
                    <i class="ri-search-line search-icon"></i>
                    <input type="text" id="service-search" placeholder="Cari jasa atau layanan...">
                </div>
                <div class="filter-pills">
                    <button class="filter-pill active" data-filter="all">Semua</button>
                    <button class="filter-pill" data-filter="pemasangan">Pemasangan</button>
                    <button class="filter-pill" data-filter="pengantaran">Pengantaran</button>
                    <button class="filter-pill" data-filter="lainnya">Lainnya</button>
                </div>
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
                    <div class="service-main-card fade-up" 
                         data-name="{{ strtolower($service->name) }}" 
                         data-description="{{ strtolower($service->description) }}" 
                         data-type="{{ $service->type }}" 
                         style="transition-delay: {{ $index * 0.1 }}s">
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

                <!-- No results message -->
                <div id="no-services-message" class="no-results-message" style="display: none;">
                    <i class="ri-search-eye-line"></i>
                    <h3>Layanan Tidak Ditemukan</h3>
                    <p>Coba gunakan kata kunci pencarian atau kategori filter lainnya.</p>
                </div>
            </div>

            <!-- Custom Pagination -->
            @if ($services->hasPages())
                <div class="custom-pagination fade-up" style="margin-top: 40px; display: flex; justify-content: center; gap: 10px; align-items: center;">
                    {{-- Previous Page Link --}}
                    @if ($services->onFirstPage())
                        <span style="opacity: 0.5; cursor: not-allowed; padding: 10px 20px; border-radius: 30px; background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.08); color: var(--text-muted); font-family: 'Space Mono', monospace; font-size: 14px;"><i class="ri-arrow-left-s-line"></i> Sebelumnya</span>
                    @else
                        <a href="{{ $services->previousPageUrl() }}" style="padding: 10px 20px; border-radius: 30px; background: var(--primary); color: #fff; text-decoration: none; font-family: 'Space Mono', monospace; font-size: 14px; transition: all 0.3s ease; box-shadow: var(--shadow-sm);"><i class="ri-arrow-left-s-line"></i> Sebelumnya</a>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($services->hasMorePages())
                        <a href="{{ $services->nextPageUrl() }}" style="padding: 10px 20px; border-radius: 30px; background: var(--primary); color: #fff; text-decoration: none; font-family: 'Space Mono', monospace; font-size: 14px; transition: all 0.3s ease; box-shadow: var(--shadow-sm);">Selanjutnya <i class="ri-arrow-right-s-line"></i></a>
                    @else
                        <span style="opacity: 0.5; cursor: not-allowed; padding: 10px 20px; border-radius: 30px; background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.08); color: var(--text-muted); font-family: 'Space Mono', monospace; font-size: 14px;">Selanjutnya <i class="ri-arrow-right-s-line"></i></span>
                    @endif
                </div>
            @endif

        </div>
    </section>

    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/welcome.js') }}"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('service-search');
            const filterPills = document.querySelectorAll('.filter-pill');
            const serviceCards = document.querySelectorAll('.service-main-card');
            const noMessage = document.getElementById('no-services-message');

            let searchTerm = '';
            let activeFilter = 'all';

            function filterServices() {
                let visibleCount = 0;

                serviceCards.forEach(card => {
                    const name = card.getAttribute('data-name') || '';
                    const desc = card.getAttribute('data-description') || '';
                    const type = card.getAttribute('data-type') || '';

                    const matchesSearch = name.includes(searchTerm) || desc.includes(searchTerm);
                    const matchesFilter = activeFilter === 'all' || type === activeFilter;

                    if (matchesSearch && matchesFilter) {
                        card.style.display = '';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (visibleCount === 0) {
                    noMessage.style.display = 'block';
                } else {
                    noMessage.style.display = 'none';
                }
            }

            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    searchTerm = e.target.value.toLowerCase().trim();
                    filterServices();
                });
            }

            filterPills.forEach(pill => {
                pill.addEventListener('click', function() {
                    filterPills.forEach(p => p.classList.remove('active'));
                    this.classList.add('active');
                    activeFilter = this.getAttribute('data-filter');
                    filterServices();
                });
            });
        });
    </script>
</body>

</html>
