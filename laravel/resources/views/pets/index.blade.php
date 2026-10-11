@extends('layouts.app')
@section('content')
<h2 class="mb-4" style="color:var(--primary); font-weight:bold;">Direktori Hewan Peliharaan</h2>
<div class="row">
    <div class="col-md-4">
        <div class="card card-custom p-3 mb-4">
            <h5 class="mb-3">Daftarkan Hewan Baru</h5>
            <form action="{{ route('pets.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Pemilik (Pelanggan)</label>
                    <select name="customer_id" class="form-select" required style="border-color:var(--border);">
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($customers as $c)
                            <option value="{{ $c->id }}">{{ $c->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Hewan</label>
                    <input type="text" name="nama_hewan" class="form-control" required style="border-color:var(--border);">
                </div>
                <div class="mb-3">
                    <label class="form-label">Spesies / Ras</label>
                    <input type="text" name="spesies" class="form-control" placeholder="Kucing, Anjing, Kelinci..." required style="border-color:var(--border);">
                </div>
                <button type="submit" class="btn btn-primary-custom w-100">Simpan</button>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <form method="GET" class="d-flex gap-2 mb-3">
            <input type="text" name="search" class="form-control" placeholder="Cari nama hewan, spesies, atau pemilik..." value="{{ request('search') }}" style="max-width:320px;">
            <select name="sort" class="form-select" style="width:150px;">
                <option value="">Urutkan...</option>
                <option value="nama_hewan" {{ request("sort") == "nama_hewan" ? "selected" : "" }}>Nama Hewan</option>
                <option value="spesies" {{ request("sort") == "spesies" ? "selected" : "" }}>Spesies</option>
            </select>
            <button type="submit" class="btn btn-primary-custom">Filter</button>
            @if(request('search') || request('sort'))
                <a href="{{ route('pets.index') }}" class="btn btn-light">Reset</a>
            @endif
        </form>

        <div class="card card-custom p-3">
            <table class="table table-custom align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Hewan</th>
                        <th>Spesies</th>
                        <th>Pemilik</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($pets as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td style="font-weight:500;">{{ $p->nama_hewan }}</td>
                    <td>{{ $p->spesies }}</td>
                    <td>{{ $p->customer->nama ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted py-3">Belum ada data hewan.</td></tr>
                @endforelse
                </tbody>
            </table>
            <div class='mt-3 px-3'>{{ $pets->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
</div>
@endsection
