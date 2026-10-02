@extends('layouts.app')
@section('content')
<h2 class="mb-4" style="color:var(--primary); font-weight:bold;">⚙️ Profil Akun Saya</h2>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-custom p-4">
            <form action="{{ route('profile.update') }}" method="POST">@csrf @method('PUT')
                <div class="mb-3"><label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required style="border-color:var(--border);">
                </div>
                <div class="mb-3"><label class="form-label">Email (tidak bisa diubah)</label>
                    <input type="email" class="form-control" value="{{ $user->email }}" disabled style="border-color:var(--border); background:#eee;">
                </div>
                <div class="mb-3"><label class="form-label">No. Kontak / WhatsApp</label>
                    <input type="text" name="kontak" class="form-control" value="{{ $customer->kontak ?? '' }}" required style="border-color:var(--border);">
                </div>
                <div class="mb-3"><label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2" style="border-color:var(--border);">{{ $customer->alamat ?? '' }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary-custom w-100">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
