@extends('layouts.app')
@section('content')
<h2 class="mb-4" style="color:var(--primary); font-weight:bold;">💰 Transaksi Kasir Baru (POS)</h2>
<div class="card card-custom p-4">
    <form action="{{ route('transactions.store') }}" method="POST" id="posForm">@csrf
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">1. Pilih Pelanggan</label>
                <select name="customer_id" id="customer_id" class="form-select" required style="border-color:var(--border);" onchange="filterPets()">
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach($customers as $c)<option value="{{ $c->id }}">{{ $c->nama }} ({{ $c->kontak }})</option>@endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">2. Pilih Hewan</label>
                <select name="pet_id" id="pet_id" class="form-select" required style="border-color:var(--border);">
                    <option value="">-- Pilih Pelanggan Dahulu --</option>
                    @foreach($pets as $p)<option value="{{ $p->id }}" class="pet-opt" data-cust="{{ $p->customer_id }}" style="display:none;">{{ $p->nama_hewan }} ({{ $p->spesies }})</option>@endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">3. Staf Pelaksana</label>
                <select name="staff_id" class="form-select" required style="border-color:var(--border);">
                    <option value="">-- Pilih Staf --</option>
                    @foreach($staff as $s)<option value="{{ $s->id }}">{{ $s->nama_staff }} ({{ $s->peran }})</option>@endforeach
                </select>
            </div>
        </div>

        <hr style="border-color:var(--border);">
        <h5 class="mb-3">4. Pilih Layanan</h5>
        <div id="serviceRows">
            <div class="row g-2 mb-2 service-row">
                <div class="col-md-7">
                    <select name="services[0][id]" class="form-select svc-select" required style="border-color:var(--border);" onchange="calcTotal()">
                        <option value="">-- Pilih Layanan --</option>
                        @foreach($services as $s)<option value="{{ $s->id }}" data-harga="{{ $s->harga }}">{{ $s->nama_layanan }} - Rp {{ number_format($s->harga, 0, ',', '.') }}</option>@endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="services[0][jumlah]" class="form-control svc-qty" value="1" min="1" required style="border-color:var(--border);" oninput="calcTotal()">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-danger w-100" onclick="removeRow(this)" disabled>×</button>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-outline-secondary btn-sm mt-2" onclick="addRow()" style="border-color:var(--border);">+ Tambah Layanan</button>

        <hr class="mt-4" style="border-color:var(--border);">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Total: <strong id="totalDisplay" style="color:var(--primary);">Rp 0</strong></h4>
            <button type="submit" class="btn btn-primary-custom px-5 py-2" style="font-size:1.1rem; font-weight:600;">💳 Proses Pembayaran</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    let rowIdx = 1;
    function filterPets() {
        let cid = document.getElementById('customer_id').value;
        let sel = document.getElementById('pet_id'); sel.value = '';
        document.querySelectorAll('.pet-opt').forEach(o => o.style.display = o.dataset.cust === cid ? 'block' : 'none');
    }
    function addRow() {
        let html = `<div class="row g-2 mb-2 service-row">
            <div class="col-md-7"><select name="services[${rowIdx}][id]" class="form-select svc-select" required style="border-color:var(--border);" onchange="calcTotal()">
                <option value="">-- Pilih Layanan --</option>
                @foreach($services as $s)<option value="{{ $s->id }}" data-harga="{{ $s->harga }}">{{ $s->nama_layanan }} - Rp {{ number_format($s->harga, 0, ',', '.') }}</option>@endforeach
            </select></div>
            <div class="col-md-3"><input type="number" name="services[${rowIdx}][jumlah]" class="form-control svc-qty" value="1" min="1" required style="border-color:var(--border);" oninput="calcTotal()"></div>
            <div class="col-md-2"><button type="button" class="btn btn-outline-danger w-100" onclick="removeRow(this)">×</button></div>
        </div>`;
        document.getElementById('serviceRows').insertAdjacentHTML('beforeend', html);
        rowIdx++;
    }
    function removeRow(btn) { btn.closest('.service-row').remove(); calcTotal(); }
    function calcTotal() {
        let total = 0;
        document.querySelectorAll('.service-row').forEach(row => {
            let sel = row.querySelector('.svc-select'); let qty = row.querySelector('.svc-qty');
            if (sel.value && qty.value) {
                let h = sel.selectedOptions[0].dataset.harga;
                total += parseFloat(h) * parseInt(qty.value);
            }
        });
        document.getElementById('totalDisplay').textContent = 'Rp ' + total.toLocaleString('id-ID');
    }
</script>
@endsection
