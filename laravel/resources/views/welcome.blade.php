<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Pet Care · Perawatan Terbaik untuk Hewan Anda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;1,9..40,700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #A37764;
            --primary-dark: #7A5344;
            --bg: #F8F6F2;
            --card: #FFFFFF;
            --border: #EDE9E4;
            --text: #2D2117;
            --muted: #78695F;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text); }

        /* NAV */
        .nav-bar {
            position: sticky; top: 0; z-index: 100;
            background: rgba(248,246,242,0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: 0 48px;
            height: 60px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .nav-logo { display:flex; align-items:center; gap:10px; text-decoration:none; color:var(--text); font-weight:800; font-size:1rem; }
        .nav-logo span { width:32px;height:32px;background:var(--primary);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1rem; }

        /* HERO */
        .hero {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            min-height: 88vh;
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 48px 40px;
            gap: 60px;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: #FEF3ED; color: #8B4B2F;
            font-size: 0.78rem; font-weight: 700;
            padding: 5px 14px; border-radius: 20px;
            margin-bottom: 24px;
            border: 1px solid #F5C9B0;
        }
        .hero-title {
            font-size: clamp(2.2rem, 4vw, 3.4rem);
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -0.02em;
            margin-bottom: 20px;
            color: var(--text);
        }
        .hero-title em { font-style: italic; color: var(--primary); }
        .hero-desc { font-size: 1rem; color: var(--muted); line-height: 1.75; margin-bottom: 32px; max-width: 440px; }
        .btn-hero-primary {
            background: var(--primary); color: #fff; border: none;
            padding: 13px 28px; border-radius: 10px;
            font-weight: 700; font-size: 0.9rem; cursor: pointer;
            text-decoration: none; display: inline-block;
            transition: background 0.15s, transform 0.1s;
        }
        .btn-hero-primary:hover { background: var(--primary-dark); color:#fff; transform: translateY(-2px); }
        .btn-hero-secondary {
            color: var(--muted); background: transparent; border: 1px solid var(--border);
            padding: 13px 24px; border-radius: 10px;
            font-weight: 600; font-size: 0.9rem; cursor: pointer;
            text-decoration: none; display: inline-block;
            transition: border-color 0.15s, color 0.15s;
        }
        .btn-hero-secondary:hover { border-color: var(--primary); color: var(--primary); }

        /* HERO IMAGE AREA */
        .hero-visual {
            position: relative;
            display: flex; align-items: center; justify-content: center;
        }
        .hero-blob {
            width: 440px; height: 440px;
            background: linear-gradient(135deg, #e8d5c8 0%, #f5ebe4 100%);
            border-radius: 60% 40% 55% 45% / 50% 50% 50% 50%;
            position: relative; overflow: hidden;
            display: flex; align-items: center; justify-content: center;
            font-size: 11rem; line-height: 1;
            animation: blobFloat 6s ease-in-out infinite;
        }
        @keyframes blobFloat {
            0%, 100% { border-radius: 60% 40% 55% 45% / 50% 50% 50% 50%; }
            50% { border-radius: 45% 55% 40% 60% / 50% 45% 55% 50%; }
        }

        /* QUICK SERVICE PILLS */
        .service-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 28px; }
        .service-pill {
            display: flex; align-items: center; gap: 6px;
            background: #fff; border: 1px solid var(--border);
            padding: 7px 14px; border-radius: 8px;
            font-size: 0.78rem; font-weight: 600; color: var(--text);
        }

        /* SECTION */
        .section { max-width: 1200px; margin: 0 auto; padding: 60px 48px; }
        .section-title { font-size: 1.6rem; font-weight: 800; letter-spacing: -0.01em; margin-bottom: 8px; }
        .section-sub { color: var(--muted); font-size: 0.875rem; margin-bottom: 36px; }

        /* TRENDING CARDS */
        .trending-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
        .trending-card {
            background: #fff; border: 1px solid var(--border);
            border-radius: 12px; padding: 20px 22px;
            position: relative; transition: box-shadow 0.2s;
        }
        .trending-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.06); }
        .trending-card.top { border-color: var(--primary); }
        .trending-tag {
            font-size: 0.7rem; font-weight: 700;
            background: #FEF3ED; color: #8B4B2F;
            padding: 3px 10px; border-radius: 20px;
            display: inline-block; margin-bottom: 12px;
        }

        /* SERVICE LIST */
        .service-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; }
        .service-item {
            background: #fff; border: 1px solid var(--border);
            border-radius: 10px; padding: 16px 18px;
            display: flex; align-items: center; gap: 14px;
            transition: box-shadow 0.15s;
        }
        .service-item:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.06); }
        .service-icon {
            width: 40px; height: 40px; border-radius: 10px;
            background: #FEF3ED; display: flex; align-items: center;
            justify-content: center; font-size: 1.2rem; flex-shrink: 0;
        }

        /* FOOTER */
        footer {
            background: #fff; border-top: 1px solid var(--border);
            padding: 48px; margin-top: 40px;
        }

        @media (max-width: 768px) {
            .hero { grid-template-columns: 1fr; padding: 40px 24px; gap: 40px; }
            .hero-blob { width: 260px; height: 260px; font-size: 7rem; }
            .trending-cards, .service-grid { grid-template-columns: 1fr; }
            .nav-bar { padding: 0 20px; }
            .section { padding: 40px 20px; }
        }
    </style>
