<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Pet Care · Perawatan Terbaik untuk Hewan Anda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;1,9..40,700&display=swap" rel="stylesheet">
    <script>
        const theme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', theme);
    </script>
    <style>
        :root {
            --primary: #FFB01F;
            --primary-dark: #E59D1B;
            --bg: #F9FAFB;
            --card: #FFFFFF;
            --border: #E5E7EB;
            --text: #1F2937;
            --muted: #6B7280;
            --hero-bg: #FFF8EB;
        }
        [data-theme="dark"] {
            --bg: #111827;
            --card: #1F2937;
            --border: #374151;
            --text: #F9FAFB;
            --muted: #9CA3AF;
            --hero-bg: #1F2937;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text); transition: background-color 0.3s, color 0.3s; }

        /* NAV */
        .nav-bar {
            position: sticky; top: 0; z-index: 100;
            background: var(--bg);
            border-bottom: 1px solid var(--border);
            padding: 0 48px; height: 64px;
            display: flex; align-items: center; justify-content: space-between;
            transition: background-color 0.3s, border-color 0.3s;
        }
        .nav-logo { display:flex; align-items:center; gap:10px; text-decoration:none; color:var(--text); font-weight:800; font-size:1.1rem; }
        
        .theme-btn {
            background: transparent; border: 1px solid var(--border);
            color: var(--muted); border-radius: 8px; width: 36px; height: 36px;
            display: flex; align-items: center; justify-content: center; cursor: pointer;
        }

        /* HERO */
        .hero {
            display: grid; grid-template-columns: 1fr 1fr; align-items: center;
            min-height: 85vh; max-width: 1200px; margin: 0 auto; padding: 60px 48px 40px; gap: 60px;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--hero-bg); color: var(--primary-dark);
            font-size: 0.8rem; font-weight: 700; padding: 6px 16px; border-radius: 20px;
            margin-bottom: 24px; border: 1px solid var(--primary);
        }
        .hero-title { font-size: clamp(2.4rem, 4vw, 3.8rem); font-weight: 800; line-height: 1.15; letter-spacing: -0.02em; margin-bottom: 20px; color: var(--text); }
        .hero-title em { font-style: italic; color: var(--primary); }
        .hero-desc { font-size: 1.05rem; color: var(--muted); line-height: 1.75; margin-bottom: 32px; max-width: 460px; }
        
        .btn-hero-primary { background: var(--primary); color: #fff; border: none; padding: 13px 28px; border-radius: 10px; font-weight: 700; font-size: 0.95rem; text-decoration: none; display: inline-block; transition: 0.2s; }
        .btn-hero-primary:hover { background: var(--primary-dark); color:#fff; transform: translateY(-2px); }
        .btn-hero-secondary { color: var(--text); background: transparent; border: 1px solid var(--border); padding: 13px 24px; border-radius: 10px; font-weight: 600; font-size: 0.95rem; text-decoration: none; display: inline-block; transition: 0.2s; }
        .btn-hero-secondary:hover { border-color: var(--primary); color: var(--primary); }

        .hero-visual { position: relative; display: flex; align-items: center; justify-content: center; }
        .hero-blob {
            width: 460px; height: 460px;
            border-radius: 60% 40% 55% 45% / 50% 50% 50% 50%;
            position: relative; overflow: hidden;
            animation: blobFloat 8s ease-in-out infinite;
            border: 8px solid var(--hero-bg);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        }
        .hero-blob img { width: 100%; height: 100%; object-fit: cover; }
        @keyframes blobFloat { 0%, 100% { border-radius: 60% 40% 55% 45% / 50% 50% 50% 50%; } 50% { border-radius: 45% 55% 40% 60% / 50% 45% 55% 50%; } }

        .service-pills { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 32px; }
        .service-pill { background: var(--card); border: 1px solid var(--border); padding: 8px 16px; border-radius: 8px; font-size: 0.8rem; font-weight: 600; color: var(--text); }

        /* SECTION */
        .section { max-width: 1200px; margin: 0 auto; padding: 80px 48px; }
        .section-title { font-size: 1.8rem; font-weight: 800; letter-spacing: -0.01em; margin-bottom: 8px; }
        .section-sub { color: var(--muted); font-size: 0.95rem; margin-bottom: 40px; }

        .trending-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .trending-card { background: var(--card); border: 1px solid var(--border); border-radius: 12px; padding: 24px; transition: box-shadow 0.2s, border-color 0.2s; }
        .trending-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.06); border-color: var(--primary); }
        .trending-tag { font-size: 0.75rem; font-weight: 700; background: var(--hero-bg); color: var(--primary-dark); padding: 4px 12px; border-radius: 20px; display: inline-block; margin-bottom: 14px; }

        .service-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
        .service-item { background: var(--card); border: 1px solid var(--border); border-radius: 10px; padding: 18px 20px; display: flex; align-items: center; gap: 16px; transition: 0.2s; }
        .service-item:hover { border-color: var(--primary); }
        
        .service-icon-img { width: 44px; height: 44px; border-radius: 10px; object-fit: cover; flex-shrink: 0; }

        footer { background: var(--card); border-top: 1px solid var(--border); padding: 60px 48px; margin-top: 40px; }
        @media (max-width: 768px) { .hero { grid-template-columns: 1fr; padding: 40px 24px; gap: 40px; text-align: center; } .hero-blob { width: 300px; height: 300px; } .trending-cards, .service-grid { grid-template-columns: 1fr; } .nav-bar { padding: 0 20px; } .section { padding: 50px 20px; } .hero-badge { margin: 0 auto 24px; } .service-pills { justify-content: center; } }
    </style>
