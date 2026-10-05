@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0" style="font-weight:700;">🧾 Detail Transaksi — TRX-00{{ $transaction->id }}</h2>
        <p class="text-muted mb-0" style="font-size:0.88rem;">{{ \Carbon\Carbon::parse($transaction->tanggal)->format('d F Y') }} · {{ $transaction->customer->nama ?? '-' }} · Staf: {{ $transaction->staff->nama_staff ?? '-' }}</p>
    </div>
    <a href="{{ route('transactions.history') }}" class="btn btn-outline-secondary btn-sm" style="border-color:var(--border);">← Kembali</a>
</div>

<div class="card card-custom p-0 border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-custom align-middle m-0">
            <thead>
                <tr>
                    <th class="ps-4">Hewan</th>
                    <th>Spesies</th>
                    <th>Layanan</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-end pe-4">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaction->details as $d)
                <tr>
                    <td class="ps-4 fw-semibold">{{ $d->pet->nama_hewan ?? '—' }}</td>
                    <td class="text-muted" style="font-size:0.88rem;">{{ $d->pet->spesies ?? '—' }}</td>
                    <td>{{ $d->service->nama_layanan ?? '—' }}</td>
                    <td class="text-center">{{ $d->jumlah }}</td>
                    <td class="text-end pe-4">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end pe-3 fw-bold ps-4" style="background: var(--card);">TOTAL</td>
                    <td class="pe-4 text-end" style="background: var(--card);">
                        <h4 class="m-0" style="color:var(--primary); font-weight:800;">
                            Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}
                        </h4>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
