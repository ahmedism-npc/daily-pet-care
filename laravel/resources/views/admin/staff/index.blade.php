@extends('layouts.app')
@section('content')
<h2 class="mb-4" style="color:var(--primary); font-weight:bold;">Manajemen Staf</h2>
<div class="row">
    <div class="col-md-4">
        <div class="card card-custom p-3 mb-4">
            <h5 class="mb-3">Tambah Staf Baru</h5>
            <form action="{{ route('staff.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Staf</label>
                    <input type="text" name="nama_staff" class="form-control" required style="border-color:var(--border);">
                </div>
                <div class="mb-3">
                    <label class="form-label">Peran</label>
                    <input type="text" name="peran" class="form-control" placeholder="Groomer, Dokter, Caretaker" required style="border-color:var(--border);">
                </div>
                <button type="submit" class="btn btn-primary-custom w-100">Simpan Staf</button>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <form method="GET" class="d-flex gap-2 mb-3">
            <input type="text" name="search" class="form-control" placeholder="Cari nama atau peran staf..." value="{{ request('search') }}" style="max-width:300px;">
            <select name="sort" class="form-select" style="width:150px;">
                <option value="">Urutkan...</option>
                <option value="nama_staff" {{ request("sort") == "nama_staff" ? "selected" : "" }}>Nama</option>
                <option value="peran" {{ request("sort") == "peran" ? "selected" : "" }}>Peran</option>
            </select>
            <button type="submit" class="btn btn-primary-custom">Filter</button>
            @if(request('search') || request('sort'))
                <a href="{{ route('staff.index') }}" class="btn btn-light">Reset</a>
            @endif
        </form>

        <div class="card card-custom p-3">
            <table class="table table-custom align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Staf</th>
                        <th>Peran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($staff as $s)
                <tr>
                    <td>{{ $s->id }}</td>
                    <td style="font-weight:500;">{{ $s->nama_staff }}</td>
                    <td>{{ $s->peran }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editStaff{{ $s->id }}" style="border-color: var(--border);">
                            Edit
                        </button>
                        <form action="{{ route('staff.destroy', $s) }}" method="POST" onsubmit="return confirm('Yakin hapus staf ini?')" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class='mt-3 px-3'>{{ $staff->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
</div>

{{-- Modals diletakkan di luar table agar valid HTML --}}
@foreach($staff as $s)
<div class="modal fade" id="editStaff{{ $s->id }}" tabindex="-1" aria-labelledby="editStaffLabel{{ $s->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('staff.update', $s) }}" method="POST" style="border: none; border-radius: var(--radius);">
            @csrf @method('PUT')
            <div class="modal-header" style="border-bottom: 1px solid var(--border);">
                <h5 class="modal-title" id="editStaffLabel{{ $s->id }}" style="color: var(--primary); font-weight: bold;">Edit Data Staf</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <div class="mb-3">
                    <label class="form-label">Nama Staf</label>
                    <input type="text" name="nama_staff" class="form-control" value="{{ $s->nama_staff }}" required style="border-color:var(--border);">
                </div>
                <div class="mb-3">
                    <label class="form-label">Peran</label>
                    <input type="text" name="peran" class="form-control" value="{{ $s->peran }}" required style="border-color:var(--border);">
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
