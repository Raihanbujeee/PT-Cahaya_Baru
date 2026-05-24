<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TB Cahaya Baru - Solusi Bahan Bangunan Terpercaya</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layanan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">

    <script>
        window.APP_URL = "{{ url('/') }}";
    </script>

    <!-- Stacks for partials -->
    @stack('styles')
</head>
<body>

    @include('partials.header', ['activePage' => 'beranda'])
    
    <script src="{{ asset('js/cart.js') }}"></script>

    <!-- Hero Section -->
    <section id="beranda" class="hero">
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <h1 class="fade-up">{{ $homepageSetting->hero_title ?? 'Solusi Bahan Bangunan Terpercaya untuk Semua Kebutuhan Anda' }}</h1>
            <div class="fade-up hero-description" style="transition-delay: 0.1s">
                {!! $homepageSetting->hero_description ?? '<p>Menyediakan material konstruksi berkualitas tinggi dengan pelayanan profesional sejak 2004. Bangun impian Anda bersama kami.</p>' !!}
            </div>
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

    <!-- ── ADVANTAGES SECTION (Sync with Layanan Page) ── -->
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

    <!-- ── MAIN SERVICES SECTION (Sync with Layanan Page) ── -->
    <section id="layanan" class="section-padding" style="background: rgba(0, 0, 0, 0.15); border-top: 1px solid rgba(255, 255, 255, 0.05); border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
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

    <!-- Testimoni Section -->
    <section id="testimoni" class="section-padding testimoni-bg">
        <div class="container">
            <div class="section-title fade-up">
                <h2>Apa Kata Mereka</h2>
            </div>

            <div class="testimoni-grid">
                @php
                    $reviewsData = isset($reviews) && $reviews->count() > 0 ? $reviews : [
                        [
                            'customer_name' => 'Budi Santoso',
                            'rating' => 5,
                            'comment' => 'Material selalu lengkap dan kualitasnya terjamin. Pengiriman ke lokasi proyek di Jakarta Selatan selalu tepat waktu. Sangat membantu operasional kontraktor.',
                        ],
                        [
                            'customer_name' => 'Rina Wijaya',
                            'rating' => 5,
                            'comment' => 'Pelayanan stafnya luar biasa. Saat saya renovasi rumah, mereka sabar merekomendasikan jenis cat dan keramik yang pas dengan budget. Toko langganan!',
                        ],
                        [
                            'customer_name' => 'Andi Pratama',
                            'rating' => 5,
                            'comment' => 'Harga sangat bersaing terutama untuk pembelian partai besar. Proses PO jelas dan tagihan selalu rapi. Mitra bisnis yang solid.',
                        ]
                    ];
                    $avatarColors = ['#E8D5B7', '#D4B896', '#C4A882', '#D3B48F', '#CBA373', '#E0C8A4'];
                @endphp

                @foreach($reviewsData as $index => $review)
                    @php
                        $color = $avatarColors[$index % count($avatarColors)];
                        $reviewName = is_object($review) ? $review->customer_name : $review['customer_name'];
                        $reviewComment = is_object($review) ? $review->comment : $review['comment'];
                        $reviewRating = is_object($review) ? $review->rating : $review['rating'];
                        $initial = strtoupper(substr($reviewName, 0, 1));
                    @endphp
                    <div class="testimoni-card fade-up" style="transition-delay: {{ $index * 0.1 }}s">
                        <div class="testimoni-quote">"</div>
                        <div class="testimoni-stars">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $reviewRating)
                                    <i class="ri-star-fill"></i>
                                @else
                                    <i class="ri-star-line" style="color: #ccc;"></i>
                                @endif
                            @endfor
                        </div>
                        <p class="testimoni-text">"{!! strip_tags($reviewComment) !!}"</p>
                        <div class="testimoni-author">
                            <div class="testimoni-avatar" style="background-color: {{ $color }};">{{ $initial }}</div>
                            <div class="testimoni-info">
                                <strong>{{ $reviewName }}</strong>
                                <span>Pelanggan</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div style="text-align: center; margin-top: 40px; position: relative; z-index: 5;">
                <button onclick="console.log('Button clicked'); openReviewModal()" class="btn btn-primary btn-retro-hover" style="position: relative; z-index: 10; pointer-events: auto;">
                    <i class="ri-pencil-line"></i> Tulis Ulasan Anda
                </button>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="tentang" class="section-padding tentang-bg">
        <div class="container">
            <div class="tentang-content">
                <div class="tentang-text fade-up">
                    <h3>{{ $homepageSetting->about_title ?? 'Mengenal TB Cahaya Baru' }}</h3>
                    <div class="about-desc">
                        {!! $homepageSetting->about_desc_1 ?? '<p>Berdiri sejak 2010, TB Cahaya Baru telah menjadi mitra terpercaya bagi ribuan proyek pembangunan di Indonesia. Kami berkomitmen untuk selalu menyediakan produk material bahan bangunan berkualitas tinggi dengan standar SNI dan harga yang bersaing.</p>' !!}
                    </div>
                    <div class="about-desc">
                        {!! $homepageSetting->about_desc_2 ?? '<p>Dengan pengalaman lebih dari satu dekade, kami memahami betul kebutuhan pelanggan dari skala perumahan hingga proyek komersial besar. Tim kami siap memberikan pelayanan prima dan solusi terbaik untuk setiap kebutuhan konstruksi Anda.</p>' !!}
                    </div>
                </div>
                <div class="stats-grid fade-up" style="transition-delay: 0.15s">
                    <div class="stat-card">
                        <i class="ri-history-line stat-icon"></i>
                        <div class="stat-info">
                            <h4 class="counter" data-target="{{ $homepageSetting->stat_years ?? 14 }}" data-suffix="+">0</h4>
                            <span>Tahun Beroperasi</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <i class="ri-store-3-line stat-icon"></i>
                        <div class="stat-info">
                            <h4 class="counter" data-target="{{ $homepageSetting->stat_products ?? 5000 }}" data-suffix="+">0</h4>
                            <span>Produk Tersedia</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <i class="ri-truck-line stat-icon"></i>
                        <div class="stat-info">
                            <h4 class="counter" data-target="{{ $homepageSetting->stat_suppliers ?? 50 }}" data-suffix="+">0</h4>
                            <span>Mitra Supplier</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <i class="ri-user-smile-line stat-icon"></i>
                        <div class="stat-info">
                            <h4 class="counter" data-target="{{ $homepageSetting->stat_customers ?? 10 }}" data-suffix="k+">0</h4>
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

    <!-- Stacks for partials -->
    @stack('scripts')
</body>
</html>
