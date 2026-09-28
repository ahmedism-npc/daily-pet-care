@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 style="color: var(--primary); font-weight: bold;">Transaksi Kasir Baru</h2>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-custom p-4">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Pilih Pelanggan</label>
                        <select name="customer_id" id="customer_id" class="form-select" onchange="filterPets()" required style="border-color: var(--border);">
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach($customers as $c)
                                <option value="{{ $c->id }}">{{ $c->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Pilih Hewan</label>
                        <select name="pet_id" id="pet_id" class="form-select" required style="border-color: var(--border);">
                            <option value="">-- Pilih Pelanggan Dahulu --</option>
                            @foreach($pets as $p)
                                <option value="{{ $p->id }}" class="pet-option" data-customer="{{ $p->customer_id }}" style="display: none;">{{ $p->nama_hewan }} ({{ $p->spesies }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Pilih Layanan</label>
                    <select name="service_id" class="form-select" required style="border-color: var(--border); font-size: 1.1rem;">
                        <option value="">-- Pilih Layanan --</option>
                        @foreach($services as $s)
                            <option value="{{ $s->id }}">{{ $s->nama_layanan }} - Rp {{ number_format($s->harga, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                </div>

                <hr style="border-color: var(--border);">
                
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary-custom px-5 py-2" style="font-size: 1.1rem; font-weight: 600;">Proses Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function filterPets() {
        let custId = document.getElementById('customer_id').value;
        let petSelect = document.getElementById('pet_id');
        let options = document.querySelectorAll('.pet-option');
        
        petSelect.value = ''; // reset selection
        options.forEach(opt => {
            if(opt.dataset.customer === custId) {
                opt.style.display = 'block';
            } else {
                opt.style.display = 'none';
            }
        });
    }
</script>
@endsection
