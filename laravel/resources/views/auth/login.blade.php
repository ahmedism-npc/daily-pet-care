<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk · Daily Pet Care</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body { margin:0; display:flex; min-height:100vh; background: #F8F6F2; }

        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #A37764 0%, #7A5344 100%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 48px;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }

        .login-left::after {
            content: '';
            position: absolute;
            bottom: 80px; left: -80px;
            width: 220px; height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }

        .login-right {
            width: 460px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px;
            background: #fff;
            border-left: 1px solid #ede9e4;
        }

        .login-form-wrap { width: 100%; max-width: 360px; }

        .input-clean {
            border: 1px solid #E8DDD7;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 0.875rem;
            width: 100%;
            background: #FAFAF8;
            color: #2D2117;
            transition: border-color 0.15s, box-shadow 0.15s;
            outline: none;
        }
        .input-clean:focus {
            border-color: #A37764;
            box-shadow: 0 0 0 3px rgba(163,119,100,0.12);
            background: #fff;
        }

        @media (max-width: 768px) {
            .login-left { display: none; }
            .login-right { width: 100%; border-left: none; }
        }
    </style>
</head>
<body>

    {{-- LEFT: Branding Panel --}}
    <div class="login-left">
        <div style="position:relative; z-index:2;">
            <div style="font-size:2.5rem; margin-bottom:16px;">🐾</div>
            <h1 style="color:#fff; font-weight:800; font-size:2rem; line-height:1.25; margin-bottom:14px;">
                Sistem Manajemen<br>Pet Care
            </h1>
            <p style="color:rgba(255,255,255,0.75); font-size:0.95rem; line-height:1.7; max-width:380px; margin:0;">
                Kelola pelanggan, transaksi, staf, dan laporan bisnis pet care Anda dalam satu platform yang terintegrasi.
            </p>
            <div style="margin-top:40px; display:flex; gap:24px;">
                <div>
                    <div style="font-size:1.4rem; font-weight:800; color:#fff;">500+</div>
                    <div style="font-size:0.78rem; color:rgba(255,255,255,0.6);">Hewan dirawat</div>
                </div>
                <div>
                    <div style="font-size:1.4rem; font-weight:800; color:#fff;">3 Bulan</div>
                    <div style="font-size:0.78rem; color:rgba(255,255,255,0.6);">Beroperasi</div>
                </div>
                <div>
                    <div style="font-size:1.4rem; font-weight:800; color:#fff;">4.9★</div>
                    <div style="font-size:0.78rem; color:rgba(255,255,255,0.6);">Rating pelanggan</div>
                </div>
            </div>
        </div>
    </div>

    {{-- RIGHT: Login Form --}}
    <div class="login-right">
        <div class="login-form-wrap">
            <div class="mb-6" style="margin-bottom:32px;">
                <h2 style="font-weight:800; font-size:1.4rem; margin:0 0 6px; color:#2D2117;">Selamat datang kembali</h2>
                <p style="color:#78695F; font-size:0.875rem; margin:0;">Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            @if($errors->any())
                <div style="background:#fef2f2; border:1px solid #fecaca; color:#dc2626; border-radius:8px; padding:10px 14px; font-size:0.83rem; margin-bottom:20px; display:flex; align-items:center; gap:8px;">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div style="margin-bottom:16px;">
                    <label style="display:block; font-size:0.8rem; font-weight:600; color:#2D2117; margin-bottom:6px;">Email</label>
                    <input type="email" name="email" class="input-clean" placeholder="nama@petcare.com"
                           value="{{ old('email') }}" required autofocus>
                </div>

                <div style="margin-bottom:10px;">
                    <label style="display:block; font-size:0.8rem; font-weight:600; color:#2D2117; margin-bottom:6px;">Password</label>
                    <div style="position:relative;">
                        <input type="password" name="password" class="input-clean" id="password"
                               placeholder="••••••••" required style="padding-right:44px;">
                        <button type="button" id="togglePassword" onclick="togglePwd()"
                                style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#78695F; padding:0; display:flex;">
                            <svg id="eyeIcon" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; margin-top:14px;">
                    <label style="display:flex; align-items:center; gap:6px; font-size:0.8rem; color:#78695F; cursor:pointer;">
                        <input type="checkbox" name="remember" style="accent-color:#A37764;">
                        Ingat saya
                    </label>
                    <a href="#" style="font-size:0.8rem; color:#A37764; text-decoration:none;">Lupa password?</a>
                </div>

                <button type="submit" style="width:100%; background:#A37764; color:#fff; border:none; border-radius:8px; padding:11px; font-weight:700; font-size:0.9rem; cursor:pointer; transition:background 0.15s;">
                    Masuk ke Dashboard
                </button>
            </form>

            <p style="text-align:center; margin-top:24px; font-size:0.82rem; color:#78695F;">
                Belum punya akun?
                <a href="{{ route('register') }}" style="color:#A37764; font-weight:600; text-decoration:none;">Register</a>
            </p>
        </div>
    </div>

    <script>
        const eyeOpen  = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
        const eyeClose = `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`;
        function togglePwd() {
            const inp = document.getElementById('password');
            const ico = document.getElementById('eyeIcon');
            const show = inp.type === 'password';
            inp.type = show ? 'text' : 'password';
            ico.innerHTML = show ? eyeClose : eyeOpen;
        }
    </script>
</body>
</html>
