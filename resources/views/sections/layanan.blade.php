{{-- 
    Section: Jasa & Layanan (Halaman Penuh)
    File ini berisi halaman lengkap layanan dengan header, hero, sections, dan footer.
    Diinclude via @include('sections.layanan') di welcome.blade.php
--}}

@push('styles')
    <!-- Google Fonts: Work Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Material Symbols Outlined -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
@endpush

<!-- ============================================= -->
<!-- SECTION: JASA & LAYANAN (Tailwind Version)    -->
<!-- ============================================= -->

<!-- Top Navigation Bar -->
<header class="bg-white border-b border-stone-100 h-20 sticky top-0 z-50">
    <div class="flex justify-between items-center max-w-7xl mx-auto px-6 h-full">
        <div class="text-xl font-bold text-zinc-900 tracking-tight">PT Cahaya Baru</div>
        <nav class="hidden md:flex items-center space-x-10">
            <a class="text-sm font-semibold text-zinc-600 hover:text-primary transition-colors" href="#">Beranda</a>
            <a class="text-sm font-semibold text-zinc-600 hover:text-primary transition-colors" href="#">Produk</a>
            <a class="text-sm font-semibold text-primary border-b-2 border-primary pb-1" href="#">Jasa &amp; Layanan</a>
            <a class="text-sm font-semibold text-zinc-600 hover:text-primary transition-colors" href="#">Tentang Kami</a>
            <a class="text-sm font-semibold text-zinc-600 hover:text-primary transition-colors" href="#">Kontak</a>
        </nav>
        <button class="bg-primary text-white text-sm font-bold px-6 py-3 hover:bg-opacity-90 transition-all">Hubungi Kami</button>
    </div>
</header>

<!-- Hero Section -->
<section class="relative">
    <div class="relative min-h-[600px] w-full flex items-center overflow-hidden">
        <div class="absolute inset-0 bg-black/30 z-10"></div>
        <img alt="Construction team discussing plans" class="absolute inset-0 w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDkDv1PSxUnmv2LYh-QQfKViwU_MLybIszaWCp0C-HC5UZfdp_LJ1KD6x0X1nCe3JnucTOKXnV_b2WepmVh598eJ8RzGvp-oHAXxopmpuisJcFqea7bsBxFWb6eD2kYzGs_roxjtJdWBMlwhdpjMheg4aP8enIikm23juH-K5_wR3BFux6dcZnJxE75qCbXPKqq8aXV7z5f-U0qm_DNQLquG5W0xnJeT2EHSRpofkKF3-3Biw5EMVhpkFGJhNAch9IfA5aHJ-TEnuo">
        <div class="relative z-20 max-w-7xl mx-auto px-6 w-full py-20">
            <div class="max-w-3xl">
                <nav class="flex items-center space-x-2 text-zinc-200 text-sm mb-8 font-medium">
                    <span>Beranda</span>
                    <span class="material-symbols-outlined text-xs">chevron_right</span>
                    <span class="text-white">Jasa &amp; Layanan</span>
                </nav>
                <h1 class="text-[56px] leading-[1.1] font-bold text-white mb-6">Layanan Lengkap untuk Kebutuhan Bangunan Anda</h1>
                <p class="text-lg text-zinc-100 mb-10 max-w-2xl leading-relaxed">Dari konsultasi hingga instalasi, kami menyediakan solusi terpadu dengan standar kualitas tinggi untuk menjamin kesuksesan proyek Anda.</p>
                <div class="flex flex-wrap gap-4">
                    <button class="bg-primary text-white font-bold px-10 py-4 hover:bg-opacity-90 transition-all">Konsultasi Gratis</button>
                    <button class="border border-white/50 bg-white/10 backdrop-blur-sm text-white font-bold px-10 py-4 hover:bg-white hover:text-primary transition-all">Lihat Produk Kami</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Advantages Section -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-zinc-900 mb-4">Kenapa Memilih Layanan Kami</h2>
            <div class="w-16 h-1 bg-primary mx-auto"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div class="bg-[#fcf9f8] p-10 border border-stone-100 flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-[#ffeadb] rounded-xl flex items-center justify-center mb-8">
                    <span class="material-symbols-outlined text-primary text-3xl">military_tech</span>
                </div>
                <h3 class="text-xl font-bold text-zinc-900 mb-4">Pengalaman 10+ Tahun</h3>
                <p class="text-zinc-600 leading-relaxed text-sm">Terpercaya dalam ratusan proyek di seluruh wilayah.</p>
            </div>
            <!-- Card 2 -->
            <div class="bg-[#fcf9f8] p-10 border border-stone-100 flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-[#ffeadb] rounded-xl flex items-center justify-center mb-8">
                    <span class="material-symbols-outlined text-primary text-3xl">engineering</span>
                </div>
                <h3 class="text-xl font-bold text-zinc-900 mb-4">Tim Profesional</h3>
                <p class="text-zinc-600 leading-relaxed text-sm">Tenaga ahli bersertifikat yang dedikatif.</p>
            </div>
            <!-- Card 3 -->
            <div class="bg-[#fcf9f8] p-10 border border-stone-100 flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-[#ffeadb] rounded-xl flex items-center justify-center mb-8">
                    <span class="material-symbols-outlined text-primary text-3xl">verified</span>
                </div>
                <h3 class="text-xl font-bold text-zinc-900 mb-4">Garansi Kepuasan</h3>
                <p class="text-zinc-600 leading-relaxed text-sm">Kualitas pengerjaan dijamin sesuai standar tertinggi.</p>
            </div>
            <!-- Card 4 -->
            <div class="bg-[#fcf9f8] p-10 border border-stone-100 flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-[#ffeadb] rounded-xl flex items-center justify-center mb-8">
                    <span class="material-symbols-outlined text-primary text-3xl">schedule</span>
                </div>
                <h3 class="text-xl font-bold text-zinc-900 mb-4">Respons Cepat</h3>
                <p class="text-zinc-600 leading-relaxed text-sm">Penyelesaian tepat waktu sesuai jadwal proyek.</p>
            </div>
        </div>
    </div>
