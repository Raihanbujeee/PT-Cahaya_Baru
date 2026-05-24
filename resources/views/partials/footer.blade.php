<!-- ── FOOTER ── -->
<footer id="kontak">
    <div class="container">
        <div class="footer-grid">

            <div class="footer-about">
                <div class="logo">TB Cahaya Baru</div>
                <p>Pusat perbelanjaan bahan bangunan terlengkap dan termurah. Menjadi solusi utama untuk segala kebutuhan proyek konstruksi Anda.</p>
                <div class="social-icons">
                    <a href="#"><i class="ri-facebook-fill"></i></a>
                    <a href="#"><i class="ri-instagram-line"></i></a>
                    <a href="#"><i class="ri-twitter-x-line"></i></a>
                    <a href="#"><i class="ri-youtube-fill"></i></a>
                </div>
            </div>

            <div class="footer-links">
                <h4>Tautan Cepat</h4>
                <ul>
                    <li><a href="/">Beranda</a></li>
                    <li><a href="/produk">Katalog Produk</a></li>
                    <li><a href="/layanan">Layanan Kami</a></li>
                    <li><a href="/tentang-kami">Profil Perusahaan</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h4>Bantuan</h4>
                <ul>
                    <li><a href="#">Cara Pembelian</a></li>
                    <li><a href="#">Syarat &amp; Ketentuan</a></li>
                    <li><a href="#">Kebijakan Retur</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>

            <div class="footer-contact">
                <h4>Kontak Kami</h4>
                <ul>
                    <li>
                        <i class="ri-map-pin-fill"></i>
                        <span>Jl. Saxophone No.65, Tunggulwulung, Kec. Lowokwaru, Kota Malang, Jawa Timur 65143</span>
                    </li>
                    <li>
                        <i class="ri-phone-fill"></i>
                        <span>0838-3407-9959</span>
                    </li>
                    <li>
                        <i class="ri-mail-fill"></i>
                        <span>info@ptcahayabaru.com</span>
                    </li>
                    <li>
                        <i class="ri-time-fill"></i>
                        <span>Senin - Sabtu: 08:00 - 17:00</span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} TB Cahaya Baru. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Review Modal -->
<div class="modal-overlay" id="review-modal">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header">
            <h2>Tulis Ulasan</h2>
            <button class="btn-close-modal" onclick="closeReviewModal()"><i class="ri-close-line"></i></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Nama Anda</label>
                <input type="text" id="review-name" class="form-control" placeholder="Masukkan nama">
            </div>
            <div class="form-group" style="margin-top: 15px;">
                <label>Rating</label>
                <div class="rating-input" id="review-rating-input" style="font-size: 24px; color: #ccc; cursor: pointer; display: flex; gap: 5px;">
                    <i class="ri-star-fill" data-val="1" style="color: #F5A623;"></i>
                    <i class="ri-star-fill" data-val="2" style="color: #F5A623;"></i>
                    <i class="ri-star-fill" data-val="3" style="color: #F5A623;"></i>
                    <i class="ri-star-fill" data-val="4" style="color: #F5A623;"></i>
                    <i class="ri-star-fill" data-val="5" style="color: #F5A623;"></i>
                </div>
                <input type="hidden" id="review-rating" value="5">
            </div>
            <div class="form-group" style="margin-top: 15px;">
                <label>Ulasan Anda</label>
                <textarea id="review-comment" class="form-control" rows="4" placeholder="Bagaimana pengalaman Anda?"></textarea>
            </div>
        </div>
        <div class="modal-footer" style="margin-top: 20px;">
            <button class="btn btn-outline" onclick="closeReviewModal()">Batal</button>
            <button class="btn btn-primary" onclick="submitReview()" id="btn-submit-review">Kirim Ulasan</button>
        </div>
    </div>
</div>

<!-- Mobile Menu Script -->
<script>
    (function () {
        const btn = document.querySelector('.mobile-menu-btn');
        const nav = document.querySelector('.nav-links');
        if (btn && nav) {
            btn.addEventListener('click', function () {
                nav.classList.toggle('active');
            });
        }
    })();

    // Review Modal Logic
    window.openReviewModal = function() {
        console.log('Opening Review Modal...');
        const modal = document.getElementById('review-modal');
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scroll
        } else {
            console.error('Review modal element not found!');
        }
    }

    window.closeReviewModal = function() {
        const modal = document.getElementById('review-modal');
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = ''; // Restore scroll
        }
        document.getElementById('review-name').value = '';
        document.getElementById('review-comment').value = '';
        setReviewRating(5);
    }

    function setReviewRating(rating) {
        document.getElementById('review-rating').value = rating;
        const stars = document.querySelectorAll('#review-rating-input i');
        stars.forEach(star => {
            if (parseInt(star.dataset.val) <= rating) {
                star.style.color = '#F5A623';
            } else {
                star.style.color = '#ccc';
            }
        });
    }

    document.querySelectorAll('#review-rating-input i').forEach(star => {
        star.addEventListener('click', function() {
            setReviewRating(parseInt(this.dataset.val));
        });
    });

    async function submitReview() {
        const name = document.getElementById('review-name').value.trim();
        const rating = document.getElementById('review-rating').value;
        const comment = document.getElementById('review-comment').value.trim();

        if (!name || !comment) {
            alert('Mohon lengkapi nama dan ulasan Anda.');
            return;
        }

        const btn = document.getElementById('btn-submit-review');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="ri-loader-4-line ri-spin"></i> Mengirim...';
        btn.disabled = true;

        try {
            const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenMeta ? csrfTokenMeta.content : '';
            const baseUrl = (window.APP_URL || '').replace(/\/$/, '');

            const response = await fetch(baseUrl + '/api/reviews', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    customer_name: name,
                    rating: parseInt(rating),
                    comment: comment
                }),
            });

            const data = await response.json();

            if (response.ok && data.success) {
                alert('Terima kasih! Ulasan Anda berhasil dikirim.');
                closeReviewModal();
                // Opsional: reload halaman jika di beranda agar langsung tampil
                if (window.location.pathname === '/') {
                    window.location.reload();
                }
            } else {
                alert('Gagal mengirim ulasan: ' + (data.message || 'Terjadi kesalahan.'));
            }
        } catch (error) {
            console.error('Review error:', error);
            alert('Terjadi kesalahan saat mengirim ulasan.');
        } finally {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    }
</script>
