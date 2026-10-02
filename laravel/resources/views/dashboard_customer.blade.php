@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom" style="border-color: var(--border) !important;">
    <h1 class="h2" style="color: var(--primary);">🏠 Halo, {{ $customer->nama }} 👋</h1>
</div>

<!-- Kartu Ringkasan -->
<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card card-custom p-3"><div class="card-body">
            <h6 class="text-muted" style="font-size:0.8rem;">HEWAN PELIHARAAN SAYA</h6>
            <h2 class="card-title-custom mb-0">{{ $totalPets }}</h2>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom p-3"><div class="card-body">
            <h6 class="text-muted" style="font-size:0.8rem;">RIWAYAT KUNJUNGAN</h6>
            <h2 class="card-title-custom mb-0">{{ $trxCount }}x</h2>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom p-3"><div class="card-body">
            <h6 class="text-muted" style="font-size:0.8rem;">TOTAL PENGELUARAN</h6>
            <h2 class="card-title-custom mb-0">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h2>
        </div></div>
    </div>
</div>

@if($lastVisit)
<div class="alert" style="background-color:var(--card); border:1px solid var(--border); border-radius:var(--radius);">
    <strong>Kunjungan Terakhir:</strong> {{ \Carbon\Carbon::parse($lastVisit->tanggal)->format('d M Y') }}
</div>
@endif

<!-- Daftar Layanan Tersedia -->
<h5 class="mb-3">📋 Daftar Layanan & Harga Terbaru</h5>
<div class="row g-3 mb-5">
    @foreach($services as $s)
    <div class="col-md-4">
        <div class="card card-custom p-3">
            <h6 style="color:var(--primary); font-weight:600;">{{ $s->nama_layanan }}</h6>
            <h5>Rp {{ number_format($s->harga, 0, ',', '.') }}</h5>
        </div>
    </div>
    @endforeach
</div>

<!-- Riwayat Perawatan -->
<h5 class="mb-3">🧾 Riwayat Perawatan Terbaru</h5>
<div class="table-responsive">
    <table class="table table-custom align-middle">
        <thead><tr><th>No Transaksi</th><th>Tanggal</th><th>Hewan</th><th>Total Biaya</th></tr></thead>
        <tbody>
        @forelse($transactions as $trx)
            <tr>
                <td>TRX-00{{ $trx->id }}</td>
                <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</td>
                <td>{{ $trx->pet->nama_hewan ?? '-' }}</td>
                <td>Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center text-muted py-3">Belum ada riwayat perawatan.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
