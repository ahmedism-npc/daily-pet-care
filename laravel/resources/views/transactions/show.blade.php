@extends('layouts.app')
@section('content')
<h2 class="mb-4" style="color:var(--primary); font-weight:bold;">🧾 Detail Transaksi TRX-00{{ $transaction->id }}</h2>
<div class="row">
    <div class="col-md-6">
        <div class="card card-custom p-4 mb-4">
            <h5 class="mb-3">Informasi Transaksi</h5>
            <table class="table table-borderless mb-0">
                <tr><td class="text-muted" style="width:40%;">Tanggal</td><td><strong>{{ \Carbon\Carbon::parse($transaction->tanggal)->format('d M Y') }}</strong></td></tr>
                <tr><td class="text-muted">Pelanggan</td><td><strong>{{ $transaction->customer->nama ?? '-' }}</strong></td></tr>
                <tr><td class="text-muted">Hewan</td><td><strong>{{ $transaction->pet->nama_hewan ?? '-' }} ({{ $transaction->pet->spesies ?? '' }})</strong></td></tr>
                <tr><td class="text-muted">Staf</td><td><strong>{{ $transaction->staff->nama_staff ?? '-' }}</strong> ({{ $transaction->staff->peran ?? '' }})</td></tr>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-custom p-4">
            <h5 class="mb-3">Rincian Layanan</h5>
            <table class="table table-custom align-middle">
                <thead><tr><th>Layanan</th><th>Jumlah</th><th>Subtotal</th></tr></thead>
                <tbody>
                @foreach($transaction->details as $d)
                <tr>
                    <td>{{ $d->service->nama_layanan ?? '-' }}</td>
                    <td>{{ $d->jumlah }}</td>
                    <td>Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr><td colspan="2" class="text-end"><strong>TOTAL</strong></td>
                    <td><h5 style="color:var(--primary); margin:0;"><strong>Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</strong></h5></td></tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<a href="{{ route('transactions.history') }}" class="btn btn-outline-secondary mt-3" style="border-color:var(--border);">← Kembali ke Riwayat</a>
@endsection
