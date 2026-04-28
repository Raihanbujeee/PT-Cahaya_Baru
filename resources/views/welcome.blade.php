                                                                              <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Manajemen Toko Bangunan (SIM-TB)</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- CSS -->
    <style>
        :root {
            --primary: #F59E0B; /* Amber/Orange */
            --primary-dark: #D97706;
            --bg-dark: #0f172a; /* Slate 900 */
            --bg-card: rgba(30, 41, 59, 0.7); /* Slate 800 with opacity */
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --glass-bg: rgba(15, 23, 42, 0.6);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Gradient Orbs Background effect */
        .orb-1 {
            position: absolute;
            top: -10%;
            left: -10%;
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, rgba(15, 23, 42, 0) 70%);
            border-radius: 50%;
            z-index: -1;
            filter: blur(60px);
        }
        
        .orb-2 {
            position: absolute;
            bottom: -20%;
            right: -10%;
            width: 60vw;
            height: 60vw;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, rgba(15, 23, 42, 0) 70%);
            border-radius: 50%;
            z-index: -1;
            filter: blur(80px);
        }

        /* Header */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 5%;
            z-index: 100;
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--glass-border);
            transition: all 0.3s ease;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .logo span {
            color: var(--primary);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-block;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            border: none;
            box-shadow: 0 4px 14px 0 rgba(245, 158, 11, 0.39);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
        }

        .btn-outline {
            background-color: transparent;
            color: white;
            border: 1px solid var(--glass-border);
        }

        .btn-outline:hover {
            background-color: rgba(255, 255, 255, 0.05);
            border-color: var(--primary);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 5%;
            padding-top: 100px;
            gap: 4rem;
        }

        .hero-content {
            flex: 1;
            max-width: 600px;
            animation: slideUp 0.8s ease-out;
        }

        .badge {
            display: inline-block;
            background: rgba(245, 158, 11, 0.1);
            color: var(--primary);
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(245, 158, 11, 0.2);
            letter-spacing: 1px;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-content p {
            color: var(--text-muted);
            font-size: 1.125rem;
            margin-bottom: 2.5rem;
            line-height: 1.8;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
        }

        .hero-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            animation: fadeIn 1s ease-out 0.3s both;
        }

        .glass-panel {
            background: var(--bg-card);
            backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 1rem;
            width: 100%;
            max-width: 550px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .glass-panel::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
            z-index: 10;
            pointer-events: none;
        }

        .glass-panel img {
            width: 100%;
            height: auto;
            border-radius: 16px;
            display: block;
            object-fit: cover;
        }

        /* Floating Cards Animation */
        .floating-card {
            position: absolute;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
            z-index: 20;
        }

        .card-1 {
            top: 20%;
            left: -10%;
            animation: float 6s ease-in-out infinite;
        }

        .card-2 {
            bottom: 15%;
            right: -5%;
            animation: float 8s ease-in-out infinite reverse;
        }

        .card-icon {
            width: 40px;
            height: 40px;
            background: rgba(245, 158, 11, 0.2);
            color: var(--primary);
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.25rem;
        }

        .card-info h4 {
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .card-info p {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin: 0;
        }

        /* Features Section */
        .features {
            padding: 6rem 5%;
            position: relative;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-header h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .section-header p {
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: var(--bg-card);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 2.5rem 2rem;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--primary);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.3);
            border-color: rgba(245, 158, 11, 0.3);
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: rgba(245, 158, 11, 0.1);
            color: var(--primary);
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }

        .feature-card h3 {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .feature-card p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        /* Footer */
        footer {
            border-top: 1px solid var(--glass-border);
            padding: 2rem 5%;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.9rem;
            background: rgba(15, 23, 42, 0.8);
        }

        /* Animations */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        @media (max-width: 968px) {
            .hero {
                flex-direction: column;
                text-align: center;
                padding-top: 120px;
            }

            .hero-content {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-actions {
                justify-content: center;
            }

            .floating-card {
                display: none;
            }
            
            .nav-auth {
                display: none;
            }
        }
    </style>
</head>
<body>

    <!-- Ambient Orbs -->
    <div class="orb-1"></div>
    <div class="orb-2"></div>

    <header>
        <a href="/" class="logo">
            <i class="ri-building-4-fill"></i> SIM<span>-TB</span>
        </a>
        <div class="nav-links">
            <div class="nav-auth">
                @auth
                    <a href="{{ url('/admin') }}" class="btn btn-primary">Dashboard</a>
                @else
                    <a href="{{ url('/admin') }}" class="btn btn-primary">Log in Sistem</a>
                @endauth
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <div class="badge">V4 & Laravel 12</div>
            <h1>Kelola Toko Bangunan Lebih Mudah & Pintar</h1>
            <p>Tingkatkan efisiensi toko bangunan Anda dengan Sistem Manajemen Inventaris, Penjualan, & Pelaporan yang terintegrasi secara real-time.</p>
            <div class="hero-actions">
                @auth
                    <a href="{{ url('/admin') }}" class="btn btn-primary">Masuk Dashboard <i class="ri-arrow-right-line" style="margin-left:5px"></i></a>
                @else
                    <a href="{{ url('/admin') }}" class="btn btn-primary">Mulai Sekarang <i class="ri-arrow-right-line" style="margin-left:5px"></i></a>
                @endauth
                <a href="#fitur" class="btn btn-outline">Pelajari Fitur</a>
            </div>
        </div>
        <div class="hero-image">
            <div class="glass-panel">
                <img src="{{ asset('images/hero-bg.png') }}" alt="SIM-TB Dashboard Interface Illustration">
                
                <div class="floating-card card-1">
                    <div class="card-icon"><i class="ri-stock-line"></i></div>
                    <div class="card-info">
                        <h4>Stok Diperbarui</h4>
                        <p>Semen Tonasa - Real-Time</p>
                    </div>
                </div>

                <div class="floating-card card-2">
                    <div class="card-icon" style="color: #10b981; background: rgba(16, 185, 129, 0.2)"><i class="ri-shopping-cart-2-line"></i></div>
                    <div class="card-info">
                        <h4>Penjualan Baru</h4>
                        <p>Transaksi Selesai</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="features" id="fitur">
        <div class="section-header">
            <h2>Fitur Unggulan Sistem</h2>
            <p>Dibangun untuk mempermudah operasional sehari-hari toko bangunan Anda, dari manajemen stok hingga pencatatan transaksi yang akurat.</p>
        </div>
        <div class="feature-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="ri-box-3-fill"></i></div>
                <h3>Manajemen Inventaris</h3>
                <p>Pantau stok barang, harga modal, harga jual, dan kelola kategori produk secara terstruktur dan efisien.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="ri-shopping-bag-3-fill"></i></div>
                <h3>Point of Sale (POS)</h3>
                <p>Proses transaksi kasir menjadi lebih cepat dengan dukungan sistem pencarian produk otomatis dan perhitungan subtotal akurat.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="ri-bar-chart-box-fill"></i></div>
                <h3>Laporan Real-Time</h3>
                <p>Dapatkan insight langsung tentang pendapatan, transaksi harian, dan barang terlaris lewat dashboard interaktif.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; {{ date('Y') }} SIM-TB - Sistem Informasi Manajemen Toko Bangunan. All rights reserved.</p>
    </footer>

    <script>
        // Simple header background change on scroll
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.style.background = 'rgba(15, 23, 42, 0.9)';
                header.style.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.background = 'rgba(15, 23, 42, 0.6)';
                header.style.boxShadow = 'none';
            }
        });
    </script>
</body>
</html>
