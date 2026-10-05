@extends('layouts.app')
@section('content')
<h2 class="mb-4" style="color:var(--primary); font-weight:bold;">🧾 Riwayat Seluruh Transaksi</h2>

<form method="GET" class="d-flex gap-2 mb-3">
    <input type="text" name="search" class="form-control" placeholder="Cari nama pelanggan..." value="{{ request('search') }}" style="max-width:300px;">
    <input type="date" name="date" class="form-control" value="{{ request('date') }}" style="width:160px;">
    <button type="submit" class="btn btn-primary-custom">Filter</button>
    @if(request('search') || request('date'))
        <a href="?" class="btn btn-light">Reset</a>
    @endif
</form>
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
    </table><div class='mt-3 px-3'>{{ $transactions->links('pagination::bootstrap-5') }}</div>
</div>
@endsection
