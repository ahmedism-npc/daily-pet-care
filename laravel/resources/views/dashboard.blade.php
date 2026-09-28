@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom" style="border-color: var(--border) !important;">
    <h1 class="h2">Dashboard Admin</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <!-- Form Logout -->
        <form action="{{ route('logout') }}" method="POST" class="me-2">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Logout</button>
        </form>
        <button type="button" class="btn btn-primary-custom px-4 py-2">+ Transaksi Baru</button>
    </div>
</div>

<!-- Dashboard Cards -->
<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card card-custom p-3">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted" style="color: var(--muted-foreground) !important;">Hewan Terdaftar</h6>
                <h2 class="card-title-custom mb-0">{{ $totalPets }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom p-3">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted" style="color: var(--muted-foreground) !important;">Total Transaksi</h6>
                <h2 class="card-title-custom mb-0">{{ $trxCount }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom p-3">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted" style="color: var(--muted-foreground) !important;">Pendapatan Total</h6>
                <h2 class="card-title-custom mb-0">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h2>
            </div>
        </div>
    </div>
</div>

<!-- Table Section -->
<h4 class="mb-3" style="color: var(--foreground);">Riwayat Transaksi Terbaru</h4>
<div class="table-responsive">
    <table class="table table-custom align-middle">
        <thead>
            <tr>
                <th>ID Trx</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Hewan</th>
                <th>Total Tagihan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $trx)
            <tr>
                <td>TRX-00{{ $trx->id }}</td>
                <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</td>
                <td>{{ $trx->customer_name }}</td>
                <td>{{ $trx->pet_name }}</td>
                <td>Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                <td><span class="badge" style="background-color: var(--primary);">Selesai</span></td>
                <td><button class="btn btn-sm btn-outline-secondary" style="border-color: var(--border);">Detail</button></td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-4">Belum ada transaksi</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
