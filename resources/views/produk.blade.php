<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Katalog Produk - PT Cahaya Baru</title>
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Styles -->
    <style>
        /* Shared Styles */
        :root {
            --primary: #854F0B; /* Warm Amber/Orange */
            --primary-hover: #6a3e08;
            --bg-white: #FFFFFF;
            --bg-beige: #F5F2EB;
            --text-dark: #3E2723;
            --text-muted: #6D4C41;
            --border-color: #E8E0D5;
            --shadow-sm: 0 2px 4px rgba(62, 39, 35, 0.05);
            --shadow-md: 0 4px 6px rgba(62, 39, 35, 0.07);
            --shadow-lg: 0 10px 15px rgba(62, 39, 35, 0.1);
            --success: #2e7d32;
            --success-bg: #e8f5e9;
            --danger: #c62828;
            --danger-bg: #ffebee;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #FAFAFA; color: var(--text-dark); line-height: 1.6; }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        
        /* Navbar */
        header { background-color: var(--bg-white); box-shadow: var(--shadow-sm); position: sticky; top: 0; z-index: 1000; }
        .navbar { display: flex; justify-content: space-between; align-items: center; height: 70px; }
        .logo { font-size: 20px; font-weight: 800; color: var(--primary); display: flex; align-items: center; gap: 8px; }
        .nav-links { display: flex; gap: 20px; align-items: center; }
        .btn-home { border: 1px solid var(--border-color); padding: 8px 16px; border-radius: 8px; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 6px; transition: all 0.2s;}
        .btn-home:hover { background: var(--bg-beige); border-color: var(--primary); color: var(--primary); }

        /* Page Header */
        .page-header { padding: 40px 0 20px; background: var(--bg-white); border-bottom: 1px solid var(--border-color); }
        .breadcrumb { font-size: 14px; color: var(--text-muted); margin-bottom: 15px; }
        .breadcrumb a:hover { color: var(--primary); }
        .breadcrumb span { margin: 0 8px; }
        .page-title-wrap { display: flex; align-items: center; gap: 15px; margin-bottom: 10px; flex-wrap: wrap;}
        .page-title { font-size: 32px; font-weight: 800; color: var(--text-dark); }
        .product-count { background: var(--bg-beige); color: var(--primary); padding: 4px 12px; border-radius: 20px; font-size: 14px; font-weight: 600; }
        .page-subtitle { color: var(--text-muted); font-size: 16px; }

        /* Filter Section (Sticky) */
        .filter-section { position: sticky; top: 70px; background: var(--bg-white); z-index: 999; padding: 20px 0; border-bottom: 1px solid var(--border-color); box-shadow: var(--shadow-sm); }
        .filter-controls { display: flex; gap: 15px; flex-wrap: wrap; align-items: center; margin-bottom: 15px; }
        
        .search-box { position: relative; flex-grow: 1; min-width: 250px; }
        .search-box i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 18px;}
        .search-box input { width: 100%; padding: 12px 15px 12px 42px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 14px; transition: all 0.3s; }
        .search-box input:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(133, 79, 11, 0.1); }
        
        .select-box { padding: 12px 15px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 14px; background: white; color: var(--text-dark); cursor: pointer; min-width: 150px; transition: border 0.3s; }
        .select-box:focus, .select-box:hover { outline: none; border-color: var(--primary); }

        .active-filters { display: flex; gap: 10px; flex-wrap: wrap; min-height: 24px; }
        .filter-chip { background: var(--bg-beige); border: 1px solid var(--border-color); padding: 4px 12px; border-radius: 20px; font-size: 13px; display: flex; align-items: center; gap: 8px; color: var(--primary); font-weight: 500;}
        .filter-chip button { background: none; border: none; color: var(--primary); cursor: pointer; display: flex; align-items: center; font-size: 16px;}
        .filter-chip button:hover { color: var(--danger); }

        /* Category Pills */
        .category-pills { display: flex; gap: 10px; overflow-x: auto; padding: 5px 0 10px; margin-top: 15px; scrollbar-width: none; }
        .category-pills::-webkit-scrollbar { display: none; }
        .pill { padding: 10px 24px; border-radius: 30px; border: 1px solid var(--border-color); background: white; font-size: 14px; font-weight: 600; color: var(--text-muted); cursor: pointer; transition: all 0.2s; white-space: nowrap; }
        .pill:hover { background: var(--bg-beige); border-color: var(--primary); color: var(--primary); }
        .pill.active { background: var(--primary); color: white; border-color: var(--primary); box-shadow: var(--shadow-sm); }

        /* Catalog Layout */
        .catalog-content { padding: 40px 0 80px; }
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 24px; }
        
        /* Product Card */
        .card { background: white; border: 1px solid var(--border-color); border-radius: 12px; overflow: hidden; display: flex; flex-direction: column; transition: transform 0.3s, box-shadow 0.3s; position: relative; }
        .card:hover { transform: translateY(-5px); box-shadow: var(--shadow-md); border-color: var(--primary); }
        
        .card-img-wrap { position: relative; padding-top: 100%; background: #f9f9f9; border-bottom: 1px solid var(--border-color); }
        .card-img-wrap img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; }
        
        .badge-category { position: absolute; top: 12px; left: 12px; background: var(--primary); color: white; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; box-shadow: var(--shadow-sm); }
        .badge-stock { position: absolute; top: 12px; right: 12px; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 700; box-shadow: var(--shadow-sm); }
        .stock-in { background: var(--success-bg); color: var(--success); }
        .stock-out { background: var(--danger-bg); color: var(--danger); }

        .card-body { padding: 20px; flex-grow: 1; display: flex; flex-direction: column; }
        .card-brand { font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; font-weight: 700; }
        .card-title { font-size: 16px; font-weight: 700; margin-bottom: 8px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .card-sku { font-size: 12px; color: var(--text-muted); margin-bottom: 12px; font-family: monospace; background: var(--bg-beige); padding: 2px 6px; border-radius: 4px; align-self: flex-start;}
        
        .card-price-wrap { margin-top: auto; margin-bottom: 15px; }
        .card-price { font-size: 20px; font-weight: 800; color: var(--primary); }
        .card-unit { font-size: 13px; color: var(--text-muted); font-weight: 500; }
        
        .card-meta { display: flex; justify-content: space-between; font-size: 12px; color: var(--text-muted); padding-top: 15px; border-top: 1px dashed var(--border-color); margin-bottom: 20px; }
        .card-meta span { display: flex; align-items: center; gap: 4px; }
        .card-meta i { font-size: 14px; }
        
        .card-actions { display: grid; grid-template-columns: 1fr auto; gap: 10px; }
        .btn-detail { background: transparent; border: 1px solid var(--primary); color: var(--primary); padding: 10px; border-radius: 8px; font-weight: 600; text-align: center; transition: all 0.2s; font-size: 14px; cursor: pointer;}
        .btn-detail:hover { background: var(--bg-beige); }
        .btn-wa-card { background: #25D366; color: white; border: none; width: 42px; height: 42px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; transition: all 0.2s; cursor: pointer; box-shadow: var(--shadow-sm);}
        .btn-wa-card:hover { background: #128C7E; transform: scale(1.05); }

        /* Empty State */
        .empty-state { text-align: center; padding: 60px 20px; background: white; border-radius: 12px; border: 1px dashed var(--border-color); grid-column: 1 / -1; display: none; box-shadow: var(--shadow-sm); }
        .empty-state i { font-size: 64px; color: var(--border-color); margin-bottom: 15px; display: block; }
        .empty-state h3 { font-size: 20px; margin-bottom: 10px; font-weight: 700;}
        .empty-state p { color: var(--text-muted); margin-bottom: 20px;}
        .btn-clear { background: var(--primary); border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; color: white; cursor: pointer; transition: 0.2s;}
        .btn-clear:hover { background: var(--primary-hover); }

        /* Pagination */
        .pagination { display: flex; justify-content: center; gap: 8px; margin-top: 50px; }
        .page-btn { width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border: 1px solid var(--border-color); background: white; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s; color: var(--text-dark);}
        .page-btn:hover:not(:disabled) { border-color: var(--primary); color: var(--primary); background: var(--bg-beige); }
        .page-btn.active { background: var(--primary); color: white; border-color: var(--primary); box-shadow: var(--shadow-sm);}
        .page-btn:disabled { opacity: 0.5; cursor: not-allowed; background: var(--bg-beige); }

        @media (max-width: 768px) {
            .filter-controls { flex-direction: column; align-items: stretch; }
            .search-box { width: 100%; }
            .select-box { width: 100%; }
            #sortFilter { margin-left: 0 !important; }
            .card-actions { grid-template-columns: 1fr; }
            .btn-wa-card { width: 100%; justify-content: center; gap: 8px;}
            .btn-wa-card::after { content: 'Tanya WhatsApp'; font-size: 14px; font-weight: 600;}
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="container navbar">
            <a href="/" class="logo">
                <i class="ri-building-4-fill"></i> PT Cahaya Baru
            </a>
            <div class="nav-links">
                <a href="/" class="btn-home"><i class="ri-arrow-left-line"></i> Beranda</a>
            </div>
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
        const dbProducts = {!! json_encode($products->map(function($p) {
            $cat = $p->category ? $p->category->name : 'Lainnya';
            $imgFallback = 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=500&q=80';
            
            if(str_contains(strtolower($cat), 'semen')) $imgFallback = 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?w=500&q=80';
            else if(str_contains(strtolower($cat), 'cat')) $imgFallback = 'https://images.unsplash.com/photo-1562259929-b7e181d8d002?w=500&q=80';
            else if(str_contains(strtolower($cat), 'besi')) $imgFallback = 'https://images.unsplash.com/photo-1590496734187-57ce3dd3045d?w=500&q=80';
            else if(str_contains(strtolower($cat), 'keramik')) $imgFallback = 'https://images.unsplash.com/photo-1523413363574-c30aa1c2a516?w=500&q=80';
            else if(str_contains(strtolower($cat), 'pipa')) $imgFallback = 'https://images.unsplash.com/photo-1621252179027-94459d278660?w=500&q=80';
            else if(str_contains(strtolower($cat), 'kabel')) $imgFallback = 'https://images.unsplash.com/photo-1558222218-b7b54eede3f3?w=500&q=80';
            else if(str_contains(strtolower($cat), 'kayu')) $imgFallback = 'https://images.unsplash.com/photo-1628744448829-01297db3c800?w=500&q=80';

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
                'date' => $p->created_at->format('Y-m-d'),
                'sold' => rand(10, 500)
            ];
        })) !!};

        // State
        let state = {
            search: '',
            category: '',
            brand: '',
            stock: '',
            sort: 'newest',
            page: 1,
            perPage: 8
        };

        const formatRp = (num) => {
            return 'Rp ' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        };

        function renderProducts() {
            // Filter
            let filtered = dbProducts.filter(p => {
                let matchSearch = p.name.toLowerCase().includes(state.search.toLowerCase()) || 
                                  p.brand.toLowerCase().includes(state.search.toLowerCase()) || 
                                  p.sku.toLowerCase().includes(state.search.toLowerCase());
                let matchCat = state.category === '' || p.category === state.category;
                let matchBrand = state.brand === '' || p.brand === state.brand;
                let matchStock = state.stock === '' || p.stock === state.stock;
                return matchSearch && matchCat && matchBrand && matchStock;
            });

            // Sort
            if (state.sort === 'price_asc') filtered.sort((a, b) => a.price - b.price);
            else if (state.sort === 'price_desc') filtered.sort((a, b) => b.price - a.price);
            else if (state.sort === 'popular') filtered.sort((a, b) => b.sold - a.sold);
            else filtered.sort((a, b) => new Date(b.date) - new Date(a.date));

            document.getElementById('count-badge').textContent = `${filtered.length} Produk`;

            // Pagination setup
            const totalPages = Math.ceil(filtered.length / state.perPage);
            if(state.page > totalPages) state.page = Math.max(1, totalPages);
            
            const start = (state.page - 1) * state.perPage;
            const paginated = filtered.slice(start, start + state.perPage);

            const grid = document.getElementById('productGrid');
            const emptyState = document.getElementById('emptyState');

            // Render Empty State
            if (filtered.length === 0) {
                grid.style.display = 'none';
                emptyState.style.display = 'block';
                document.getElementById('pagination').innerHTML = '';
                renderActiveFilters();
                return;
            }

            // Render Grid
            grid.style.display = 'grid';
            emptyState.style.display = 'none';

            grid.innerHTML = paginated.map(p => `
                <div class="card">
                    <div class="card-img-wrap">
                        <img src="${p.image}" alt="${p.name}">
                        <span class="badge-category">${p.category}</span>
                        <span class="badge-stock ${p.stock === 'Tersedia' ? 'stock-in' : 'stock-out'}">${p.stock}</span>
                    </div>
                    <div class="card-body">
                        <div class="card-brand">${p.brand}</div>
                        <h3 class="card-title" title="${p.name}">${p.name}</h3>
                        <div class="card-sku">SKU: ${p.sku}</div>
                        <div class="card-price-wrap">
                            <span class="card-price">${formatRp(p.price)}</span>
                            <span class="card-unit">${p.unit}</span>
                        </div>
                        <div class="card-meta">
                            <span><i class="ri-box-3-line"></i> Min: ${p.minOrder}</span>
                            <span><i class="ri-store-2-line"></i> ${p.supplier}</span>
                        </div>
                        <div class="card-actions">
                            <button class="btn-detail" onclick="alert('Buka halaman detail ${p.name}')">Detail Produk</button>
                            <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20produk%20${encodeURIComponent(p.name)}%20(SKU:%20${p.sku})" target="_blank" class="btn-wa-card" title="Pesan via WhatsApp">
                                <i class="ri-whatsapp-line"></i>
                            </a>
                        </div>
                    </div>
                </div>
            `).join('');

            renderPagination(totalPages);
            renderActiveFilters();
        }

        function renderPagination(totalPages) {
            const pagination = document.getElementById('pagination');
            if(totalPages <= 1) {
                pagination.innerHTML = '';
                return;
            }

            let html = `<button class="page-btn" ${state.page === 1 ? 'disabled' : ''} onclick="changePage(${state.page - 1})"><i class="ri-arrow-left-s-line"></i></button>`;
            for(let i=1; i<=totalPages; i++) {
                html += `<button class="page-btn ${state.page === i ? 'active' : ''}" onclick="changePage(${i})">${i}</button>`;
            }
            html += `<button class="page-btn" ${state.page === totalPages ? 'disabled' : ''} onclick="changePage(${state.page + 1})"><i class="ri-arrow-right-s-line"></i></button>`;
            pagination.innerHTML = html;
        }

        function changePage(page) {
            state.page = page;
            window.scrollTo({ top: 0, behavior: 'smooth' });
            renderProducts();
        }

        function renderActiveFilters() {
            const container = document.getElementById('activeFilters');
            let chips = [];
            
            if(state.search) chips.push({ label: `Cari: "${state.search}"`, type: 'search' });
            if(state.brand) chips.push({ label: `Merk: ${state.brand}`, type: 'brand' });
            if(state.stock) chips.push({ label: `Stok: ${state.stock}`, type: 'stock' });
            if(state.category) chips.push({ label: `Kategori: ${state.category}`, type: 'category' });
            
            container.innerHTML = chips.map(c => `
                <div class="filter-chip">
                    ${c.label}
                    <button onclick="removeFilter('${c.type}')"><i class="ri-close-line"></i></button>
                </div>
            `).join('');
        }

        function removeFilter(type) {
            if(type === 'search') { state.search = ''; document.getElementById('searchInput').value = ''; }
            if(type === 'brand') { state.brand = ''; document.getElementById('merkFilter').value = ''; }
            if(type === 'stock') { state.stock = ''; document.getElementById('stokFilter').value = ''; }
            if(type === 'category') { 
                state.category = ''; 
                document.querySelectorAll('.pill').forEach(p => p.classList.remove('active'));
                document.querySelector('.pill[data-category=""]').classList.add('active');
            }
            state.page = 1;
            renderProducts();
        }

        function clearAllFilters() {
            removeFilter('search');
            removeFilter('brand');
            removeFilter('stock');
            removeFilter('category');
        }

        // Event Listeners setup
        document.getElementById('searchInput').addEventListener('input', (e) => {
            state.search = e.target.value;
            state.page = 1;
            renderProducts();
        });

        document.getElementById('merkFilter').addEventListener('change', (e) => {
            state.brand = e.target.value;
            state.page = 1;
            renderProducts();
        });

        document.getElementById('stokFilter').addEventListener('change', (e) => {
            state.stock = e.target.value;
            state.page = 1;
            renderProducts();
        });

        document.getElementById('sortFilter').addEventListener('change', (e) => {
            state.sort = e.target.value;
            state.page = 1;
            renderProducts();
        });

        document.getElementById('categoryTabs').addEventListener('click', (e) => {
            if(e.target.classList.contains('pill')) {
                document.querySelectorAll('.pill').forEach(p => p.classList.remove('active'));
                e.target.classList.add('active');
                state.category = e.target.dataset.category;
                state.page = 1;
                renderProducts();
            }
        });

        // Initialize
        renderProducts();
    </script>
</body>
</html>
