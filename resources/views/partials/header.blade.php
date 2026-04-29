@php $activePage = $activePage ?? ''; @endphp

<header>
    <div class="container navbar">
        <a href="/" class="logo">PT Cahaya Baru</a>

        <nav class="nav-links">
            <a href="/#beranda" @class(['nav-link', 'active' => $activePage === 'beranda'])>Beranda</a>
            <a href="/produk" @class(['nav-link', 'active' => $activePage === 'produk'])>Produk</a>
            <a href="/layanan" @class(['nav-link', 'active' => $activePage === 'layanan'])>Jasa &amp; Layanan</a>
            <a href="/tentang-kami" @class(['nav-link', 'active' => $activePage === 'tentang'])>Tentang Kami</a>
            <a href="/kontak" @class(['nav-link', 'active' => $activePage === 'kontak'])>Kontak</a>
            <a href="https://wa.me/6283834079959" class="btn btn-primary nav-cta" target="_blank">Hubungi Kami</a>
        </nav>

        <button class="mobile-menu-btn" aria-label="Menu">
            <i class="ri-menu-line"></i>
        </button>
    </div>
</header>
