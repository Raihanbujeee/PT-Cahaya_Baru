<!-- ── FOOTER ── -->
<footer id="kontak">
    <div class="container">
        <div class="footer-grid">

            <div class="footer-about">
                <div class="logo">PT Cahaya Baru</div>
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
            <p>&copy; {{ date('Y') }} PT Cahaya Baru. All rights reserved.</p>
        </div>
    </div>
</footer>

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
</script>
