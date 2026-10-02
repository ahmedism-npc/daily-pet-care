<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Daily Pet Care</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body { background-color: var(--background); font-family: 'DM Sans', sans-serif; }
        .hero { padding: 100px 20px 80px; text-align: center; }
        .service-card { transition: transform 0.2s, box-shadow 0.2s; border-radius: 12px; }
        .service-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(163, 119, 100, 0.15); }
        .icon-circle { width: 60px; height: 60px; background-color: #fcece5; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; color: var(--primary); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: var(--sidebar); border-bottom: 1px solid var(--border); position: sticky; top: 0; z-index: 1000;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/" style="color: var(--primary); font-weight: bold; gap: 10px;">
                <span style="font-size: 1.5rem;">🐾</span> Daily Pet Care
            </a>
            <div class="ms-auto d-flex gap-2">
                <a href="{{ route('login') }}" class="btn btn-outline-secondary" style="border-color: var(--border);">Log in</a>
                <a href="{{ route('register') }}" class="btn btn-primary-custom">Register</a>
            </div>
        </div>
    </nav>

    <div class="hero">
        <span class="badge mb-3" style="background-color: var(--muted); color: var(--foreground); padding: 8px 16px; border-radius: 20px; font-weight: 500;">Pilihan #1 Pet Lovers</span>
        <h1 style="color: var(--primary); font-weight: 800; font-size: 3rem; max-width: 800px; margin: 0 auto;">Perawatan Terbaik untuk Sahabat Berbulu Anda</h1>
        <p class="text-muted mt-4 mb-5" style="font-size: 1.15rem; max-width: 600px; margin: 0 auto;">Mulai dari layanan grooming profesional, hotel penitipan hewan yang nyaman, hingga pemeriksaan kesehatan lengkap oleh staf berpengalaman kami.</p>
        
        <div class="container mt-5 pt-4">
            <h3 class="mb-5" style="color: var(--foreground); font-weight: bold;">Katalog Layanan Unggulan</h3>
            <div class="row justify-content-center g-4">
                @foreach($services as $s)
                <div class="col-md-4 col-sm-6">
                    <div class="card card-custom p-4 h-100 service-card text-center border-0">
                        <div class="icon-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                              <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15"/>
                            </svg>
                        </div>
                        <h5 style="color: var(--foreground); font-weight: 600;" class="mb-3">{{ $s->nama_layanan }}</h5>
                        <p class="text-muted small mb-4">Layanan perawatan premium untuk memastikan kesehatan dan kenyamanan peliharaan Anda.</p>
                        <div class="mt-auto">
                            <h4 style="color: var(--primary); font-weight: 700; margin: 0;">Rp {{ number_format($s->harga, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Contact & Footer Section -->
    <footer class="mt-5 py-5" style="background-color: var(--sidebar); border-top: 1px solid var(--border);">
        <div class="container">
            <div class="row g-4 text-center text-md-start">
                <div class="col-md-4">
                    <h5 style="color: var(--primary); font-weight: bold; margin-bottom: 20px;">🐾 Daily Pet Care</h5>
                    <p class="text-muted small">Klinik & Salon Hewan Terpercaya.<br>Kami merawat hewan Anda seperti keluarga sendiri.</p>
                </div>
                <div class="col-md-4">
                    <h6 style="color: var(--foreground); font-weight: 600; margin-bottom: 20px;">Hubungi Admin</h6>
                    <ul class="list-unstyled text-muted small" style="line-height: 2;">
                        <li>📞 WhatsApp: +62 812-3456-7890</li>
                        <li>✉️ Email: hello@dailypetcare.id</li>
                        <li>📍 Alamat: Jl. Pahlawan No. 45, Jakarta Selatan</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 style="color: var(--foreground); font-weight: 600; margin-bottom: 20px;">Sosial Media Kami</h6>
                    <ul class="list-unstyled text-muted small" style="line-height: 2;">
                        <li>📷 Instagram: <a href="#" style="color: var(--primary); text-decoration: none;">@dailypetcare_fiktif</a></li>
                        <li>🎵 TikTok: <a href="#" style="color: var(--primary); text-decoration: none;">@dailypetcare.id</a></li>
                        <li>📘 Facebook: <a href="#" style="color: var(--primary); text-decoration: none;">Daily Pet Care Official</a></li>
                    </ul>
                </div>
            </div>
            <hr style="border-color: var(--border); margin: 30px 0;">
            <div class="text-center text-muted small">
                &copy; {{ date('Y') }} Daily Pet Care. Fictional project for demonstration.
            </div>
        </div>
    </footer>
</body>
</html>
