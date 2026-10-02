<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Care System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .top-navbar {
            background-color: var(--card);
            border-bottom: 1px solid var(--border);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logout-btn {
            display: flex; align-items: center; gap: 8px; font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar-wrapper py-4" style="min-height: 100vh;">
                <div class="position-sticky">
                    <a href="{{ route('dashboard') }}" style="text-decoration: none;">
                        <h4 class="px-3 mb-4" style="color: var(--primary); font-weight: bold;">🐾 Pet Care</h4>
                    </a>
                    
                    <div class="px-3 mb-3 text-muted" style="font-size: 0.85rem;">
                        Login sebagai: <strong style="color: var(--foreground); text-transform: uppercase;">{{ Auth::user()->role }}</strong>
                    </div>

                    <ul class="nav flex-column px-2">
                        <!-- A. ROLE: ADMIN -->
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item"><a class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">📊 Dashboard Utama</a></li>
                            <li class="nav-item"><a class="sidebar-link" href="{{ route('users.index') }}">👥 Manajemen Akun</a></li>
                            <li class="nav-item"><a class="sidebar-link" href="{{ route('staff.index') }}">👨‍⚕️ Manajemen Staf</a></li>
                            <li class="nav-item"><a class="sidebar-link {{ request()->is('services*') ? 'active' : '' }}" href="{{ route('services.index') }}">📋 Master Layanan</a></li>
                            <li class="nav-item"><a class="sidebar-link {{ request()->is('customers*') ? 'active' : '' }}" href="{{ route('customers.index') }}">🐾 Data Pelanggan</a></li>
                            <li class="nav-item"><a class="sidebar-link {{ request()->is('transactions*') ? 'active' : '' }}" href="{{ route('transactions.history') }}">📈 Laporan Transaksi</a></li>
                        @endif

                        <!-- B. ROLE: KASIR -->
                        @if(Auth::user()->role === 'kasir')
                            <li class="nav-item"><a class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">📊 Dashboard Kasir</a></li>
                            <li class="nav-item"><a class="sidebar-link {{ request()->is('transactions/create') ? 'active' : '' }}" href="{{ route('transactions.create') }}">💰 Transaksi Baru (POS)</a></li>
                            <li class="nav-item"><a class="sidebar-link" href="{{ route('transactions.history') }}">🧾 Daftar Transaksi</a></li>
                            <li class="nav-item"><a class="sidebar-link {{ request()->is('customers*') ? 'active' : '' }}" href="{{ route('customers.index') }}">👥 Registrasi Pelanggan</a></li>
                        @endif

                        <!-- C. ROLE: CUSTOMER -->
                        @if(Auth::user()->role === 'customer')
                            <li class="nav-item"><a class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">🏠 Portal Customer</a></li>
                            <li class="nav-item"><a class="sidebar-link" href="{{ route('my-pets.index') }}">🐕 Hewan Peliharaan Saya</a></li>
                            <li class="nav-item"><a class="sidebar-link" href="{{ route('my-transactions.index') }}">🧾 Riwayat Perawatan</a></li>
                            <li class="nav-item"><a class="sidebar-link" href="{{ route('profile.index') }}">⚙️ Profil Akun</a></li>
                        @endif
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10">
                <!-- Top Navbar with Logout -->
                <div class="top-navbar w-100">
                    <div>
                        <span class="text-muted">Selamat datang, </span>
                        <strong style="color: var(--primary);">{{ Auth::user()->name }}</strong>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm logout-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                              <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                            </svg>
                            Log Out
                        </button>
                    </form>
                </div>

                <div class="p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #D1FAE5; color: #065F46; border: none; border-radius: var(--radius);">
                            <strong>Berhasil!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
