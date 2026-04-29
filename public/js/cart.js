// =============================================
// Shared Cart & Checkout Logic (cart.js)
// Uses localStorage so cart persists across pages
// =============================================

var formatRp = (angka) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);

let cartState = {
    cart: JSON.parse(localStorage.getItem('cart') || '[]'),
    services: [] // array of { id, name, price, description, qty }
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
        const baseUrl = (window.APP_URL || '').replace(/\/$/, '');
        const resp = await fetch(baseUrl + '/api/services');
        if (!resp.ok) throw new Error('HTTP ' + resp.status);
        allServices = await resp.json();
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
}

window.removeFromCart = function(index) {
    cartState.cart.splice(index, 1);
    saveCart();
    updateCartCount();
    renderCartItems();
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

    container.innerHTML = allServices.map(service => {
        const inCart = cartState.services.find(s => s.id === service.id);
        const qty = inCart ? inCart.qty : 0;
        const priceLabel = (parseFloat(service.price) === 0) ? 'Gratis' : formatRp(service.price);
        return `
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
            </div>
        `;
    }).join('');
}

window.addService = function(id) {
    const service = allServices.find(s => s.id === id);
    if (!service) return;

    const existing = cartState.services.find(s => s.id === id);
    if (existing) {
        existing.qty += 1;
    } else {
        cartState.services.push({ ...service, qty: 1 });
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

// ----------------------
// Grand Total Calculator
// ----------------------
window.updateGrandTotal = function() {
    const productTotal = cartState.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
    const serviceTotal = cartState.services.reduce((sum, item) => sum + (parseFloat(item.price) * item.qty), 0);
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
                .map(s => ({ id: s.id, qty: s.qty })),
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

            window.open(data.wa_url, '_blank');
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
