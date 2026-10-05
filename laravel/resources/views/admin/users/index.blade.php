@extends('layouts.app')
@section('content')
<h2 class="mb-4" style="color:var(--primary); font-weight:bold;">👥 Manajemen Akun Pengguna</h2>
<div class="row">
    <div class="col-md-4">
        
    <form method="GET" class="d-flex gap-2 mb-3">
        <input type="text" name="search" class="form-control" placeholder="Cari user..." value="{{ request('search') }}" style="max-width:300px;">
        <select name="sort" class="form-select" style="width:150px;">
            <option value="">Urutkan...</option>
            <option value="name" {{ request("sort") == "name" ? "selected" : "" }}>Nama</option><option value="email" {{ request("sort") == "email" ? "selected" : "" }}>Email</option>
        </select>
        <button type="submit" class="btn btn-primary-custom">Filter</button>
        @if(request('search') || request('sort'))
            <a href="?" class="btn btn-light">Reset</a>
        @endif
    </form>
    <div class="card card-custom p-3 mb-4 border-0 shadow-sm">
            <h5 class="mb-3">Tambah Akun Baru</h5>
            <form action="{{ route('users.store') }}" method="POST">@csrf
                <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="name" class="form-control" required style="border-color:var(--border);"></div>
                <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required style="border-color:var(--border);"></div>
                <div class="mb-3"><label class="form-label">Password</label><input type="password" name="password" class="form-control" required style="border-color:var(--border);"></div>
                <div class="mb-3"><label class="form-label">Role</label>
                    <select name="role" class="form-select" style="border-color:var(--border);">
                        <option value="customer">Customer</option>
                        <option value="kasir">Kasir</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary-custom w-100">Tambah Akun</button>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        
    <form method="GET" class="d-flex gap-2 mb-3">
        <input type="text" name="search" class="form-control" placeholder="Cari user..." value="{{ request('search') }}" style="max-width:300px;">
        <select name="sort" class="form-select" style="width:150px;">
            <option value="">Urutkan...</option>
            <option value="name" {{ request("sort") == "name" ? "selected" : "" }}>Nama</option><option value="email" {{ request("sort") == "email" ? "selected" : "" }}>Email</option>
        </select>
        <button type="submit" class="btn btn-primary-custom">Filter</button>
        @if(request('search') || request('sort'))
            <a href="?" class="btn btn-light">Reset</a>
        @endif
    </form>
    <div class="card card-custom p-3 border-0 shadow-sm">
            <table class="table table-custom align-middle">
                <thead><tr><th>ID</th><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th></tr></thead>
                <tbody>
                @foreach($users as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td><span class="badge" style="background-color:var(--primary);">{{ ucfirst($u->role) }}</span></td>
                    <td>
                        <!-- Edit Button -->
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editModal{{ $u->id }}" style="border-color: var(--border);">
                            Edit
                        </button>
                        
                        <form action="{{ route('users.destroy', $u) }}" method="POST" onsubmit="return confirm('Yakin hapus akun ini?')" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $u->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $u->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" style="border: none; border-radius: var(--radius);">
                            <form action="{{ route('users.update', $u) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-header" style="border-bottom: 1px solid var(--border);">
                                    <h5 class="modal-title" id="editModalLabel{{ $u->id }}" style="color: var(--primary); font-weight: bold;">Edit Akun Pengguna</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="name" class="form-control" value="{{ $u->name }}" required style="border-color:var(--border);">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ $u->email }}" required style="border-color:var(--border);">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Role</label>
                                        <select name="role" class="form-select" style="border-color:var(--border);">
                                            <option value="customer" {{ $u->role == 'customer' ? 'selected' : '' }}>Customer</option>
                                            <option value="kasir" {{ $u->role == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                            <option value="admin" {{ $u->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password Baru <small class="text-muted">(Opsional)</small></label>
                                        <input type="password" name="password" class="form-control" placeholder="Biarkan kosong jika tidak diubah" style="border-color:var(--border);">
                                    </div>
                                </div>
                                <div class="modal-footer" style="border-top: 1px solid var(--border);">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary-custom">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
                </tbody>
            </table><div class='mt-3 px-3'>{{ $users->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
</div>
@endsection
