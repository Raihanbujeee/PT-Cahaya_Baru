// =============================================
// Shared Cart & Checkout Logic (cart.js)
// Uses localStorage so cart persists across pages
// =============================================

var formatRp = (angka) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);

let cartState = {
    cart: JSON.parse(localStorage.getItem('cart') || '[]'),
    services: [] // array of { id, name, type, price, price_per_km, product_id, qty, distance }
};

let allServices = []; // master data from API

function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cartState.cart));
}

// ----------------------
// Initialization
// ----------------------
document.addEventListener('DOMContentLoaded', () => {
    updateCartCount();
    fetchServices();
});

async function fetchServices() {
    try {
        // Read directly from the global variable injected by Laravel (No API fetch needed)
        allServices = window.allServicesData || [];
    } catch (e) {
        console.warn('Could not load services:', e);
        allServices = [];
    }
}

// ----------------------
// Cart Functions
// ----------------------
window.addToCart = function(id) {
    const product = typeof getProductById === 'function' ? getProductById(id) : null;
    if (!product) { console.error("Product not found for id:", id); return; }

    if (product.stock !== 'Tersedia') {
        alert('Maaf, stok produk sedang habis.');
        return;
    }

    const existingItem = cartState.cart.find(item => item.id === id);
    if (existingItem) {
        existingItem.qty += 1;
    } else {
        cartState.cart.push({ ...product, qty: 1 });
    }

    saveCart();
    updateCartCount();

    const btn = event.currentTarget;
    if (btn) {
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<i class="ri-check-line"></i>';
        setTimeout(() => { btn.innerHTML = originalHtml; }, 1000);
    }
}

window.updateCartCount = function() {
    const countBadge = document.getElementById('cart-count');
    if (countBadge) {
        const total = cartState.cart.reduce((sum, item) => sum + item.qty, 0);
        countBadge.textContent = total;
        countBadge.style.display = total > 0 ? 'flex' : 'none';
    }
}

// ----------------------
// Modal Functions
// ----------------------
window.openCheckoutModal = function() {
    renderCartItems();
    renderServiceList();
    updateGrandTotal();
    document.getElementById('checkout-modal').classList.add('active');
}

window.closeCheckoutModal = function() {
    document.getElementById('checkout-modal').classList.remove('active');
}

// ----------------------
// Cart Items Render
// ----------------------
window.renderCartItems = function() {
    const container = document.getElementById('cart-items');
    if (!container) return;

    if (cartState.cart.length === 0) {
        container.innerHTML = `
            <div class="empty-cart-msg">
                <i class="ri-shopping-cart-2-line"></i>
                <p>Keranjang belanja Anda masih kosong.</p>
            </div>
        `;
        updateGrandTotal();
        return;
    }

    container.innerHTML = cartState.cart.map((item, index) => `
        <div class="cart-item">
            <img src="${item.image}" alt="${item.name}" class="cart-item-img">
            <div class="cart-item-info">
                <div class="cart-item-title">${item.name}</div>
                <div class="cart-item-price">${formatRp(item.price)}</div>
            </div>
            <div class="cart-item-qty">
                <button class="qty-btn" onclick="updateCartQty(${index}, -1)">-</button>
                <input type="text" class="qty-input" value="${item.qty}" readonly>
                <button class="qty-btn" onclick="updateCartQty(${index}, 1)">+</button>
            </div>
            <button class="btn-remove-item" onclick="removeFromCart(${index})"><i class="ri-delete-bin-line"></i></button>
        </div>
    `).join('');

    updateGrandTotal();
}

window.updateCartQty = function(index, change) {
    const item = cartState.cart[index];
    item.qty += change;
    if (item.qty <= 0) cartState.cart.splice(index, 1);
    saveCart();
    updateCartCount();
    renderCartItems();
    renderServiceList(); // Refresh service list since product dependency might have changed
}

