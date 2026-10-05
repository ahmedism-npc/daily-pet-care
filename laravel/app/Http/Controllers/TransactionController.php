<?php
namespace App\Http\Controllers;
use App\Models\{Transaction, TransactionDetail, Customer, Pet, Service, Staff};
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function create()
    {
        $customers = Customer::orderBy('nama')->get();
        $pets      = Pet::with('customer')->get();
        $services  = Service::orderBy('nama_layanan')->get();
        $staff     = Staff::orderBy('nama_staff')->get();
        return view('transactions.create', compact('customers', 'pets', 'services', 'staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'staff_id'    => 'required|exists:staff,id',
            'items'       => 'required|array|min:1',
            'items.*.pet_id'     => 'required|exists:pets,id',
            'items.*.service_id' => 'required|exists:services,id',
            'items.*.jumlah'     => 'required|integer|min:1',
        ]);

        $totalHarga = 0;
        $detailData = [];

        foreach ($request->items as $item) {
            $service  = Service::find($item['service_id']);
            $subtotal = $service->harga * $item['jumlah'];
            $totalHarga += $subtotal;

            $detailData[] = [
                'pet_id'     => $item['pet_id'],
                'service_id' => $service->id,
                'jumlah'     => $item['jumlah'],
                'subtotal'   => $subtotal,
            ];
        }

        // Simpan pet_id pertama ke transactions.pet_id (backward-compat)
        $firstPetId = $detailData[0]['pet_id'];

        $trx = Transaction::create([
            'customer_id' => $request->customer_id,
            'pet_id'      => $firstPetId,
            'staff_id'    => $request->staff_id,
            'tanggal'     => date('Y-m-d'),
            'total_harga' => $totalHarga,
        ]);

        foreach ($detailData as $detail) {
            TransactionDetail::create(array_merge($detail, ['transaction_id' => $trx->id]));
        }

        return redirect()->route('transactions.history')
            ->with('success', "Transaksi TRX-00{$trx->id} berhasil! Total: Rp " . number_format($totalHarga, 0, ',', '.'));
    }

    public function history()
    {
        $transactions = Transaction::with(['customer', 'staff', 'details.pet', 'details.service'])
            ->latest()->get();
        return view('transactions.history', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['customer', 'staff', 'details.pet', 'details.service']);
        return view('transactions.show', compact('transaction'));
    }
}
