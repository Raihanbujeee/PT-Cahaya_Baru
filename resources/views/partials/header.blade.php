@php $activePage = $activePage ?? ''; @endphp

<header>
    <div class="container navbar">
        <a href="/" class="logo">
            <i class="ri-building-4-fill"></i> PT Cahaya Baru
        </a>

        <nav class="nav-links">
            <a href="/" @class(['active' => $activePage === 'beranda'])>Beranda</a>
            <a href="/produk" @class(['active' => $activePage === 'produk'])>Produk</a>
            <a href="/#layanan">Jasa &amp; Layanan</a>
            <a href="/tentang-kami" @class(['active' => $activePage === 'tentang'])>Tentang Kami</a>
            <a href="/kontak" @class(['active' => $activePage === 'kontak'])>Kontak</a>
            <a href="https://wa.me/6283834079959" class="btn btn-primary" target="_blank">Hubungi Kami</a>
        </nav>

        <button class="mobile-menu-btn" aria-label="Menu">
            <i class="ri-menu-line"></i>
        </button>
    </div>
</header>
