<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Care System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar-wrapper py-4">
                <div class="position-sticky">
                    <h4 class="px-3 mb-4" style="color: var(--primary); font-weight: bold;">🐾 Pet Care</h4>
                    
                    <div class="px-3 mb-3 text-muted" style="font-size: 0.85rem;">
                        Login sebagai: <strong style="color: var(--foreground);">{{ ucfirst(Auth::user()->role) }}</strong>
                    </div>

                    <ul class="nav flex-column px-2">
                        <li class="nav-item">
                            <a class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">🏠 Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="sidebar-link {{ request()->is('customers*') ? 'active' : '' }}" href="{{ route('customers.index') }}">👥 Data Pelanggan</a>
                        </li>
                        <li class="nav-item">
                            <a class="sidebar-link {{ request()->is('services*') ? 'active' : '' }}" href="{{ route('services.index') }}">📋 Katalog Layanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="sidebar-link {{ request()->is('transactions*') ? 'active' : '' }}" href="{{ route('transactions.create') }}">💰 Transaksi Kasir</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #D1FAE5; color: #065F46; border: none; border-radius: var(--radius);">
                        <strong>Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
