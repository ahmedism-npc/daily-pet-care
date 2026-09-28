@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 style="color: var(--primary); font-weight: bold;">Data Pelanggan</h2>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card card-custom p-3 mb-4">
            <h5 class="mb-3" style="color: var(--foreground);">Daftarkan Pelanggan</h5>
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required style="border-color: var(--border);">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor Kontak</label>
                    <input type="text" name="kontak" class="form-control" required style="border-color: var(--border);">
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat" class="form-control" rows="2" style="border-color: var(--border);"></textarea>
                </div>
                <button type="submit" class="btn btn-primary-custom w-100">Simpan Data</button>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-custom p-3">
            <table class="table table-custom align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pelanggan</th>
                        <th>Kontak</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $cust)
                    <tr>
                        <td>{{ $cust->id }}</td>
                        <td style="font-weight: 500;">{{ $cust->nama }}</td>
                        <td>{{ $cust->kontak }}</td>
                        <td>{{ $cust->alamat }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
