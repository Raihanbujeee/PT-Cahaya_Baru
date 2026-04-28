<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - PT Cahaya Baru</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/detail_produk.css') }}">
</head>
<body>

    @php
        $cat = $product->category ? $product->category->name : 'Lainnya';
        $imgFallback = 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=800&q=80';
        
        if(str_contains(strtolower($cat), 'semen')) $imgFallback = 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?w=800&q=80';
        else if(str_contains(strtolower($cat), 'cat')) $imgFallback = 'https://images.unsplash.com/photo-1562259929-b7e181d8d002?w=800&q=80';
        else if(str_contains(strtolower($cat), 'besi')) $imgFallback = 'https://images.unsplash.com/photo-1590496734187-57ce3dd3045d?w=800&q=80';
        else if(str_contains(strtolower($cat), 'keramik')) $imgFallback = 'https://images.unsplash.com/photo-1523413363574-c30aa1c2a516?w=800&q=80';
        else if(str_contains(strtolower($cat), 'pipa')) $imgFallback = 'https://images.unsplash.com/photo-1621252179027-94459d278660?w=800&q=80';
        else if(str_contains(strtolower($cat), 'kabel')) $imgFallback = 'https://images.unsplash.com/photo-1558222218-b7b54eede3f3?w=800&q=80';
        else if(str_contains(strtolower($cat), 'kayu')) $imgFallback = 'https://images.unsplash.com/photo-1628744448829-01297db3c800?w=800&q=80';

        $brandName = $product->brand ? $product->brand->name : 'Unggulan';
        $description = 'Produk ' . $product->name . ' dari merek ' . $brandName . ' menawarkan kualitas terbaik untuk kebutuhan konstruksi Anda. Diproduksi dengan standar tinggi untuk menjamin ketahanan, keamanan, dan keandalan di setiap proyek pembangunan Anda.';
        
        $sku = 'CBR-PRD' . str_pad($product->id, 3, '0', STR_PAD_LEFT);
        $unit = 'pcs';
        $minOrder = '1';
        $supplier = 'PT Cahaya Baru';
        $stockLabel = $product->current_stock > 0 ? 'Tersedia' : 'Habis';
        $stockColor = $product->current_stock > 0 ? 'var(--success)' : 'var(--danger)';
        $stockIcon = $product->current_stock > 0 ? 'ri-checkbox-circle-fill' : 'ri-close-circle-fill';
        $waText = "Halo, saya tertarik dengan produk {$product->name} (SKU: {$sku})";
    @endphp

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

    <div class="page-header">
        <div class="container">
            <div class="breadcrumb">
                <a href="/">Beranda</a> <span>/</span> 
                <a href="/produk">Katalog Produk</a> <span>/</span> 
                <a href="#">{{ $cat }}</a> <span>/</span>
                <strong>{{ $product->name }}</strong>
            </div>
        </div>
    </div>

    <section class="product-detail-section">
        <div class="container">
            <div class="detail-card">
                <div class="product-img-wrap">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : $imgFallback }}" alt="{{ $product->name }}">
                </div>
                
                <div class="product-info">
                    <div>
                        <div class="product-brand">{{ $brandName }}</div>
                    </div>
                    
                    <div>
                        <h1 class="product-title">{{ $product->name }}</h1>
                        <div class="product-sku">SKU: {{ $sku }}</div>
                    </div>
                    
                    <div class="product-price-box">
                        <div class="product-price">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</div>
                        <div class="product-unit">/ {{ $unit }}</div>
                    </div>
                    
                    <div class="product-desc">
                        {{ $description }}
                    </div>
                    
                    <div class="product-specs">
                        <div class="spec-item">
                            <span class="spec-label">Kategori</span>
                            <span class="spec-val">{{ $cat }}</span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-label">Status Stok</span>
                            <span class="spec-val" style="color: {{ $stockColor }};">
                                <i class="{{ $stockIcon }}"></i> {{ $stockLabel }} ({{ $product->current_stock }})
                            </span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-label">Minimal Order</span>
                            <span class="spec-val">{{ $minOrder }} {{ $unit }}</span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-label">Supplier</span>
                            <span class="spec-val"><i class="ri-store-2-line" style="color:var(--text-muted)"></i> {{ $supplier }}</span>
                        </div>
                    </div>
                    
                    <div class="product-actions">
                        <a href="/produk" class="btn btn-outline" style="padding: 15px 30px; border-radius: 8px; font-weight: 600; text-align: center; border: 1px solid var(--border-color); color: var(--text-dark); transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="ri-arrow-left-line"></i> Kembali
                        </a>
                        <a href="https://wa.me/6283834079959?text={{ urlencode($waText) }}" target="_blank" class="btn-wa">
                            <i class="ri-whatsapp-line" style="font-size: 20px;"></i> Pesan via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Script -->
    <script src="{{ asset('js/detail_produk.js') }}"></script>
</body>
</html>
