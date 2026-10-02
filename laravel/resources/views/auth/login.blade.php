<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Daily Pet Care</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--background);
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
        }
        .form-control-custom {
            background-color: #fcfcf9;
            border: 1px solid var(--border);
            color: var(--foreground);
        }
        .form-control-custom:focus {
            background-color: #ffffff;
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(163, 119, 100, 0.25);
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="card card-custom login-card">
            <div class="text-center mb-4">
                <h2 style="color: var(--primary); font-weight: bold;">🐾 Pet Care</h2>
                <p class="text-muted" style="color: var(--muted-foreground) !important;">Silakan masuk ke akun Anda</p>
            </div>
            
            @if($errors->any())
                <div class="alert alert-danger" style="font-size: 0.9rem; border-radius: var(--radius);">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label" style="color: var(--foreground); font-weight: 500;">Email</label>
                    <input type="email" class="form-control form-control-custom" name="email" id="email" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label" style="color: var(--foreground); font-weight: 500;">Password</label>
                    <!-- Tambahan Fitur Show Password -->
                    <div class="input-group">
                        <input type="password" class="form-control form-control-custom" name="password" id="password" placeholder="••••••••" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="border-color: var(--border);">Lihat</button>
                    </div>
                </div>
                
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember" style="border-color: var(--border);">
                        <label class="form-check-label" for="remember" style="color: var(--foreground); font-size: 0.9rem;">Ingat saya</label>
                    </div>
                    <a href="#" style="color: var(--primary); text-decoration: none; font-size: 0.9rem;">Lupa password?</a>
                </div>
                
                <button type="submit" class="btn btn-primary-custom w-100 py-2" style="font-weight: 600;">Masuk</button>
            </form>
        </div>
    </div>

    <!-- Script Show/Hide Password -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.textContent = type === 'password' ? 'Tutup' : 'Lihat';
        });
    </script>
</body>
</html>
