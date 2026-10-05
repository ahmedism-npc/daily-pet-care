@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-start mb-5">
    <div>
        <h1 style="font-weight:800; font-size:1.6rem; margin:0; color:var(--foreground);">Dashboard</h1>
        <p style="color:var(--foreground-muted); margin:4px 0 0; font-size:0.875rem;">Monitor kinerja bisnis & metrik utama secara real-time</p>
    </div>
    <a href="{{ route('transactions.create') }}" class="btn btn-primary-custom px-4 py-2 d-flex align-items-center gap-2">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Transaksi Baru
    </a>
</div>

{{-- ====== STAT CARDS ====== --}}
<div class="row g-3 mb-5">
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="label">Pendapatan Hari Ini</div>
            <div class="value">Rp {{ number_format($incomeToday/1000, 1) }}k</div>
            <div class="trend trend-up">↑ dari kemarin</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="label">Transaksi Hari Ini</div>
            <div class="value">{{ $trxToday }}</div>
            <div class="trend trend-neutral">Total semua: {{ $trxCount }}</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="label">Pelanggan Aktif</div>
            <div class="value">{{ $totalCustomers }}</div>
            <div class="trend trend-neutral">{{ $totalPets }} hewan terdaftar</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="label">Total Pendapatan</div>
            <div class="value">Rp {{ number_format($totalIncome/1000000, 1) }}jt</div>
            <div class="trend trend-up">{{ $staffCount }} staf aktif</div>
        </div>
    </div>
</div>

{{-- ====== CHARTS ====== --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 style="font-size:1rem; font-weight:700; margin:0;">Analitik Performa</h2>
    <div class="btn-group" role="group">
        @foreach(['1w'=>'1 Mgg','1m'=>'1 Bln','3m'=>'3 Bln','6m'=>'6 Bln'] as $key=>$label)
        <a href="?period={{ $key }}" class="btn btn-sm {{ $period==$key ? 'btn-primary-custom' : '' }}"
           style="{{ $period!=$key ? 'border:1px solid var(--border);color:var(--foreground-muted);border-radius:6px;' : 'border-radius:6px;' }} font-size:0.78rem; padding:4px 12px;">
            {{ $label }}
        </a>
        @endforeach
    </div>
</div>

<div class="row g-4 mb-5">
    {{-- Line Chart --}}
    <div class="col-lg-8">
        <div class="card-custom p-4">
            <div class="mb-3">
                <div style="font-size:0.875rem; font-weight:700;">Tren Pendapatan Harian</div>
                <div style="font-size:0.78rem; color:var(--foreground-muted);">Pendapatan harian selama periode yang dipilih</div>
            </div>
            <div style="position:relative; height:240px;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
    {{-- Doughnut Chart --}}
    <div class="col-lg-4">
        <div class="card-custom p-4 h-100">
            <div class="mb-3">
                <div style="font-size:0.875rem; font-weight:700;">Layanan Paling Laris</div>
                <div style="font-size:0.78rem; color:var(--foreground-muted);">Berdasarkan jumlah pemakaian</div>
            </div>
            <div style="position:relative; height:180px;">
                <canvas id="topServicesChart"></canvas>
            </div>
            {{-- Legend --}}
            <div class="mt-3" id="pieLegend"></div>
        </div>
    </div>
</div>

{{-- ====== RECENT TRANSACTIONS TABLE ====== --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 style="font-size:1rem; font-weight:700; margin:0;">Transaksi Terbaru</h2>
    <a href="{{ route('transactions.history') }}" style="font-size:0.8rem; color:var(--primary); text-decoration:none;">Lihat semua →</a>
</div>
<div class="card-custom overflow-hidden" style="padding:0;">
    <table class="table table-custom m-0">
        <thead>
            <tr><th>ID</th><th>Tanggal</th><th>Pelanggan</th><th>Total</th><th></th></tr>
        </thead>
        <tbody>
        @forelse($transactions as $trx)
            <tr>
                <td><span style="font-family:monospace; font-size:0.8rem; color:var(--foreground-muted);">TRX-00{{ $trx->id }}</span></td>
                <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</td>
                <td style="font-weight:500;">{{ $trx->customer->nama ?? '—' }}</td>
                <td><strong>Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</strong></td>
                <td class="text-end"><a href="{{ route('transactions.show', $trx) }}" style="font-size:0.78rem; color:var(--primary); text-decoration:none;">Detail →</a></td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center py-4" style="color:var(--foreground-muted);">Belum ada transaksi.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
Chart.defaults.font.family = "'DM Sans', sans-serif";
Chart.defaults.font.size = 11;
Chart.defaults.color = "#9CA3AF";

const palette = ['#FFB01F', '#FFC14D', '#FFD27A', '#E59D1B', '#CC8D18', '#FFE4A8', '#B27B15'];

// Line Chart
const revCtx = document.getElementById('revenueChart').getContext('2d');
const gradient = revCtx.createLinearGradient(0, 0, 0, 240);
gradient.addColorStop(0, 'rgba(255, 176, 31, 0.25)');
gradient.addColorStop(1, 'rgba(255, 176, 31, 0)');

const chartTotals = {!! $chartTotals !!}.map(Number);

new Chart(revCtx, {
    type: 'line',
    data: {
        labels: {!! $chartDates !!},
        datasets: [{
            data: chartTotals,
            borderColor: '#FFB01F',
            backgroundColor: gradient,
            borderWidth: 2,
            pointRadius: 0,
            pointHoverRadius: 6,
            pointHoverBackgroundColor: '#FFB01F',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        interaction: {
            mode: 'index',
            intersect: false,
        },
        plugins: { 
            legend: { display: false }, 
            tooltip: {
                callbacks: { label: ctx => ' Rp ' + (ctx.parsed.y).toLocaleString('id-ID') }
            }
        },
        scales: {
            y: { beginAtZero: true, grid: { color: 'rgba(156, 163, 175, 0.1)', borderDash: [3,3] },
                 ticks: { callback: v => 'Rp'+(v/1000)+'k', maxTicksLimit: 5 } },
            x: { grid: { display: false }, ticks: { maxTicksLimit: 8 } }
        }
    }
});

// Doughnut Chart
const labels = {!! $pieLabels !!};
const pieData = {!! $pieData !!}.map(Number);
const pieCtx = document.getElementById('topServicesChart').getContext('2d');
new Chart(pieCtx, {
    type: 'doughnut',
    data: {
        labels,
        datasets: [{ data: pieData, backgroundColor: palette, borderWidth: 0, hoverOffset: 4 }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        cutout: '68%',
        plugins: { 
            legend: { display: false },
            tooltip: {
                callbacks: { label: ctx => ' ' + ctx.parsed + ' pesanan' }
            }
        }
    }
});

// Custom Legend
const legend = document.getElementById('pieLegend');
legend.innerHTML = ''; // bersihkan legend sebelumnya
const total = pieData.reduce((a,b) => a+b, 0);
labels.forEach((l, i) => {
    const pct = total > 0 ? Math.round(pieData[i]/total*100) : 0;
    legend.innerHTML += `
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
        <div style="display:flex;align-items:center;gap:8px;">
            <div style="width:8px;height:8px;border-radius:50%;background:${palette[i % palette.length]};flex-shrink:0;"></div>
            <span style="font-size:0.75rem;color:var(--foreground-muted);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:120px;">${l}</span>
        </div>
        <span style="font-size:0.75rem;font-weight:600;">${pct}%</span>
    </div>`;
});
</script>
@endsection
