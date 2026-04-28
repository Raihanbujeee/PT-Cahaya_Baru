<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Katalog Produk - PT Cahaya Baru</title>
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/produk.css') }}">
</head>

<body>

    <!-- Header -->
    <header>
        <div class="container navbar">
            <a href="/" class="logo">
                <i class="ri-building-4-fill"></i> PT Cahaya Baru
            </a>
            <nav class="nav-links">
                <a href="/#beranda">Beranda</a>
                <a href="/produk">Produk</a>
                <a href="/#layanan">Jasa & Layanan</a>
                <a href="/#tentang">Tentang Kami</a>
                <a href="/#kontak">Kontak</a>
                <a href="https://wa.me/6283834079959" class="btn btn-primary" target="_blank">Hubungi Kami</a>
            </nav>

            <button class="mobile-menu-btn" aria-label="Menu">
                <i class="ri-menu-line"></i>
            </button>
        </div>
    </header>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <div class="breadcrumb">
                <a href="/">Beranda</a> <span>/</span> <strong>Produk</strong>
            </div>
            <div class="page-title-wrap">
                <h1 class="page-title">Katalog Produk</h1>
                <span class="product-count" id="count-badge">0 Produk</span>
            </div>
            <p class="page-subtitle">Temukan berbagai kebutuhan material bangunan terbaik untuk proyek Anda.</p>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="filter-section">
        <div class="container">
            <div class="filter-controls">
                <div class="search-box">
                    <i class="ri-search-line"></i>
                    <input type="text" id="searchInput" placeholder="Cari produk atau merk...">
                </div>

                <select class="select-box" id="merkFilter">
                    <option value="">Semua Merk</option>
                    <option value="Holcim">Holcim</option>
                    <option value="Dulux">Dulux</option>
                    <option value="Tiga Roda">Tiga Roda</option>
                    <option value="Sika">Sika</option>
                    <option value="Jayaboard">Jayaboard</option>
                </select>

                <select class="select-box" id="stokFilter">
                    <option value="">Semua Stok</option>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Habis">Habis</option>
                </select>

                <select class="select-box" id="sortFilter" style="margin-left: auto;">
                    <option value="newest">Terbaru</option>
                    <option value="price_asc">Harga Terendah</option>
                    <option value="price_desc">Harga Tertinggi</option>
                    <option value="popular">Terlaris</option>
                </select>
            </div>

            <div class="active-filters" id="activeFilters">
                <!-- Chips rendered here -->
            </div>

            <div class="category-pills" id="categoryTabs">
                <button class="pill active" data-category="">Semua</button>
                <button class="pill" data-category="Semen">Semen</button>
                <button class="pill" data-category="Cat">Cat</button>
                <button class="pill" data-category="Besi">Besi</button>
                <button class="pill" data-category="Kayu">Kayu</button>
                <button class="pill" data-category="Pipa">Pipa</button>
                <button class="pill" data-category="Keramik">Keramik</button>
                <button class="pill" data-category="Alat Listrik">Alat Listrik</button>
                <button class="pill" data-category="Sanitasi">Sanitasi</button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="catalog-content container">
        <div class="product-grid" id="productGrid">
            <!-- Products rendered here -->
        </div>

        <div class="empty-state" id="emptyState">
            <i class="ri-search-eye-line"></i>
            <h3>Produk Tidak Ditemukan</h3>
            <p>Maaf, kami tidak dapat menemukan produk yang sesuai dengan filter pencarian Anda.</p>
            <button class="btn-clear" onclick="clearAllFilters()">Tampilkan Semua Produk</button>
        </div>

        <div class="pagination" id="pagination">
            <!-- Pagination rendered here -->
        </div>
    </div>



    <!-- Script -->
    <script>
        // Product Data from Database
        const dbProducts = {!! json_encode($products->map(function ($p) {
    $cat = $p->category ? $p->category->name : 'Lainnya';
    $imgFallback = 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=500&q=80';

    if (str_contains(strtolower($cat), 'semen'))
        $imgFallback = 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?w=500&q=80';
    else if (str_contains(strtolower($cat), 'cat'))
        $imgFallback = 'https://images.unsplash.com/photo-1562259929-b7e181d8d002?w=500&q=80';
    else if (str_contains(strtolower($cat), 'besi'))
        $imgFallback = 'https://images.unsplash.com/photo-1590496734187-57ce3dd3045d?w=500&q=80';
    else if (str_contains(strtolower($cat), 'keramik'))
        $imgFallback = 'https://images.unsplash.com/photo-1523413363574-c30aa1c2a516?w=500&q=80';
    else if (str_contains(strtolower($cat), 'pipa'))
        $imgFallback = 'https://images.unsplash.com/photo-1621252179027-94459d278660?w=500&q=80';
    else if (str_contains(strtolower($cat), 'kabel'))
        $imgFallback = 'https://images.unsplash.com/photo-1558222218-b7b54eede3f3?w=500&q=80';
    else if (str_contains(strtolower($cat), 'kayu'))
        $imgFallback = 'https://images.unsplash.com/photo-1628744448829-01297db3c800?w=500&q=80';

    return [
        'id' => $p->id,
        'name' => $p->name,
        'category' => $cat,
        'brand' => $p->brand ? $p->brand->name : 'No Brand',
        'stock' => $p->current_stock > 0 ? 'Tersedia' : 'Habis',
        'sku' => 'CBR-PRD' . str_pad($p->id, 3, '0', STR_PAD_LEFT),
        'price' => (float) $p->selling_price,
        'unit' => 'pcs',
        'minOrder' => '1',
        'supplier' => 'PT Cahaya Baru',
        'image' => $imgFallback,
        'description' => 'Produk ' . $p->name . ' dari merek ' . ($p->brand ? $p->brand->name : 'unggulan') . ' menawarkan kualitas terbaik untuk kebutuhan konstruksi Anda. Diproduksi dengan standar tinggi untuk menjamin ketahanan, keamanan, dan keandalan di setiap proyek pembangunan Anda.',
        'date' => $p->created_at->format('Y-m-d'),
        'sold' => rand(10, 500)
    ];
})) !!};

    </script>

    <!-- Scripts -->
    <script src="{{ asset('js/produk.js') }}"></script>
</body>

</html>