<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Katalog Produk - TB Cahaya Baru</title>
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/produk.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>

<body>

    @include('partials.header', ['activePage' => 'produk'])

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
            <div class="filters-row">
                <div class="search-bar">
                    <i class="ri-search-line"></i>
                    <input type="text" id="searchInput" placeholder="Cari produk atau merk...">
                </div>

                <select class="select-box" id="merkFilter">
                    <option value="">Semua Merk</option>
                    @foreach($products->pluck('brand')->filter()->unique() as $brand)
                        <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                    @endforeach
                </select>

                <select class="select-box" id="stokFilter">
                    <option value="">Semua Stok</option>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Habis">Habis</option>
                </select>

                <select class="select-box" id="sortFilter" style="margin-left: auto;">
                    <option value="terbaru">Terbaru</option>
                    <option value="termurah">Harga Terendah</option>
                    <option value="termahal">Harga Tertinggi</option>
                    <option value="terlaris">Terlaris</option>
                </select>
            </div>

            <div class="active-filters" id="activeFilters">
                <!-- Chips rendered here -->
            </div>

            <div class="category-pills" id="categoryTabs">
                <button class="pill active" data-category="">Semua</button>
                @foreach($products->pluck('category')->filter()->unique() as $cat)
                    <button class="pill" data-category="{{ $cat->name }}">{{ $cat->name }}</button>
                @endforeach
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
        window.APP_URL = "{{ url('/') }}";
        const dbProducts = {!! json_encode($products->map(function ($p) {
    $cat = $p->category ? $p->category->name : 'Lainnya';
    $imgFallback = 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=500&q=80';

    return [
        'id' => $p->id,
        'name' => $p->name,
        'category' => $cat,
        'brand' => $p->brand ? $p->brand->name : 'No Brand',
        'stock' => $p->current_stock > 0 ? 'Tersedia' : 'Habis',
        'price' => (float) $p->selling_price,
        'unit' => 'pcs',
        'minOrder' => '1',
        'supplier' => 'TB Cahaya Baru',
        'image' => $p->image ? asset('storage/' . $p->image) : $imgFallback,
        'description' => 'Produk ' . $p->name . ' dari merek ' . ($p->brand ? $p->brand->name : 'unggulan') . ' menawarkan kualitas terbaik untuk kebutuhan konstruksi Anda. Diproduksi dengan standar tinggi untuk menjamin ketahanan, keamanan, dan keandalan di setiap proyek pembangunan Anda.',
        'date' => $p->created_at ? $p->created_at->format('Y-m-d') : now()->format('Y-m-d'),
        'sold' => rand(10, 500)
    ];
})) !!};

    </script>

    <!-- Floating Cart Button -->
    <div id="floating-cart" class="floating-cart" onclick="openCheckoutModal()">
        <i class="ri-shopping-cart-2-fill"></i>
        <span id="cart-count" class="cart-count">0</span>
    </div>

    <!-- Checkout Modal -->
    <div id="checkout-modal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Keranjang Belanja</h2>
                <button class="btn-close-modal" onclick="closeCheckoutModal()"><i class="ri-close-line"></i></button>
            </div>
            <div class="modal-body">
                <!-- Produk -->
                <div id="cart-items" class="cart-items-container">
                    <!-- Cart items will be rendered here -->
                </div>
                <div class="cart-summary">
                    <div class="summary-row">
                        <span>Total Produk</span>
                        <span id="cart-product-total">Rp 0</span>
                    </div>
                    <div class="summary-row">
                        <span>Total Jasa</span>
                        <span id="cart-service-total">Rp 0</span>
                    </div>
                    <div class="summary-row total">
                        <span>Grand Total</span>
                        <span id="cart-total">Rp 0</span>
                    </div>
                </div>

                <!-- Jasa / Layanan -->
                <div class="checkout-form">
                    <h3>Tambah Jasa / Layanan <span
                            style="font-size:12px;font-weight:400;color:var(--text-muted);">(Opsional)</span></h3>
                    <div id="service-list" class="service-list">
                        <p style="color:var(--text-muted);font-size:14px;">Memuat daftar jasa...</p>
                    </div>
                </div>

                <!-- Data Pemesan -->
                <div class="checkout-form">
                    <h3>Data Pemesan</h3>
                    <div class="form-group">
                        <label for="cust-name">Nama Lengkap</label>
                        <input type="text" id="cust-name" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="form-group">
                        <label for="cust-phone">Nomor Telepon (WA)</label>
                        <input type="text" id="cust-phone" placeholder="Contoh: 08123456789" required>
                    </div>
                    <div class="form-group">
                        <label for="cust-address">Alamat Pengiriman</label>
                        <textarea id="cust-address" rows="3" placeholder="Masukkan alamat lengkap pengiriman"
                            required></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" onclick="closeCheckoutModal()">Kembali</button>
                <button class="btn btn-primary" id="btn-submit-checkout" onclick="submitCheckout()">Checkout Sekarang <i
                        class="ri-whatsapp-line"></i></button>
            </div>
        </div>
    </div>

    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('js/produk.js') }}"></script>
</body>

</html>