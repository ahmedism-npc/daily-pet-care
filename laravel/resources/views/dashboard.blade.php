@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">📊 Dashboard Operasional</h1>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card card-custom p-3 border-0 shadow-sm"><div class="card-body">
            <h6 class="text-muted" style="font-size:0.8rem;">TRANSAKSI HARI INI</h6>
            <h2 class="card-title-custom mb-0">{{ $trxToday }}</h2>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="card card-custom p-3 border-0 shadow-sm"><div class="card-body">
            <h6 class="text-muted" style="font-size:0.8rem;">PENDAPATAN HARI INI</h6>
            <h2 class="card-title-custom mb-0 text-success">Rp {{ number_format($incomeToday, 0, ',', '.') }}</h2>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="card card-custom p-3 border-0 shadow-sm"><div class="card-body">
            <h6 class="text-muted" style="font-size:0.8rem;">TOTAL PELANGGAN</h6>
            <h2 class="card-title-custom mb-0">{{ $totalCustomers }}</h2>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="card card-custom p-3 border-0 shadow-sm"><div class="card-body">
            <h6 class="text-muted" style="font-size:0.8rem;">TOTAL HEWAN</h6>
            <h2 class="card-title-custom mb-0">{{ $totalPets }}</h2>
        </div></div>
    </div>
</div>

<!-- Opsi Filter Periode Data Grafik -->
<div class="d-flex justify-content-between align-items-center mt-5 mb-3">
    <h5 class="m-0 fw-bold">Statistik Kinerja</h5>
    <div class="btn-group" role="group">
        <a href="?period=1w" class="btn btn-sm btn-outline-secondary {{ $period == '1w' ? 'active' : '' }}">1 Minggu</a>
        <a href="?period=1m" class="btn btn-sm btn-outline-secondary {{ $period == '1m' ? 'active' : '' }}">1 Bulan</a>
        <a href="?period=3m" class="btn btn-sm btn-outline-secondary {{ $period == '3m' ? 'active' : '' }}">3 Bulan</a>
        <a href="?period=6m" class="btn btn-sm btn-outline-secondary {{ $period == '6m' ? 'active' : '' }}">6 Bulan</a>
        <a href="?period=1y" class="btn btn-sm btn-outline-secondary {{ $period == '1y' ? 'active' : '' }}">1 Tahun</a>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-8">
        <div class="card card-custom p-4 border-0 shadow-sm h-100">
            <h6 class="text-muted mb-4">Tren Pendapatan Harian</h6>
            <canvas id="revenueChart" style="max-height: 300px; width: 100%;"></canvas>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom p-4 border-0 shadow-sm h-100 d-flex flex-column align-items-center">
            <h6 class="text-muted mb-4 w-100 text-start">Layanan Paling Laris</h6>
            <div style="position: relative; height:240px; width:100%;">
                <canvas id="topServicesChart"></canvas>
            </div>
        </div>
    </div>
</div>

<h5 class="mb-3 fw-bold mt-4">Transaksi Terbaru</h5>
<div class="card card-custom p-0 border-0 shadow-sm mb-5">
    <div class="table-responsive">
        <table class="table table-custom align-middle m-0">
            <thead class="table-light"><tr><th class="ps-4">ID</th><th>Tanggal</th><th>Pelanggan</th><th>Hewan</th><th>Total</th><th class="pe-4 text-end">Aksi</th></tr></thead>
            <tbody>
            @forelse($transactions as $trx)
                <tr>
                    <td class="ps-4">TRX-00{{ $trx->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</td>
                    <td>{{ $trx->customer->nama ?? '-' }}</td>
                    <td>{{ $trx->pet->nama_hewan ?? '-' }}</td>
                    <td class="fw-bold">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                    <td class="pe-4 text-end"><a href="{{ route('transactions.show', $trx) }}" class="btn btn-sm btn-light border">Detail</a></td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada transaksi terbaru.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Konfigurasi Umum Chart.js
    Chart.defaults.font.family = "'DM Sans', sans-serif";
    Chart.defaults.color = "#6b7280";

    // 1. Line Chart: Tren Pendapatan
    const revCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revCtx, {
        type: 'line',
        data: {
            labels: {!! $chartDates !!},
            datasets: [{
                label: 'Pendapatan Harian (Rp)',
                data: {!! $chartTotals !!},
                borderColor: '#A37764',
                backgroundColor: 'rgba(163, 119, 100, 0.1)',
                borderWidth: 2,
                pointRadius: 3,
                pointBackgroundColor: '#A37764',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { borderDash: [4, 4] }, ticks: { callback: function(val) { return 'Rp ' + (val/1000) + 'k'; } } },
                x: { grid: { display: false } }
            }
        }
    });

    // 2. Pie Chart: Layanan Paling Laris
    const pieCtx = document.getElementById('topServicesChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: {!! $pieLabels !!},
            datasets: [{
                data: {!! $pieData !!},
                backgroundColor: ['#A37764', '#c9a18f', '#e6c7bb', '#8a5e4d', '#b58e7d', '#d9b3a3', '#664233'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { boxWidth: 12, padding: 15 } }
            },
            cutout: '65%'
        }
    });
</script>
@endsection
