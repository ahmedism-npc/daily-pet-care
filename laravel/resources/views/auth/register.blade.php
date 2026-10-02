<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Customer - Daily Pet Care</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .register-wrapper { min-height: 100vh; display: flex; align-items: center; justify-content: center; background-color: var(--background); padding: 20px; }
        .register-card { width: 100%; max-width: 500px; padding: 2.5rem; }
    </style>
</head>
<body>
    <div class="register-wrapper">
        <div class="card card-custom register-card">
            <div class="text-center mb-4">
                <h2 style="color: var(--primary); font-weight: bold;">🐾 Registrasi Akun</h2>
                <p class="text-muted">Buat akun untuk melacak riwayat anabul Anda</p>
            </div>
            
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor WhatsApp / HP</label>
                    <input type="text" name="kontak" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ulangi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary-custom w-100 py-2 mt-2">Daftar Sekarang</button>
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" style="color: var(--primary); text-decoration: none;">Sudah punya akun? Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