</head>
<body>

    <nav class="nav-bar">
        <a href="/" class="nav-logo">
            <span>🐾</span> Daily Pet Care
        </a>
        <div style="display:flex; gap:10px; align-items:center;">
            <a href="{{ route('login') }}" style="font-size:0.85rem; font-weight:600; color:var(--muted); text-decoration:none; padding:7px 16px;">Masuk</a>
            <a href="{{ route('register') }}" class="btn-hero-primary" style="padding:8px 20px; font-size:0.85rem;">Register</a>
        </div>
    </nav>

    {{-- ========= HERO ========= --}}
    <section class="hero">
        <div>
            <div class="hero-badge">
                🏅 Pet Care #1 di Jakarta
            </div>
            <h1 class="hero-title">
                Perawatan <em>Terbaik</em><br>untuk Sahabat<br>Berbulu Anda
            </h1>
            <p class="hero-desc">
                Grooming profesional, hotel hewan nyaman, vaksinasi lengkap — semuanya ditangani oleh staf berpengalaman dengan standar klinik veteriner.
            </p>
            <div style="display:flex; gap:12px; flex-wrap:wrap;">
                <a href="{{ route('register') }}" class="btn-hero-primary">Daftar Sekarang →</a>
                <a href="#services" class="btn-hero-secondary">Lihat Layanan</a>
            </div>
            <div class="service-pills">
                <div class="service-pill">🛁 Grooming</div>
                <div class="service-pill">🏨 Hotel Hewan</div>
                <div class="service-pill">💉 Vaksinasi</div>
                <div class="service-pill">🩺 Pemeriksaan</div>
                <div class="service-pill">✂️ Spa</div>
            </div>
        </div>
        <div class="hero-visual">
            <div class="hero-blob">🐱</div>
            <div style="position:absolute; bottom:20px; right:0; background:#fff; border:1px solid var(--border); border-radius:12px; padding:14px 18px; box-shadow:0 8px 24px rgba(0,0,0,0.08);">
                <div style="font-size:0.7rem; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:0.05em;">Hewan Dirawat</div>
                <div style="font-size:1.6rem; font-weight:800; color:var(--text);">500+</div>
                <div style="font-size:0.75rem; color:#16a34a; font-weight:600;">↑ Bulan ini</div>
            </div>
        </div>
    </section>

    {{-- ========= TRENDING ========= --}}
    @if($trendingServices->count())
    <section class="section" id="trending">
        <h2 class="section-title">🔥 Sedang Trending</h2>
        <p class="section-sub">Layanan paling banyak dipesan pelanggan bulan ini</p>
        <div class="trending-cards">
            @foreach($trendingServices as $i => $s)
            <div class="trending-card {{ $i===0 ? 'top' : '' }}">
                @if($i===0)<div class="trending-tag">🥇 #1 Terpopuler</div>
                @elseif($i===1)<div class="trending-tag">🥈 #2 Terpopuler</div>
                @else<div class="trending-tag">🥉 #3 Terpopuler</div>@endif
                <div style="font-weight:700; font-size:0.95rem; margin-bottom:6px;">{{ $s->nama_layanan }}</div>
                <div style="color:var(--muted); font-size:0.8rem; margin-bottom:14px;">{{ $s->total_used }}× dipesan bulan ini</div>
                <div style="font-size:1.3rem; font-weight:800; color:var(--primary);">Rp {{ number_format($s->harga, 0, ',', '.') }}</div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ========= ALL SERVICES ========= --}}
    <section class="section" id="services">
        <h2 class="section-title">Katalog Layanan</h2>
        <p class="section-sub">Harga transparan, layanan berkualitas — tanpa biaya tersembunyi</p>

        @php
            $umumServices  = $services->reject(fn($s) => str_contains(strtolower($s->nama_layanan), 'vaksin'));
            $vaksinServices = $services->filter(fn($s) => str_contains(strtolower($s->nama_layanan), 'vaksin'));
        @endphp

        @if($umumServices->count())
        <h3 style="font-size:0.875rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:var(--muted); margin-bottom:16px;">🛁 Perawatan & Umum</h3>
        <div class="service-grid mb-4">
            @foreach($umumServices as $s)
            <div class="service-item">
                <div class="service-icon">🐾</div>
                <div>
                    <div style="font-weight:600; font-size:0.875rem; margin-bottom:2px;">{{ $s->nama_layanan }}</div>
                    <div style="color:var(--primary); font-weight:800; font-size:1rem;">Rp {{ number_format($s->harga, 0, ',', '.') }}</div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($vaksinServices->count())
        <h3 style="font-size:0.875rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:var(--muted); margin-bottom:16px; margin-top:28px;">💉 Vaksinasi</h3>
        <div class="service-grid">
            @foreach($vaksinServices as $s)
            <div class="service-item" style="grid-column: span 1;">
                <div class="service-icon" style="background:#EEF4FF;">💉</div>
                <div>
                    <div style="font-weight:600; font-size:0.85rem; margin-bottom:2px; line-height:1.4;">{{ $s->nama_layanan }}</div>
                    <div style="color:var(--primary); font-weight:800; font-size:1rem;">Rp {{ number_format($s->harga, 0, ',', '.') }}</div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </section>

    {{-- ========= FOOTER ========= --}}
    <footer>
        <div style="max-width:1200px; margin:0 auto; display:grid; grid-template-columns:1.5fr 1fr 1fr; gap:40px;">
            <div>
                <div style="display:flex; align-items:center; gap:10px; margin-bottom:16px;">
                    <div style="width:32px;height:32px;background:var(--primary);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#fff;">🐾</div>
                    <strong>Daily Pet Care</strong>
                </div>
                <p style="color:var(--muted); font-size:0.85rem; line-height:1.7;">Klinik & Salon Hewan Terpercaya. Kami merawat hewan Anda seperti keluarga sendiri sejak 2024.</p>
            </div>
            <div>
                <h4 style="font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:var(--muted); margin-bottom:16px;">Kontak</h4>
                <ul style="list-style:none; font-size:0.875rem; color:var(--muted); line-height:2.2;">
                    <li>📞 +62 812-3456-7890</li>
                    <li>✉️ hello@dailypetcare.id</li>
                    <li>📍 Jl. Pahlawan No. 45, Jakarta Selatan</li>
                </ul>
            </div>
            <div>
                <h4 style="font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:var(--muted); margin-bottom:16px;">Sosial Media</h4>
                <ul style="list-style:none; font-size:0.875rem; color:var(--muted); line-height:2.2;">
                    <li>📷 <a href="#" style="color:var(--primary); text-decoration:none;">@dailypetcare_id</a></li>
                    <li>🎵 <a href="#" style="color:var(--primary); text-decoration:none;">@dailypetcare.id</a></li>
                    <li>📘 <a href="#" style="color:var(--primary); text-decoration:none;">Daily Pet Care Official</a></li>
                </ul>
            </div>
        </div>
        <div style="max-width:1200px; margin:32px auto 0; border-top:1px solid var(--border); padding-top:24px; text-align:center; color:var(--muted); font-size:0.8rem;">
            &copy; {{ date('Y') }} Daily Pet Care. Fictional project for academic demonstration.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
