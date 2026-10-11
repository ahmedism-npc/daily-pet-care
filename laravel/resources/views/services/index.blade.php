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
        <form method="GET" class="d-flex gap-2 mb-3">
            <input type="text" name="search" class="form-control" placeholder="Cari nama layanan..." value="{{ request('search') }}" style="max-width:300px;">
            <select name="sort" class="form-select" style="width:150px;">
                <option value="">Urutkan...</option>
                <option value="nama_layanan" {{ request("sort") == "nama_layanan" ? "selected" : "" }}>Nama</option>
                <option value="harga" {{ request("sort") == "harga" ? "selected" : "" }}>Harga</option>
            </select>
            <button type="submit" class="btn btn-primary-custom">Filter</button>
            @if(request('search') || request('sort'))
                <a href="{{ route('services.index') }}" class="btn btn-light">Reset</a>
            @endif
        </form>

        <div class="card card-custom p-3">
            <table class="table table-custom align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Layanan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $svc)
                    <tr>
                        <td>{{ $svc->id }}</td>
                        <td>{{ $svc->nama_layanan }}</td>
                        <td>Rp {{ number_format($svc->harga, 0, ',', '.') }}</td>
                        <td>
                            @if(auth()->user()->role === 'admin')
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editService{{ $svc->id }}" style="border-color: var(--border);">
                                Edit
                            </button>
                            <form action="{{ route('services.destroy', $svc) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus layanan?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class='mt-3 px-3'>{{ $services->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
</div>

{{-- Modals diletakkan di luar table agar valid HTML --}}
@foreach($services as $svc)
<div class="modal fade" id="editService{{ $svc->id }}" tabindex="-1" aria-labelledby="editServiceLabel{{ $svc->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('services.update', $svc) }}" method="POST" style="border: none; border-radius: var(--radius);">
            @csrf @method('PUT')
            <div class="modal-header" style="border-bottom: 1px solid var(--border);">
                <h5 class="modal-title" id="editServiceLabel{{ $svc->id }}" style="color: var(--primary); font-weight: bold;">Edit Layanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <div class="mb-3">
                    <label class="form-label">Nama Layanan</label>
                    <input type="text" name="nama_layanan" class="form-control" value="{{ $svc->nama_layanan }}" required style="border-color: var(--border);">
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" value="{{ $svc->harga }}" required style="border-color: var(--border);">
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid var(--border);">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary-custom">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection
