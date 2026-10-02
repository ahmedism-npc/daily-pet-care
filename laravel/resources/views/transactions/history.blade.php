@extends('layouts.app')
@section('content')
<h2 class="mb-4" style="color:var(--primary); font-weight:bold;">🧾 Riwayat Seluruh Transaksi</h2>
<div class="card card-custom p-3">
    <table class="table table-custom align-middle">
        <thead><tr><th>ID</th><th>Tanggal</th><th>Pelanggan</th><th>Hewan</th><th>Staf</th><th>Total</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($transactions as $trx)
        <tr>
            <td>TRX-00{{ $trx->id }}</td>
            <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</td>
            <td>{{ $trx->customer->nama ?? '-' }}</td>
            <td>{{ $trx->pet->nama_hewan ?? '-' }}</td>
            <td>{{ $trx->staff->nama_staff ?? '-' }}</td>
            <td><strong>Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</strong></td>
            <td><a href="{{ route('transactions.show', $trx) }}" class="btn btn-sm btn-outline-secondary" style="border-color:var(--border);">Detail</a></td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center text-muted py-3">Belum ada transaksi.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