window.removeFromCart = function(index) {
    cartState.cart.splice(index, 1);
    saveCart();
    updateCartCount();
    renderCartItems();
    renderServiceList(); // Refresh service list since product dependency might have changed
}

// ----------------------
// Service List Render
// ----------------------
window.renderServiceList = function() {
    const container = document.getElementById('service-list');
    if (!container) return;

    if (allServices.length === 0) {
        container.innerHTML = `<p style="color:var(--text-muted);font-size:14px;">Tidak ada data jasa tersedia.</p>`;
        return;
    }

    // Group services by type
    const grouped = { pemasangan: [], pengantaran: [], lainnya: [] };
    allServices.forEach(s => {
        const type = s.type || 'lainnya';
        if (!grouped[type]) grouped[type] = [];
        grouped[type].push(s);
    });

    // Filter pemasangan: only show services linked to products currently in cart
    const cartProductIds = cartState.cart.map(item => item.id);
    const relevantPemasangan = grouped.pemasangan.filter(s => 
        s.product_id && cartProductIds.includes(s.product_id)
    );

    // Auto-remove pemasangan services from cartState.services if the product was removed from cart
    cartState.services = cartState.services.filter(cs => {
        if (cs.type === 'pemasangan' && cs.product_id) {
            return cartProductIds.includes(cs.product_id);
        }
        return true;
    });

    let html = '';

    // ── Pemasangan ──
    if (relevantPemasangan.length > 0) {
        html += `<div class="service-group">
            <div class="service-group-title"><i class="ri-tools-line"></i> Jasa Pemasangan</div>
            <p class="service-group-desc">Biaya pemasangan sesuai produk di keranjang Anda</p>`;
        relevantPemasangan.forEach(service => {
            const inCart = cartState.services.find(s => s.id === service.id);
            const qty = inCart ? inCart.qty : 0;
            const productName = service.product ? service.product.name : '-';
            const priceLabel = formatRp(service.price) + ' / unit';
            html += `
                <div class="service-item" id="service-item-${service.id}">
                    <div class="service-item-info">
                        <div class="service-item-name">${service.name}</div>
                        <div class="service-item-price">${priceLabel}</div>
                        <div class="service-item-desc">Untuk: ${productName}</div>
                        ${service.description ? `<div class="service-item-desc">${service.description}</div>` : ''}
                    </div>
                    <div class="service-item-actions">
                        ${qty === 0
                            ? `<button class="btn-add-service" onclick="addService(${service.id})"><i class="ri-add-line"></i> Tambah</button>`
                            : `<div class="cart-item-qty">
                                <button class="qty-btn" onclick="updateServiceQty(${service.id}, -1)">-</button>
                                <input type="text" class="qty-input" value="${qty}" readonly>
                                <button class="qty-btn" onclick="updateServiceQty(${service.id}, 1)">+</button>
                               </div>`
                        }
                    </div>
                </div>`;
        });
        html += `</div>`;
    }

    // ── Pengantaran ──
    if (grouped.pengantaran.length > 0) {
        html += `<div class="service-group">
            <div class="service-group-title"><i class="ri-truck-line"></i> Jasa Pengantaran</div>
            <p class="service-group-desc">Biaya dihitung berdasarkan jarak pengiriman</p>`;
        grouped.pengantaran.forEach(service => {
            const inCart = cartState.services.find(s => s.id === service.id);
            const isSelected = inCart ? true : false;
            const distance = inCart ? (inCart.distance || 0) : 0;
            const baseFee = parseFloat(service.price) || 0;
            const perKm = parseFloat(service.price_per_km) || 0;
            const totalDelivery = isSelected ? (baseFee + (perKm * distance)) : 0;

            html += `
                <div class="service-item delivery-item ${isSelected ? 'selected' : ''}" id="service-item-${service.id}">
                    <div class="service-item-info" style="flex:1;">
                        <div class="service-item-name">${service.name}</div>
                        <div class="service-item-price">Base: ${formatRp(baseFee)} + ${formatRp(perKm)}/km</div>
                        ${service.description ? `<div class="service-item-desc">${service.description}</div>` : ''}
                        ${isSelected ? `
                            <div class="delivery-distance-row">
                                <label>Jarak (km):</label>
                                <input type="number" class="distance-input" min="0" step="0.5" value="${distance}"
                                       onchange="updateDeliveryDistance(${service.id}, this.value)"
                                       oninput="updateDeliveryDistance(${service.id}, this.value)"
                                       placeholder="0">
                                <span class="delivery-cost-label">= ${formatRp(totalDelivery)}</span>
                            </div>
                        ` : ''}
                    </div>
                    <div class="service-item-actions">
                        ${!isSelected
                            ? `<button class="btn-add-service" onclick="addDeliveryService(${service.id})"><i class="ri-add-line"></i> Pilih</button>`
                            : `<button class="btn-remove-service" onclick="removeDeliveryService(${service.id})"><i class="ri-close-line"></i> Hapus</button>`
                        }
                    </div>
                </div>`;
        });
        html += `</div>`;
    }

    // ── Lainnya ──
    if (grouped.lainnya.length > 0) {
        html += `<div class="service-group">
            <div class="service-group-title"><i class="ri-service-line"></i> Layanan Lainnya</div>`;
        grouped.lainnya.forEach(service => {
            const inCart = cartState.services.find(s => s.id === service.id);
            const qty = inCart ? inCart.qty : 0;
            const priceLabel = (parseFloat(service.price) === 0) ? 'Gratis' : formatRp(service.price);
            html += `
                <div class="service-item" id="service-item-${service.id}">
                    <div class="service-item-info">
                        <div class="service-item-name">${service.name}</div>
                        <div class="service-item-price">${priceLabel}</div>
                        ${service.description ? `<div class="service-item-desc">${service.description}</div>` : ''}
                    </div>
                    <div class="service-item-actions">
                        ${qty === 0
                            ? `<button class="btn-add-service" onclick="addService(${service.id})"><i class="ri-add-line"></i> Tambah</button>`
                            : `<div class="cart-item-qty">
                                <button class="qty-btn" onclick="updateServiceQty(${service.id}, -1)">-</button>
                                <input type="text" class="qty-input" value="${qty}" readonly>
                                <button class="qty-btn" onclick="updateServiceQty(${service.id}, 1)">+</button>
                               </div>`
                        }
                    </div>
                </div>`;
        });
        html += `</div>`;
    }

    container.innerHTML = html;
}