</section>

<!-- Main Services Section -->
<section class="py-24 bg-[#f4f3f0]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-20">
            <h2 class="text-4xl font-bold text-zinc-900">Layanan Utama Kami</h2>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Service 1: Pengiriman Barang -->
            <div class="bg-white border border-stone-100 overflow-hidden shadow-sm flex flex-col">
                <div class="relative h-72">
                    <img alt="Fleet of trucks" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAdvgiaP3FbbGlcvz2LSXQVZ-ugC9SLRKQmpdJdQ4cAu-0av7SL-gC8R7tnONKJvLKq7NxFB8zmuuPoNG7vNequCPtUt1nZ7hKysIcu1hg2Zg02VES9nlYVCrqyCzxcVYY2ABsDN3b5xYTMoXgdfc08tRZiiZ0PLkeL7hqLRwPEe2xGSX5OWUGwW3GvDvF_jQwvg75wMtwDXGw2f2Te-8X6w3h4-Uak6UAOcMeFFPIAspVIxKlsOaQqaVC6Yb22Z1JZmVT0Sfs2pD8">
                </div>
                <div class="p-10 relative">
                    <div class="absolute -top-14 right-10 bg-[#e7e5e0] px-4 py-1 text-xs font-bold text-zinc-700 tracking-wide uppercase">Mulai Rp 50.000</div>
                    <div class="flex items-center gap-4 mb-6">
                        <span class="material-symbols-outlined text-primary text-4xl">local_shipping</span>
                        <h3 class="text-2xl font-bold text-zinc-900">Pengiriman Barang</h3>
                    </div>
                    <ul class="space-y-4 mb-10">
                        <li class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            <span class="text-zinc-700 font-medium">Armada lengkap &amp; aman</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            <span class="text-zinc-700 font-medium">Cakupan area luas</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            <span class="text-zinc-700 font-medium">Asuransi pengiriman</span>
                        </li>
                    </ul>
                    <div class="flex gap-4 pt-6 border-t border-stone-100">
                        <button class="flex-grow bg-primary text-white font-bold py-4 hover:bg-opacity-90 transition-all">Pesan Sekarang</button>
                        <button class="w-14 h-14 flex items-center justify-center bg-success-green text-white hover:bg-opacity-90 transition-all">
                            <span class="material-symbols-outlined">chat</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Service 2: Jasa Layanan -->
            <div class="bg-white border border-stone-100 overflow-hidden shadow-sm flex flex-col">
                <div class="relative h-72">
                    <img alt="Construction services" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAiBxgZLYMZXTebWsxcHnCZBfw7jdxAHFTmKa9h_xgdmNi3gmoETZYJgsbi_cNyNDf70HwhLtc2BvzCbeDA78XimZOEfUAbq8R4_v8Pbo_lVvbRpvzpNq3L7VPoabrBRacfiy0ys5BWi1c77XS9p6rB5d03l21O0LCbl9VzhS6gzzi5IWzz50yjIACdQQYdl_hWqwmsyI9Z5UX0ffdv06AOBcxryI79xdnrFIU6Fxt3amBiTweiZt48r0s0oSEp08V5u4FWL_hxP00">
                </div>
                <div class="p-10 relative">
                    <div class="absolute -top-14 right-10 bg-[#e7e5e0] px-4 py-1 text-xs font-bold text-zinc-700 tracking-wide uppercase">Profesional</div>
                    <div class="flex items-center gap-4 mb-6">
                        <span class="material-symbols-outlined text-primary text-4xl">construction</span>
                        <h3 class="text-2xl font-bold text-zinc-900">Jasa Layanan</h3>
                    </div>
                    <ul class="space-y-4 mb-10">
                        <li class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            <span class="text-zinc-700 font-medium">Konsultasi &amp; Estimasi Biaya</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            <span class="text-zinc-700 font-medium">Pemasangan &amp; Instalasi Ahli</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            <span class="text-zinc-700 font-medium">Renovasi &amp; Pemeliharaan</span>
                        </li>
                    </ul>
                    <div class="flex gap-4 pt-6 border-t border-stone-100">
                        <button class="flex-grow bg-primary text-white font-bold py-4 hover:bg-opacity-90 transition-all">Pesan Sekarang</button>
                        <button class="w-14 h-14 flex items-center justify-center bg-success-green text-white hover:bg-opacity-90 transition-all">
                            <span class="material-symbols-outlined">chat</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer (Layanan Version) -->
