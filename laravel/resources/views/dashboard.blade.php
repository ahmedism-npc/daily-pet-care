@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-4 border-bottom" style="border-color: var(--border) !important;">
    <h1 class="h2">📊 Dashboard {{ ucfirst(Auth::user()->role) }}</h1>
    <form action="{{ route('logout') }}" method="POST">@csrf
        <button type="submit" class="btn btn-outline-danger">Logout</button>
    </form>
</div>

<!-- Statistik Utama -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card card-custom p-3"><div class="card-body">
            <h6 class="text-muted" style="font-size:0.8rem;">TRANSAKSI HARI INI</h6>
            <h2 class="card-title-custom mb-0">{{ $trxToday }}</h2>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="card card-custom p-3"><div class="card-body">
            <h6 class="text-muted" style="font-size:0.8rem;">PENDAPATAN HARI INI</h6>
            <h2 class="card-title-custom mb-0">Rp {{ number_format($incomeToday, 0, ',', '.') }}</h2>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="card card-custom p-3"><div class="card-body">
            <h6 class="text-muted" style="font-size:0.8rem;">TOTAL PENDAPATAN</h6>
            <h2 class="card-title-custom mb-0">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h2>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="card card-custom p-3"><div class="card-body">
            <h6 class="text-muted" style="font-size:0.8rem;">PELANGGAN TERDAFTAR</h6>
            <h2 class="card-title-custom mb-0">{{ $totalCustomers }}</h2>
        </div></div>
    </div>
</div>
<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card card-custom p-3"><div class="card-body">
            <h6 class="text-muted" style="font-size:0.8rem;">HEWAN TERDAFTAR</h6>
            <h2 class="card-title-custom mb-0">{{ $totalPets }}</h2>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom p-3"><div class="card-body">
            <h6 class="text-muted" style="font-size:0.8rem;">TOTAL TRANSAKSI</h6>
            <h2 class="card-title-custom mb-0">{{ $trxCount }}</h2>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom p-3"><div class="card-body">
            <h6 class="text-muted" style="font-size:0.8rem;">STAF AKTIF</h6>
            <h2 class="card-title-custom mb-0">{{ $staffCount }}</h2>
        </div></div>
    </div>
</div>

<!-- Layanan Terlaris -->
@if($topServices->count())
<h5 class="mb-3">🏆 Layanan Paling Laris</h5>
<div class="row g-3 mb-5">
    @foreach($topServices as $ts)
    <div class="col-md-4">
        <div class="card card-custom p-2 px-3">
            <strong>{{ $ts->nama_layanan }}</strong>
            <small class="text-muted">{{ $ts->total_used }}x digunakan</small>
        </div>
    </div>
    @endforeach
</div>
@endif

<!-- 10 Transaksi Terakhir -->
<h5 class="mb-3">Transaksi Terbaru</h5>
<div class="table-responsive">
    <table class="table table-custom align-middle">
        <thead><tr><th>ID</th><th>Tanggal</th><th>Pelanggan</th><th>Hewan</th><th>Total</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($transactions as $trx)
            <tr>
                <td>TRX-00{{ $trx->id }}</td>
                <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</td>
                <td>{{ $trx->customer->nama ?? '-' }}</td>
                <td>{{ $trx->pet->nama_hewan ?? '-' }}</td>
                <td>Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                <td><a href="{{ route('transactions.show', $trx) }}" class="btn btn-sm btn-outline-secondary" style="border-color:var(--border);">Detail</a></td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted py-3">Belum ada transaksi.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