// ── Service add/update/remove ──

window.addService = function(id) {
    const service = allServices.find(s => s.id === id);
    if (!service) return;

    const existing = cartState.services.find(s => s.id === id);
    if (existing) {
        existing.qty += 1;
    } else {
        cartState.services.push({ ...service, qty: 1, distance: 0 });
    }
    renderServiceList();
    updateGrandTotal();
}

window.updateServiceQty = function(id, change) {
    const idx = cartState.services.findIndex(s => s.id === id);
    if (idx === -1) return;
    cartState.services[idx].qty += change;
    if (cartState.services[idx].qty <= 0) {
        cartState.services.splice(idx, 1);
    }
    renderServiceList();
    updateGrandTotal();
}

// ── Delivery-specific ──

window.addDeliveryService = function(id) {
    const service = allServices.find(s => s.id === id);
    if (!service) return;

    // Remove other delivery services (only one can be active)
    cartState.services = cartState.services.filter(s => {
        const master = allServices.find(m => m.id === s.id);
        return !master || master.type !== 'pengantaran';
    });

    cartState.services.push({ ...service, qty: 1, distance: 0 });
    renderServiceList();
    updateGrandTotal();
}

window.removeDeliveryService = function(id) {
    cartState.services = cartState.services.filter(s => s.id !== id);
    renderServiceList();
    updateGrandTotal();
}

