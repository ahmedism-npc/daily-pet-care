@extends('layouts.app')
@section('content')
<h2 class="mb-4" style="color:var(--primary); font-weight:bold;">👥 Manajemen Akun Pengguna</h2>
<div class="row">
    <div class="col-md-4">
        <div class="card card-custom p-3 mb-4">
            <h5 class="mb-3">Tambah Akun Baru</h5>
            <form action="{{ route('users.store') }}" method="POST">@csrf
                <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="name" class="form-control" required style="border-color:var(--border);"></div>
                <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required style="border-color:var(--border);"></div>
                <div class="mb-3"><label class="form-label">Password</label><input type="password" name="password" class="form-control" required style="border-color:var(--border);"></div>
                <div class="mb-3"><label class="form-label">Role</label>
                    <select name="role" class="form-select" style="border-color:var(--border);">
                        <option value="customer">Customer</option><option value="kasir">Kasir</option><option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary-custom w-100">Tambah Akun</button>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-custom p-3">
            <table class="table table-custom align-middle">
                <thead><tr><th>ID</th><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th></tr></thead>
                <tbody>
                @foreach($users as $u)
                <tr>
                    <td>{{ $u->id }}</td><td>{{ $u->name }}</td><td>{{ $u->email }}</td>
                    <td><span class="badge" style="background-color:var(--primary);">{{ ucfirst($u->role) }}</span></td>
                    <td>
                        <form action="{{ route('users.destroy', $u) }}" method="POST" onsubmit="return confirm('Yakin hapus akun ini?')">@csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
