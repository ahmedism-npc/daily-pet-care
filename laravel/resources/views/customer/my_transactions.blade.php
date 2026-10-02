@extends('layouts.app')
@section('content')
<h2 class="mb-4" style="color:var(--primary); font-weight:bold;">🧾 Riwayat Perawatan Saya</h2>
<div class="card card-custom p-3">
    <table class="table table-custom align-middle">
        <thead><tr><th>No Transaksi</th><th>Tanggal</th><th>Hewan</th><th>Staf</th><th>Layanan</th><th>Total</th></tr></thead>
        <tbody>
        @forelse($transactions as $trx)
        <tr>
            <td>TRX-00{{ $trx->id }}</td>
            <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</td>
            <td>{{ $trx->pet->nama_hewan ?? '-' }}</td>
            <td>{{ $trx->staff->nama_staff ?? '-' }}</td>
            <td>
                @foreach($trx->details as $d)
                    <span class="badge mb-1" style="background-color:var(--muted); color:var(--foreground);">{{ $d->service->nama_layanan ?? '-' }} x{{ $d->jumlah }}</span>
                @endforeach
            </td>
            <td><strong>Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</strong></td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center text-muted py-3">Belum ada riwayat transaksi.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
