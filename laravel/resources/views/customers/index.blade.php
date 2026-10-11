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
        <form method="GET" class="d-flex gap-2 mb-3">
            <input type="text" name="search" class="form-control" placeholder="Cari nama, kontak, atau alamat..." value="{{ request('search') }}" style="max-width:300px;">
            <select name="sort" class="form-select" style="width:150px;">
                <option value="">Urutkan...</option>
                <option value="nama" {{ request("sort") == "nama" ? "selected" : "" }}>Nama</option>
                <option value="kontak" {{ request("sort") == "kontak" ? "selected" : "" }}>Kontak</option>
                <option value="alamat" {{ request("sort") == "alamat" ? "selected" : "" }}>Alamat</option>
            </select>
            <button type="submit" class="btn btn-primary-custom">Filter</button>
            @if(request('search') || request('sort'))
                <a href="{{ route('customers.index') }}" class="btn btn-light">Reset</a>
            @endif
        </form>

        <div class="card card-custom p-3">
            <table class="table table-custom align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pelanggan</th>
                        <th>Kontak</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $cust)
                    <tr>
                        <td>{{ $cust->id }}</td>
                        <td style="font-weight: 500;">{{ $cust->nama }}</td>
                        <td>{{ $cust->kontak }}</td>
                        <td>{{ $cust->alamat ?? '-' }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editCustomer{{ $cust->id }}" style="border-color: var(--border);">
                                Edit
                            </button>
                            <form action="{{ route('customers.destroy', $cust) }}" method="POST" onsubmit="return confirm('Yakin hapus pelanggan ini?')" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class='mt-3 px-3'>{{ $customers->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
</div>

{{-- Modals diletakkan di luar table agar valid HTML --}}
@foreach($customers as $cust)
<div class="modal fade" id="editCustomer{{ $cust->id }}" tabindex="-1" aria-labelledby="editCustomerLabel{{ $cust->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('customers.update', $cust) }}" method="POST" style="border: none; border-radius: var(--radius);">
            @csrf @method('PUT')
            <div class="modal-header" style="border-bottom: 1px solid var(--border);">
                <h5 class="modal-title" id="editCustomerLabel{{ $cust->id }}" style="color: var(--primary); font-weight: bold;">Edit Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ $cust->nama }}" required style="border-color: var(--border);">
                </div>
                <div class="mb-3">
                    <label class="form-label">Kontak</label>
                    <input type="text" name="kontak" class="form-control" value="{{ $cust->kontak }}" required style="border-color: var(--border);">
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" style="border-color: var(--border);">{{ $cust->alamat }}</textarea>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid var(--border);">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary-custom">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection
