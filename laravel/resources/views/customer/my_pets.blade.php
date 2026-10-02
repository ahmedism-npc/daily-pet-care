@extends('layouts.app')
@section('content')
<h2 class="mb-4" style="color:var(--primary); font-weight:bold;">🐕 Hewan Peliharaan Saya</h2>
@if($customer)
<div class="row">
    <div class="col-md-4">
        <div class="card card-custom p-3 mb-4">
            <h5 class="mb-3">Tambah Hewan Baru</h5>
            <form action="{{ route('my-pets.store') }}" method="POST">@csrf
                <div class="mb-3"><label class="form-label">Nama Hewan</label><input type="text" name="nama_hewan" class="form-control" required style="border-color:var(--border);"></div>
                <div class="mb-3"><label class="form-label">Spesies / Ras</label><input type="text" name="spesies" class="form-control" placeholder="Kucing Persia, Anjing Golden" required style="border-color:var(--border);"></div>
                <button type="submit" class="btn btn-primary-custom w-100">Simpan</button>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-custom p-3">
            <table class="table table-custom align-middle">
                <thead><tr><th>No</th><th>Nama Hewan</th><th>Spesies / Ras</th></tr></thead>
                <tbody>
                @forelse($pets as $i => $p)
                <tr><td>{{ $i + 1 }}</td><td style="font-weight:500;">{{ $p->nama_hewan }}</td><td>{{ $p->spesies }}</td></tr>
                @empty
                <tr><td colspan="3" class="text-center text-muted py-3">Belum ada hewan terdaftar.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
<div class="alert" style="background-color:var(--card); border:1px solid var(--border);">
    Akun Anda belum ditautkan dengan data pelanggan. Hubungi kasir saat berkunjung.
</div>
@endif
@endsection