</head>
<body>

    <nav class="nav-bar">
        <a href="/" class="nav-logo">
            <img src="https://images.unsplash.com/photo-1583337130417-3346a1be7dee?w=64&h=64&fit=crop" style="width:32px; height:32px; border-radius:8px; object-fit:cover;">
            Daily Pet Care
        </a>
        <div style="display:flex; gap:16px; align-items:center;">
            <button id="themeToggle" class="theme-btn">
                <svg id="moonIcon" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                <svg id="sunIcon" style="display:none;" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
            </button>
            <a href="{{ route('login') }}" style="font-size:0.9rem; font-weight:600; color:var(--text); text-decoration:none;">Masuk</a>
            <a href="{{ route('register') }}" class="btn-hero-primary" style="padding:10px 22px;">Register</a>
        </div>
    </nav>

    {{-- ========= HERO ========= --}}
    <section class="hero">
        <div>
            <div class="hero-badge">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0;"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                Terpercaya #1 di Jakarta
            </div>
            <h1 class="hero-title">
                Paws-itively<br>the <em>Best Pet Care</em><br>in Town
            </h1>
            <p class="hero-desc">
                Baik untuk sekadar memanjakan mereka atau saat Anda perlu bepergian, pusat perawatan hewan kami adalah pilihan utama bagi anabul kesayangan Anda.
            </p>
            <div style="display:flex; gap:14px; flex-wrap:wrap;">
                <a href="{{ route('register') }}" class="btn-hero-primary">Buat Janji Temu</a>
                <a href="#services" class="btn-hero-secondary">Pelajari lebih lanjut &rarr;</a>
            </div>
            <div class="service-pills">
                <div class="service-pill">Grooming</div>
                <div class="service-pill">Klinik Hewan</div>
                <div class="service-pill">Penitipan</div>
                <div class="service-pill">Pelatihan</div>
            </div>
        </div>
        <div class="hero-visual">
            <div class="hero-blob">
                <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?auto=format&fit=crop&q=80&w=600&h=600" alt="Cute Cat">
            </div>
        </div>
    </section>

    {{-- ========= TRENDING ========= --}}
    @if($trendingServices->count())
    <section class="section" id="trending">
        <h2 class="section-title">Sedang Trending</h2>
        <p class="section-sub">Layanan paling banyak dipesan pelanggan bulan ini</p>
        <div class="trending-cards">
            @foreach($trendingServices as $i => $s)
            <div class="trending-card {{ $i===0 ? 'top' : '' }}">
                @if($i===0)<div class="trending-tag">#1 Terpopuler</div>
                @elseif($i===1)<div class="trending-tag">#2 Terpopuler</div>
                @else<div class="trending-tag">#3 Terpopuler</div>@endif
                <div style="font-weight:700; font-size:0.95rem; margin-bottom:6px;">{{ $s->nama_layanan }}</div>
                <div style="color:var(--muted); font-size:0.8rem; margin-bottom:14px;">{{ $s->total_used }}x dipesan bulan ini</div>
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
        <h3 style="font-size:0.875rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:var(--muted); margin-bottom:16px;">Perawatan & Umum</h3>
        <div class="service-grid mb-4">
            @foreach($umumServices as $s)
            <div class="service-item">
                <div style="width:44px;height:44px;background:var(--hero-bg);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;color:var(--primary-dark);">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-2-5.5c-.83 0-1.5-.67-1.5-1.5S9.17 12 10 12s1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm4 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm-2-4.5c-.83 0-1.5-.67-1.5-1.5S9.17 7 10 7s1.5.67 1.5 1.5S12.83 10 12 10z"/></svg>
                </div>
                <div>
                    <div style="font-weight:600; font-size:0.875rem; margin-bottom:2px;">{{ $s->nama_layanan }}</div>
                    <div style="color:var(--primary); font-weight:800; font-size:1rem;">Rp {{ number_format($s->harga, 0, ',', '.') }}</div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($vaksinServices->count())
        <h3 style="font-size:0.875rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:var(--muted); margin-bottom:16px; margin-top:28px;">Vaksinasi</h3>
        <div class="service-grid">
            @foreach($vaksinServices as $s)
            <div class="service-item" style="grid-column: span 1;">
                <div style="width:44px;height:44px;background:rgba(59,130,246,0.1);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;color:#3B82F6;">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 3l-6 6M21 3v6M21 3h-6M10 14l-7 7M3 21l4-4M10.5 7.5l6 6M12 14l-4.5-4.5M3.5 16.5l4-4M15.5 8.5l4-4"/></svg>
                </div>
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
                    <img src="https://images.unsplash.com/photo-1583337130417-3346a1be7dee?w=64&h=64&fit=crop" style="width:32px; height:32px; border-radius:8px; object-fit:cover;">
                    <strong style="color:var(--text);">Daily Pet Care</strong>
                </div>
                <p style="color:var(--muted); font-size:0.85rem; line-height:1.7;">Klinik & Salon Hewan Terpercaya. Kami merawat hewan Anda seperti keluarga sendiri sejak 2024.</p>
            </div>
            <div>
                <h4 style="font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:var(--muted); margin-bottom:16px;">Kontak</h4>
                <ul style="list-style:none; font-size:0.875rem; color:var(--muted); line-height:2.2;">
                    <li style="display:flex;align-items:center;gap:8px;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        +62 812-3456-7890
                    </li>
                    <li style="display:flex;align-items:center;gap:8px;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        hello@dailypetcare.id
                    </li>
                    <li style="display:flex;align-items:center;gap:8px;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        Jl. Pahlawan No. 45, Jakarta
                    </li>
                </ul>
            </div>
            <div>
                <h4 style="font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:var(--muted); margin-bottom:16px;">Sosial Media</h4>
                <ul style="list-style:none; font-size:0.875rem; color:var(--muted); line-height:2.2;">
                    <li style="display:flex;align-items:center;gap:8px;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                        <a href="#" style="color:var(--primary); text-decoration:none;">@dailypetcare_id</a>
                    </li>
                    <li style="display:flex;align-items:center;gap:8px;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        <a href="#" style="color:var(--primary); text-decoration:none;">Daily Pet Care Official</a>
                    </li>
                    <li style="display:flex;align-items:center;gap:8px;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.42a2.78 2.78 0 0 0-1.94 2C1 8.13 1 12 1 12s0 3.87.46 5.58a2.78 2.78 0 0 0 1.94 2C5.12 20 12 20 12 20s6.88 0 8.6-.42a2.78 2.78 0 0 0 1.94-2C23 15.87 23 12 23 12s0-3.87-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>
                        <a href="#" style="color:var(--primary); text-decoration:none;">Daily Pet Care TV</a>
                    </li>
                </ul>
            </div>
        </div>
        <div style="max-width:1200px; margin:32px auto 0; border-top:1px solid var(--border); padding-top:24px; text-align:center; color:var(--muted); font-size:0.8rem;">
            &copy; {{ date('Y') }} Daily Pet Care. Fictional project for academic demonstration.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('themeToggle');
            if(!toggleBtn) return;
            const moon = document.getElementById('moonIcon');
            const sun = document.getElementById('sunIcon');
            
            function updateIcon(theme) {
                if(theme === 'dark') { moon.style.display = 'none'; sun.style.display = 'block'; }
                else { moon.style.display = 'block'; sun.style.display = 'none'; }
            }
            updateIcon(document.documentElement.getAttribute('data-theme'));

            toggleBtn.addEventListener('click', () => {
                let current = document.documentElement.getAttribute('data-theme');
                let next = current === 'dark' ? 'light' : 'dark';
                document.documentElement.setAttribute('data-theme', next);
                localStorage.setItem('theme', next);
                updateIcon(next);
            });
        });
    </script>
</body>
</html>
