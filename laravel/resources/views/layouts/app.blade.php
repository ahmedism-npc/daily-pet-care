<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pet Care · Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
</head>
<body>
<div style="display:flex; min-height:100vh;">

    {{-- ======================== SIDEBAR ======================== --}}
    <aside class="sidebar-wrapper d-none d-md-flex flex-column py-3">
        {{-- Logo --}}
        <div class="px-4 mb-2 pb-3" style="border-bottom:1px solid var(--border);">
            <a href="{{ route('dashboard') }}" style="text-decoration:none; display:flex; align-items:center; gap:10px;">
                <div style="width:32px;height:32px;background:var(--primary);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:16px;">🐾</div>
                <div>
                    <div style="font-weight:800;font-size:0.9rem;color:var(--foreground);">Pet Care</div>
                    <div style="font-size:0.7rem;color:var(--foreground-muted);">{{ ucfirst(Auth::user()->role) }}</div>
                </div>
            </a>
        </div>

        {{-- Menu --}}
        <nav class="flex-grow-1 mt-1">
            @if(Auth::user()->role === 'admin')
                <div class="sidebar-section-label">Menu Utama</div>
                <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                    Dashboard
                </a>
                <div class="sidebar-section-label">Manajemen</div>
                <a href="{{ route('users.index') }}" class="sidebar-link {{ request()->is('users*') ? 'active' : '' }}">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Akun Pengguna
                </a>
                <a href="{{ route('staff.index') }}" class="sidebar-link {{ request()->is('staff*') ? 'active' : '' }}">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Manajemen Staf
                </a>
                <a href="{{ route('services.index') }}" class="sidebar-link {{ request()->is('services*') ? 'active' : '' }}">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    Master Layanan
                </a>
                <a href="{{ route('customers.index') }}" class="sidebar-link {{ request()->is('customers*') ? 'active' : '' }}">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Data Pelanggan
                </a>
                <div class="sidebar-section-label">Laporan</div>
                <a href="{{ route('transactions.history') }}" class="sidebar-link {{ request()->is('transactions*') ? 'active' : '' }}">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                    Laporan Transaksi
                </a>
            @endif

            @if(Auth::user()->role === 'kasir')
                <div class="sidebar-section-label">Kasir</div>
                <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('transactions.create') }}" class="sidebar-link {{ request()->is('transactions/create') ? 'active' : '' }}">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                    Transaksi Baru (POS)
                </a>
                <a href="{{ route('transactions.history') }}" class="sidebar-link {{ request()->is('transactions/history') ? 'active' : '' }}">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    Daftar Transaksi
                </a>
                <a href="{{ route('customers.index') }}" class="sidebar-link {{ request()->is('customers*') ? 'active' : '' }}">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                    Registrasi Pelanggan
                </a>
            @endif

            @if(Auth::user()->role === 'customer')
                <div class="sidebar-section-label">Portal Saya</div>
                <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                    Beranda
                </a>
                <a href="{{ route('my-pets.index') }}" class="sidebar-link {{ request()->is('my-pets*') ? 'active' : '' }}">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
                    Hewan Peliharaan
                </a>
                <a href="{{ route('my-transactions.index') }}" class="sidebar-link {{ request()->is('my-transactions*') ? 'active' : '' }}">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
                    Riwayat Perawatan
                </a>
                <a href="{{ route('profile.index') }}" class="sidebar-link {{ request()->is('profile*') ? 'active' : '' }}">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Profil Akun
                </a>
            @endif
        </nav>

        {{-- User Info di bawah --}}
        <div class="px-3 pt-3" style="border-top:1px solid var(--border);">
            <div style="font-size:0.78rem; color:var(--foreground-muted);">{{ Auth::user()->email }}</div>
        </div>
    </aside>

    {{-- ======================== MAIN ======================== --}}
    <div style="flex:1; min-width:0; display:flex; flex-direction:column;">
        {{-- Top Navbar --}}
        <header class="top-navbar">
            <div style="font-size:0.85rem; color:var(--foreground-muted);">
                Selamat datang, <strong style="color:var(--foreground);">{{ Auth::user()->name }}</strong>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm d-flex align-items-center gap-2"
                        style="border:1px solid var(--border); border-radius:7px; color:var(--foreground-muted); background:transparent; font-size:0.8rem; padding:5px 12px;">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Log Out
                </button>
            </form>
        </header>

        {{-- Content --}}
        <main style="flex:1; padding:28px 28px; overflow-y:auto;">
            @if(session('success'))
                <div class="alert d-flex align-items-center gap-2 mb-4"
                     style="background:#f0fdf4; border:1px solid #bbf7d0; color:#166534; border-radius:8px; font-size:0.875rem;" role="alert">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    {{ session('success') }}
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" style="font-size:0.7rem;"></button>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