<footer class="bg-white py-20 border-t border-stone-100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-20">
            <div class="md:col-span-5">
                <div class="text-xl font-bold text-zinc-900 mb-6 tracking-tight">PT Cahaya Baru</div>
                <p class="text-sm text-zinc-500 max-w-sm leading-relaxed mb-4">© 2024 PT Cahaya Baru. Kepercayaan dan Kualitas Terjamin.</p>
            </div>
            <div class="md:col-span-3">
                <h4 class="text-xs font-bold uppercase tracking-widest text-zinc-900 mb-8">Perusahaan</h4>
                <ul class="space-y-4">
                    <li><a class="text-sm text-zinc-500 hover:text-primary transition-colors" href="#">Kebijakan Privasi</a></li>
                    <li><a class="text-sm text-zinc-500 hover:text-primary transition-colors" href="#">Syarat &amp; Ketentuan</a></li>
                </ul>
            </div>
            <div class="md:col-span-3">
                <h4 class="text-xs font-bold uppercase tracking-widest text-zinc-900 mb-8">Kontak</h4>
                <ul class="space-y-4">
                    <li class="text-sm text-zinc-500">Lokasi Toko</li>
                    <li class="text-sm text-zinc-500">Bantuan</li>
                </ul>
            </div>
        </div>
    </div>
</footer>
