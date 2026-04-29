var formatRp = (angka) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);

let state = {
    search: '',
    brand: '',
    stock: '',
    category: '',
    sort: 'terbaru',
    page: 1,
    perPage: 12
};

function renderProducts() {
    let filtered = [...dbProducts];

    // Filter Search
    if (state.search) {
        filtered = filtered.filter(p => p.name.toLowerCase().includes(state.search.toLowerCase()));
    }

    // Filter Brand
    if (state.brand) {
        filtered = filtered.filter(p => p.brand === state.brand);
    }

    // Filter Stock
    if (state.stock) {
        filtered = filtered.filter(p => p.stock === state.stock);
    }

    // Filter Category
    if (state.category) {
        filtered = filtered.filter(p => p.category === state.category);
    }

    // Sorting
    if (state.sort === 'termurah') filtered.sort((a, b) => a.price - b.price);
    else if (state.sort === 'termahal') filtered.sort((a, b) => b.price - a.price);
    else if (state.sort === 'terlaris') filtered.sort((a, b) => b.sold - a.sold);
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
                <div class="card-price-wrap">
                    <span class="card-price">${formatRp(p.price)}</span>
                    <span class="card-unit">${p.unit}</span>
                </div>
                <div class="card-meta">
                    <span><i class="ri-box-3-line"></i> Min: ${p.minOrder}</span>
                    <span><i class="ri-store-2-line"></i> ${p.supplier}</span>
                </div>
                <div class="card-actions">
                    <a href="/produk/${p.id}" class="btn-detail" style="display:inline-block; text-decoration:none;">Detail Produk</a>
                    <button onclick="addToCart(${p.id})" class="btn-wa-card" title="Tambah ke Keranjang" style="background-color: var(--primary);">
                        <i class="ri-shopping-cart-2-line"></i>
                    </button>
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

// Make globally available for onclick html attributes
window.changePage = function(page) {
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

window.removeFilter = function(type) {
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

window.clearAllFilters = function() {
    window.removeFilter('search');
    window.removeFilter('brand');
    window.removeFilter('stock');
    window.removeFilter('category');
}

// Event Listeners setup
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('searchInput')?.addEventListener('input', (e) => {
        state.search = e.target.value;
        state.page = 1;
        renderProducts();
    });

    document.getElementById('merkFilter')?.addEventListener('change', (e) => {
        state.brand = e.target.value;
        state.page = 1;
        renderProducts();
    });

    document.getElementById('stokFilter')?.addEventListener('change', (e) => {
        state.stock = e.target.value;
        state.page = 1;
        renderProducts();
    });

    document.getElementById('sortFilter')?.addEventListener('change', (e) => {
        state.sort = e.target.value;
        state.page = 1;
        renderProducts();
    });

    document.getElementById('categoryTabs')?.addEventListener('click', (e) => {
        if(e.target.classList.contains('pill')) {
            document.querySelectorAll('.pill').forEach(p => p.classList.remove('active'));
            e.target.classList.add('active');
            state.category = e.target.dataset.category;
            state.page = 1;
            renderProducts();
        }
    });

    // Mobile Menu Toggle
    document.querySelector('.mobile-menu-btn')?.addEventListener('click', function() {
        document.querySelector('.nav-links').classList.toggle('active');
    });

    // Initialize
    if (typeof dbProducts !== 'undefined') {
        renderProducts();
    }

    window.getProductById = function(id) {
        if (typeof dbProducts !== 'undefined') {
            return dbProducts.find(p => p.id === id);
        }
        return null;
    }
});
