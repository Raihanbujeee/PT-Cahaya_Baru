@php $activePage = $activePage ?? ''; @endphp

<header>
    <div class="container navbar">
        <a href="/" class="logo">TB Cahaya Baru</a>

        <nav class="nav-links">
            <a href="/#beranda" @class(['nav-link', 'active' => $activePage === 'beranda'])>Beranda</a>
            <a href="/produk" @class(['nav-link', 'active' => $activePage === 'produk'])>Produk</a>
            <a href="/layanan" @class(['nav-link', 'active' => $activePage === 'layanan'])>Jasa &amp; Layanan</a>
            <a href="/tentang-kami" @class(['nav-link', 'active' => $activePage === 'tentang'])>Tentang Kami</a>
            <a href="/kontak" @class(['nav-link', 'active' => $activePage === 'kontak'])>Kontak</a>
        </nav>

        <button class="mobile-menu-btn" aria-label="Menu">
            <i class="ri-menu-line"></i>
        </button>
    </div>
</header>
