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
                    <div class="input-group">
                        <input type="password" class="form-control form-control-custom" name="password" id="password" placeholder="••••••••" required>
                        <button class="btn btn-outline-secondary d-flex align-items-center justify-content-center" type="button" id="togglePassword" style="border-color: var(--border); width: 45px;">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                              <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                              <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                            </svg>
                        </button>
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
        const svgEye = `<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>`;
        const svgEyeSlash = `<path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/><path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/><path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>`;
        
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            const isPassword = passwordInput.getAttribute('type') === 'password';
            
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            icon.innerHTML = isPassword ? svgEyeSlash : svgEye;
        });
    </script>
</body>
</html>