window.updateDeliveryDistance = function(id, value) {
    const svc = cartState.services.find(s => s.id === id);
    if (!svc) return;
    svc.distance = Math.max(0, parseFloat(value) || 0);

    // Update the cost label inline without full re-render
    const baseFee = parseFloat(svc.price) || 0;
    const perKm = parseFloat(svc.price_per_km) || 0;
    const total = baseFee + (perKm * svc.distance);

    const item = document.getElementById('service-item-' + id);
    if (item) {
        const label = item.querySelector('.delivery-cost-label');
        if (label) label.textContent = '= ' + formatRp(total);
    }

    updateGrandTotal();
}

// ----------------------
// Grand Total Calculator
// ----------------------
window.updateGrandTotal = function() {
    const productTotal = cartState.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);

    let serviceTotal = 0;
    cartState.services.forEach(svc => {
        const type = svc.type || 'lainnya';
        if (type === 'pengantaran') {
            const baseFee = parseFloat(svc.price) || 0;
            const perKm = parseFloat(svc.price_per_km) || 0;
            const distance = parseFloat(svc.distance) || 0;
            serviceTotal += baseFee + (perKm * distance);
        } else {
            serviceTotal += (parseFloat(svc.price) * svc.qty);
        }
    });

    const grandTotal = productTotal + serviceTotal;

    const elProduct = document.getElementById('cart-product-total');
    const elService  = document.getElementById('cart-service-total');
    const elTotal    = document.getElementById('cart-total');

    if (elProduct) elProduct.textContent = formatRp(productTotal);
    if (elService)  elService.textContent  = formatRp(serviceTotal);
    if (elTotal)    elTotal.textContent    = formatRp(grandTotal);
}

// ----------------------
// Checkout Submit
// ----------------------
window.submitCheckout = async function() {
    if (cartState.cart.length === 0) {
        alert('Keranjang belanja kosong!');
        return;
    }

    const name    = document.getElementById('cust-name').value.trim();
    const phone   = document.getElementById('cust-phone').value.trim();
    const address = document.getElementById('cust-address').value.trim();

    if (!name || !phone || !address) {
        alert('Mohon lengkapi data pemesan (Nama, Telepon, Alamat).');
        return;
    }

    const btn = document.getElementById('btn-submit-checkout');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="ri-loader-4-line ri-spin"></i> Memproses...';
    btn.disabled = true;

    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        const baseUrl   = (window.APP_URL || '').replace(/\/$/, '');

        const payload = {
            customer_name:    name,
            customer_phone:   phone,
            customer_address: address,
            cart: cartState.cart.map(item => ({ id: item.id, qty: item.qty })),
            services: cartState.services
                .filter(s => s.qty > 0)
                .map(s => ({
                    id: s.id,
                    qty: s.qty,
                    distance: s.distance || 0,
                })),
        };

        const response = await fetch(baseUrl + '/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify(payload),
        });

        const data = await response.json();

        if (response.ok && data.success) {
            // Clear state
            cartState.cart     = [];
            cartState.services = [];
            saveCart();
            updateCartCount();
            closeCheckoutModal();

            // Set customer name into the review modal automatically
            const reviewNameInput = document.getElementById('review-name');
            if (reviewNameInput) {
                reviewNameInput.value = name;
            }

            window.open(data.wa_url, '_blank');

            // Open Review Modal after short delay to allow new tab to open
            setTimeout(() => {
                if (typeof openReviewModal === 'function') {
                    openReviewModal();
                }
            }, 500);
        } else {
            alert('Gagal memproses pesanan: ' + (data.message || 'Terjadi kesalahan pada server.'));
        }
    } catch (error) {
        console.error('Checkout error:', error);
        alert('Terjadi kesalahan koneksi.');
    } finally {
        btn.innerHTML = originalText;
        btn.disabled  = false;
    }
}
