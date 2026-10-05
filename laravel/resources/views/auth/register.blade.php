<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi · Daily Pet Care</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        const theme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', theme);
    </script>
    <style>
        :root {
            --bg: #F9FAFB;
            --card: #FFFFFF;
            --text: #1F2937;
            --muted: #6B7280;
            --border: #E5E7EB;
            --primary: #FFB01F;
        }
        [data-theme="dark"] {
            --bg: #111827;
            --card: #1F2937;
            --text: #F9FAFB;
            --muted: #9CA3AF;
            --border: #374151;
        }

        * { box-sizing: border-box; font-family: 'DM Sans', sans-serif; }
        body { margin:0; display:flex; min-height:100vh; background: var(--bg); transition: 0.3s; }

        .login-left {
            flex: 1;
            background: url('https://images.unsplash.com/photo-1548199973-03cce0bbc87b?auto=format&fit=crop&q=80&w=1200') center/cover no-repeat;
            position: relative;
        }
        .login-left::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 100%);
        }
        .login-left-content {
            position: absolute; bottom: 0; left: 0; width: 100%;
            padding: 48px; z-index: 2; color: #fff;
        }

        .login-right {
            width: 480px; flex-shrink: 0; display: flex; flex-direction: column;
            padding: 32px 48px; background: var(--card); border-left: 1px solid var(--border);
            position: relative; transition: 0.3s;
            overflow-y: auto;
        }
        
        .top-bar { display: flex; justify-content: flex-end; width: 100%; margin-bottom: 24px; }
        .theme-btn {
            background: transparent; border: 1px solid var(--border); color: var(--muted);
            border-radius: 8px; width: 36px; height: 36px; display: flex; align-items: center;
            justify-content: center; cursor: pointer; transition: 0.2s;
        }

        .login-form-wrap { width: 100%; margin: auto 0; }

        .input-clean {
            border: 1px solid var(--border); border-radius: 8px; padding: 12px 14px;
            font-size: 0.9rem; width: 100%; background: var(--bg); color: var(--text);
            transition: 0.2s; outline: none; margin-top: 6px;
        }
        .input-clean:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(255,176,31,0.15); background: var(--card); }
        
        .btn-submit {
            width: 100%; background: var(--primary); color: #fff; border: none;
            border-radius: 8px; padding: 12px; font-weight: 700; font-size: 0.95rem;
            cursor: pointer; transition: 0.2s; margin-top: 14px;
        }
        .btn-submit:hover { background: #E59D1B; transform: translateY(-1px); }

        .form-row { display: flex; gap: 12px; margin-bottom: 12px; }
        .form-col { flex: 1; }

        @media (max-width: 768px) {
            .login-left { display: none; }
            .login-right { width: 100%; border-left: none; }
        }
    </style>
</head>
<body>

    <div class="login-left">
        <div class="login-left-content">
            <h1 style="font-weight:800; font-size:2.4rem; line-height:1.2; margin-bottom:12px;">
                Gabung Bersama<br>Daily Pet Care
            </h1>
            <p style="color:rgba(255,255,255,0.85); font-size:1rem; line-height:1.6; max-width:400px; margin:0;">
                Buat akun untuk melacak riwayat perawatan anabul Anda dan dapatkan pelayanan terbaik dari kami.
            </p>
        </div>
    </div>

    <div class="login-right">
        <div class="top-bar">
            <button id="themeToggle" class="theme-btn">
                <svg id="moonIcon" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                <svg id="sunIcon" style="display:none;" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
            </button>
        </div>

        <div class="login-form-wrap">
            <div style="margin-bottom:32px;">
                <h2 style="font-weight:800; font-size:1.6rem; margin:0 0 6px; color:var(--text);">Daftar Akun Baru</h2>
                <p style="color:var(--muted); font-size:0.95rem; margin:0;">Lengkapi data diri Anda di bawah ini</p>
            </div>

            @if($errors->any())
                <div style="background:#FEF2F2; border:1px solid #FECACA; color:#DC2626; border-radius:8px; padding:12px; font-size:0.85rem; margin-bottom:24px; display:flex; align-items:center; gap:8px;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div style="margin-bottom:12px;">
                    <label style="font-size:0.85rem; font-weight:600; color:var(--text);">Nama Lengkap</label>
                    <input type="text" name="name" class="input-clean" placeholder="Mis. Budi Santoso" value="{{ old('name') }}" required autofocus>
                </div>
                
                <div style="margin-bottom:12px;">
                    <label style="font-size:0.85rem; font-weight:600; color:var(--text);">No. Handphone / WA</label>
                    <input type="text" name="kontak" class="input-clean" placeholder="Mis. 08123456789" value="{{ old('kontak') }}" required>
                </div>

                <div style="margin-bottom:12px;">
                    <label style="font-size:0.85rem; font-weight:600; color:var(--text);">Email</label>
                    <input type="email" name="email" class="input-clean" placeholder="nama@email.com" value="{{ old('email') }}" required>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label style="font-size:0.85rem; font-weight:600; color:var(--text);">Password</label>
                        <input type="password" name="password" class="input-clean" placeholder="••••••••" required>
                    </div>
                    <div class="form-col">
                        <label style="font-size:0.85rem; font-weight:600; color:var(--text);">Ulangi Password</label>
                        <input type="password" name="password_confirmation" class="input-clean" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn-submit" style="margin-top:24px;">Daftar Sekarang</button>
            </form>

            <p style="text-align:center; margin-top:32px; font-size:0.9rem; color:var(--muted);">
                Sudah punya akun?
                <a href="{{ route('login') }}" style="color:var(--primary); font-weight:600; text-decoration:none;">Masuk di sini</a>
            </p>
        </div>
        <div style="margin-top:auto;"></div>
    </div>

    <script>
        // Dark mode logic
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('themeToggle');
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
