<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Daily Pet Care</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body { background-color: var(--background); }
        .hero { padding: 80px 20px; text-align: center; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: var(--sidebar); border-bottom: 1px solid var(--border);">
        <div class="container">
            <a class="navbar-brand" href="/" style="color: var(--primary); font-weight: bold;">🐾 Daily Pet Care</a>
            <div class="ms-auto">
                <a href="{{ route('login') }}" class="btn btn-outline-secondary" style="border-color: var(--border);">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary-custom ms-2">Daftar Member</a>
            </div>
        </div>
    </nav>

    <div class="hero">
        <h1 style="color: var(--primary); font-weight: bold;">Perawatan Terbaik untuk Sahabat Berbulu Anda</h1>
        <p class="text-muted mt-3 mb-5" style="font-size: 1.1rem; max-width: 600px; margin: 0 auto;">Kami menyediakan layanan grooming profesional, hotel penitipan hewan, hingga cek kesehatan lengkap.</p>
        
        <div class="container">
            <h3 class="mb-4" style="color: var(--foreground);">Katalog Layanan Kami</h3>
            <div class="row justify-content-center">
                @foreach($services as $s)
                <div class="col-md-4 mb-4">
                    <div class="card card-custom p-3 h-100">
                        <h5 style="color: var(--primary);">{{ $s->nama_layanan }}</h5>
                        <h4 class="mt-2">Rp {{ number_format($s->harga, 0, ',', '.') }}</h4>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
