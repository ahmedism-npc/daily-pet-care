@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 style="color: var(--primary); font-weight: bold;">Katalog Layanan</h2>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card card-custom p-3 mb-4">
            <h5 class="mb-3" style="color: var(--foreground);">Tambah Layanan</h5>
            <form action="{{ route('services.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Layanan</label>
                    <input type="text" name="nama_layanan" class="form-control" required style="border-color: var(--border);">
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" required style="border-color: var(--border);">
                </div>
                <button type="submit" class="btn btn-primary-custom w-100">Simpan Layanan</button>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-custom p-3">
            <table class="table table-custom align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Layanan</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $svc)
                    <tr>
                        <td>{{ $svc->id }}</td>
                        <td>{{ $svc->nama_layanan }}</td>
                        <td>Rp {{ number_format($svc->harga, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
