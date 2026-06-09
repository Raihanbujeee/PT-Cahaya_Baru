<style>
/* Footer Base Styles */
footer {
    background-color: #1a1a1a;
    color: white;
    padding: 70px 0 20px;
}
.footer-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 40px;
    margin-bottom: 50px;
}
.footer-about .logo {
    color: white;
    margin-bottom: 16px;
    font-size: 20px;
    font-weight: bold;
}
.footer-about p {
    color: #aaa;
    margin-bottom: 20px;
    font-size: 14px;
    line-height: 1.7;
}
.social-icons {
    display: flex;
    gap: 12px;
}
.social-icons a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background-color: rgba(255,255,255,0.1);
    border-radius: 50%;
    transition: all 0.3s ease;
    color: white;
    font-size: 16px;
    text-decoration: none;
}
.social-icons a:hover {
    background-color: #C27A1A;
    transform: translateY(-2px);
}
.footer-links h4 {
    font-size: 16px;
    margin-bottom: 16px;
    font-weight: 700;
    color: white;
}
.footer-links ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.footer-links ul li {
    margin-bottom: 10px;
}
.footer-links ul li a {
    color: #aaa;
    font-size: 14px;
    transition: all 0.3s ease;
    text-decoration: none;
}
.footer-links ul li a:hover {
    color: #C27A1A;
    padding-left: 4px;
}
.footer-contact ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.footer-contact li {
    display: flex;
    gap: 12px;
    margin-bottom: 12px;
    color: #aaa;
    font-size: 14px;
    align-items: flex-start;
}
.footer-contact i {
    color: #C27A1A;
    font-size: 18px;
    margin-top: 2px;
}
.footer-bottom {
    text-align: center;
    padding-top: 20px;
    border-top: 1px solid rgba(255,255,255,0.1);
    color: #777;
    font-size: 13px;
}
@media (max-width: 1024px) {
    .footer-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 768px) {
    .footer-grid { grid-template-columns: 1fr; }
}
</style>

<!-- ── FOOTER ── -->
@php
    $footer = \App\Models\FooterSetting::first();
    // dd($footer); 
@endphp
<footer>
    <div class="container">
        <div class="footer-grid">

            <div class="footer-about">
                <div class="logo">PT Cahaya Baru</div>
                <div class="footer-desc">
                    {!! $footer->description ?? 'Deskripsi perusahaan belum diisi.' !!}
                </div>
                <div class="social-icons">
                    <a href="{{ $footer->social_links['facebook'] ?? '#' }}"><i class="ri-facebook-fill"></i></a>
                    <a href="{{ $footer->social_links['instagram'] ?? '#' }}"><i class="ri-instagram-line"></i></a>
                    <a href="{{ $footer->social_links['x'] ?? '#' }}"><i class="ri-twitter-x-line"></i></a>
                    <a href="{{ $footer->social_links['youtube'] ?? '#' }}"><i class="ri-youtube-fill"></i></a>
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
                    <li><a href="#">Tanya Jawab Umum</a></li>
                </ul>
            </div>

            <div class="footer-contact">
                <h4>Kontak Kami</h4>
                <ul>
                    <li>
                        <i class="ri-map-pin-fill"></i>
                        <span>{{ $footer->address ?? 'Alamat belum diisi' }}</span>
                    </li>
                    <li>
                        <i class="ri-phone-fill"></i>
                        <span>{{ $footer->phone ?? '-' }}</span>
                    </li>
                    <li>
                        <i class="ri-mail-fill"></i>
                        <span>{{ $footer->email ?? '-' }}</span>
                    </li>
                    <li>
                        <i class="ri-time-fill"></i>
                        <span>{{ $footer->hours ?? '-' }}</span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} TB Cahaya Baru. Hak Cipta Dilindungi.</p>
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
