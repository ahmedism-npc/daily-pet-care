@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0" style="color:var(--foreground); font-weight:700;">💰 Transaksi Baru</h2>
        <p class="text-muted mb-0" style="font-size:0.9rem;">Buat transaksi dengan beberapa hewan & layanan berbeda</p>
    </div>
    <a href="{{ route('transactions.history') }}" class="btn btn-outline-secondary btn-sm" style="border-color:var(--border);">← Riwayat</a>
</div>

<div class="card card-custom p-4 border-0 shadow-sm">
    <form action="{{ route('transactions.store') }}" method="POST" id="posForm">@csrf

        {{-- HEADER: Pelanggan & Staf --}}
        <div class="row g-3 mb-4 pb-4" style="border-bottom: 2px dashed var(--border);">
            <div class="col-md-6">
                <label class="form-label fw-semibold">1. Pelanggan</label>
                <select name="customer_id" id="customer_id" class="form-select" required
                        style="border-color:var(--border);" onchange="onCustomerChange()">
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach($customers as $c)
                        <option value="{{ $c->id }}">{{ $c->nama }} — {{ $c->kontak }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">2. Staf Pelaksana</label>
                <select name="staff_id" class="form-select" required style="border-color:var(--border);">
                    <option value="">-- Pilih Staf --</option>
                    @foreach($staff as $s)
                        <option value="{{ $s->id }}">{{ $s->nama_staff }} ({{ $s->peran }})</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- DATA HEWAN + LAYANAN (per baris item) --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0 fw-semibold">3. Baris Item — Hewan & Layanan</h5>
            <button type="button" class="btn btn-primary-custom btn-sm px-3" onclick="addItemRow()">+ Tambah Baris</button>
        </div>

        <div class="mb-2 d-none d-md-block">
            <div class="row g-2 px-1">
                <div class="col-md-3"><small class="text-muted fw-semibold">HEWAN</small></div>
                <div class="col-md-5"><small class="text-muted fw-semibold">LAYANAN</small></div>
                <div class="col-md-2"><small class="text-muted fw-semibold">JUMLAH</small></div>
                <div class="col-md-1"><small class="text-muted fw-semibold">SUBTOTAL</small></div>
                <div class="col-md-1"></div>
            </div>
        </div>

        <div id="itemRows">
            {{-- Baris pertama --}}
            <div class="row g-2 mb-2 item-row align-items-center p-2 rounded" style="background: #fafaf7; border: 1px solid var(--border);">
                <div class="col-md-3">
                    <select name="items[0][pet_id]" class="form-select pet-sel" required
                            style="border-color:var(--border); font-size:0.9rem;" onchange="updateSubtotal(this)">
                        <option value="">-- Pilih Hewan --</option>
                        @foreach($pets as $p)
                            <option value="{{ $p->id }}" class="pet-opt" data-cust="{{ $p->customer_id }}">
                                {{ $p->nama_hewan }} ({{ $p->spesies }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <select name="items[0][service_id]" class="form-select svc-sel" required
                            style="border-color:var(--border); font-size:0.9rem;" onchange="updateSubtotal(this)">
                        <option value="" data-harga="0">-- Pilih Layanan --</option>
                        @foreach($services as $s)
                            <option value="{{ $s->id }}" data-harga="{{ $s->harga }}">
                                {{ $s->nama_layanan }} — Rp {{ number_format($s->harga, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="items[0][jumlah]" class="form-control qty-inp" value="1" min="1"
                           style="border-color:var(--border); font-size:0.9rem;" oninput="updateSubtotal(this)">
                </div>
                <div class="col-md-1">
                    <span class="subtotal-lbl text-muted fw-semibold" style="font-size:0.85rem;">Rp 0</span>
                </div>
                <div class="col-md-1 text-end">
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeRow(this)" disabled title="Hapus baris">×</button>
                </div>
            </div>
        </div>

        <div class="mt-2 mb-1">
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="addItemRow()" style="border-color:var(--border);">
                + Tambah Hewan / Layanan Lain
            </button>
            <button type="button" id="btnAddPet" class="btn btn-sm btn-outline-primary ms-2 d-none"
                    onclick="showAddPetModal()" style="border-color: var(--primary); color: var(--primary);">
                🐾 Daftarkan Hewan Baru
            </button>
        </div>

        <hr class="mt-4" style="border-color:var(--border);">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <span class="text-muted" style="font-size:0.9rem;">Total Pembayaran</span>
                <h3 class="m-0" style="color:var(--primary); font-weight:800;" id="grandTotal">Rp 0</h3>
            </div>
            <button type="submit" class="btn btn-primary-custom px-5 py-2" style="font-size:1.05rem; font-weight:700;">
                💳 Proses Pembayaran
            </button>
        </div>
    </form>
</div>

{{-- Modal Tambah Hewan Baru --}}
<div class="modal fade" id="addPetModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border:none; border-radius: var(--radius);">
            <div class="modal-header" style="border-bottom: 1px solid var(--border);">
                <h5 class="modal-title" style="color:var(--primary); font-weight:bold;">🐾 Daftarkan Hewan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted small mb-3">Hewan akan didaftarkan atas nama pelanggan yang dipilih.</p>
                <div class="mb-3"><label class="form-label">Nama Hewan</label>
                    <input type="text" id="new_pet_nama" class="form-control" style="border-color:var(--border);" placeholder="Contoh: Buddy"></div>
                <div class="mb-3"><label class="form-label">Spesies / Ras</label>
                    <input type="text" id="new_pet_spesies" class="form-control" style="border-color:var(--border);" placeholder="Contoh: Anjing Labrador"></div>
                <div id="petAlert" class="d-none alert" role="alert"></div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid var(--border);">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary-custom" onclick="submitNewPet()">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let rowIdx = 1;
let addPetModal;
// Menyimpan semua data hewan yang telah di-load, dikelompokkan per customer_id
const allPets = @json($pets->map(fn($p) => ['id'=>$p->id,'nama'=>$p->nama_hewan,'spesies'=>$p->spesies,'customer_id'=>$p->customer_id]));

document.addEventListener('DOMContentLoaded', function () {
    addPetModal = new bootstrap.Modal(document.getElementById('addPetModal'));
    refreshAllPetDropdowns();
});

function onCustomerChange() {
    refreshAllPetDropdowns();
    const cid = document.getElementById('customer_id').value;
    document.getElementById('btnAddPet').classList.toggle('d-none', !cid);
}

function getPetsForCustomer(cid) {
    return cid ? allPets.filter(p => String(p.customer_id) === String(cid)) : [];
}

function buildPetOptions(cid, selectedId, namePrefix) {
    const pets = getPetsForCustomer(cid);
    let html = `<option value="">-- Pilih Hewan --</option>`;
    pets.forEach(p => {
        const sel = (selectedId && String(p.id) === String(selectedId)) ? 'selected' : '';
        html += `<option value="${p.id}" ${sel}>${p.nama} (${p.spesies})</option>`;
    });
    return html;
}

function refreshAllPetDropdowns() {
    const cid = document.getElementById('customer_id').value;
    document.querySelectorAll('.pet-sel').forEach((sel, i) => {
        const current = sel.value;
        sel.innerHTML = buildPetOptions(cid, current, '');
    });
    calcGrandTotal();
}

function addItemRow() {
    const cid = document.getElementById('customer_id').value;
    const petsHtml = buildPetOptions(cid, null, '');
    const svcOptions = `@foreach($services as $s)<option value="{{ $s->id }}" data-harga="{{ $s->harga }}">{{ $s->nama_layanan }} — Rp {{ number_format($s->harga,0,',','.') }}</option>@endforeach`;
    const html = `
    <div class="row g-2 mb-2 item-row align-items-center p-2 rounded" style="background:#fafaf7; border:1px solid var(--border);">
        <div class="col-md-3">
            <select name="items[${rowIdx}][pet_id]" class="form-select pet-sel" required style="border-color:var(--border);font-size:0.9rem;" onchange="updateSubtotal(this)">
                ${petsHtml}
            </select>
        </div>
        <div class="col-md-5">
            <select name="items[${rowIdx}][service_id]" class="form-select svc-sel" required style="border-color:var(--border);font-size:0.9rem;" onchange="updateSubtotal(this)">
                <option value="" data-harga="0">-- Pilih Layanan --</option>
                ${svcOptions}
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" name="items[${rowIdx}][jumlah]" class="form-control qty-inp" value="1" min="1"
                   style="border-color:var(--border);font-size:0.9rem;" oninput="updateSubtotal(this)">
        </div>
        <div class="col-md-1">
            <span class="subtotal-lbl text-muted fw-semibold" style="font-size:0.85rem;">Rp 0</span>
        </div>
        <div class="col-md-1 text-end">
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeRow(this)" title="Hapus baris">×</button>
        </div>
    </div>`;
    document.getElementById('itemRows').insertAdjacentHTML('beforeend', html);
    rowIdx++;
    updateRemoveButtons();
}

function removeRow(btn) {
    btn.closest('.item-row').remove();
    updateRemoveButtons();
    calcGrandTotal();
}

function updateRemoveButtons() {
    const rows = document.querySelectorAll('.item-row');
    rows.forEach(r => r.querySelector('button[onclick^="removeRow"]').disabled = rows.length === 1);
}

function updateSubtotal(el) {
    const row = el.closest('.item-row');
    const svc = row.querySelector('.svc-sel');
    const qty = row.querySelector('.qty-inp');
    const lbl = row.querySelector('.subtotal-lbl');
    if (svc.value && qty.value) {
        const harga = parseFloat(svc.selectedOptions[0].dataset.harga || 0);
        const sub = harga * parseInt(qty.value);
        lbl.textContent = 'Rp ' + sub.toLocaleString('id-ID');
    } else {
        lbl.textContent = 'Rp 0';
    }
    calcGrandTotal();
}

function calcGrandTotal() {
    let total = 0;
    document.querySelectorAll('.item-row').forEach(row => {
        const svc = row.querySelector('.svc-sel');
        const qty = row.querySelector('.qty-inp');
        if (svc && svc.value && qty && qty.value) {
            total += parseFloat(svc.selectedOptions[0].dataset.harga || 0) * parseInt(qty.value);
        }
    });
    document.getElementById('grandTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');
}

function showAddPetModal() {
    if (!document.getElementById('customer_id').value) { alert('Pilih pelanggan terlebih dahulu!'); return; }
    document.getElementById('new_pet_nama').value = '';
    document.getElementById('new_pet_spesies').value = '';
    document.getElementById('petAlert').classList.add('d-none');
    addPetModal.show();
}

function submitNewPet() {
    const cid = document.getElementById('customer_id').value;
    const nama = document.getElementById('new_pet_nama').value.trim();
    const spesies = document.getElementById('new_pet_spesies').value.trim();
    const alertEl = document.getElementById('petAlert');
    if (!nama || !spesies) {
        alertEl.className = 'alert alert-warning'; alertEl.textContent = 'Nama & spesies wajib diisi!';
        alertEl.classList.remove('d-none'); return;
    }
    fetch('{{ route("pets.store") }}', {
        method: 'POST',
        headers: {'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content},
        body: JSON.stringify({customer_id: cid, nama_hewan: nama, spesies: spesies})
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            allPets.push({id: data.pet.id, nama: data.pet.nama_hewan, spesies: data.pet.spesies, customer_id: parseInt(cid)});
            refreshAllPetDropdowns();
            // Set hewan baru di baris terakhir
            const lastPetSel = document.querySelectorAll('.pet-sel');
            lastPetSel[lastPetSel.length - 1].value = data.pet.id;
            addPetModal.hide();
        } else {
            alertEl.className = 'alert alert-danger'; alertEl.textContent = data.message || 'Gagal menyimpan.';
            alertEl.classList.remove('d-none');
        }
    });
}
</script>
@endsection
