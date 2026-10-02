<?php
namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\Service;
use App\Models\Staff;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function create()
    {
        $customers = Customer::all();
        $pets = Pet::all();
        $services = Service::all();
        $staff = Staff::all();
        return view('transactions.create', compact('customers', 'pets', 'services', 'staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'pet_id' => 'required|exists:pets,id',
            'staff_id' => 'required|exists:staff,id',
            'services' => 'required|array|min:1',
            'services.*.id' => 'required|exists:services,id',
            'services.*.jumlah' => 'required|integer|min:1',
        ]);

        $totalHarga = 0;
        $detailData = [];

        foreach ($request->services as $item) {
            $service = Service::find($item['id']);
            $subtotal = $service->harga * $item['jumlah'];
            $totalHarga += $subtotal;
            $detailData[] = [
                'service_id' => $service->id,
                'jumlah' => $item['jumlah'],
                'subtotal' => $subtotal,
            ];
        }

        $trx = Transaction::create([
            'customer_id' => $request->customer_id,
            'pet_id' => $request->pet_id,
            'staff_id' => $request->staff_id,
            'tanggal' => date('Y-m-d'),
            'total_harga' => $totalHarga,
        ]);

        foreach ($detailData as $detail) {
            TransactionDetail::create(array_merge($detail, ['transaction_id' => $trx->id]));
        }

        return redirect()->route('dashboard')->with('success', "Transaksi TRX-00{$trx->id} berhasil disimpan! Total: Rp " . number_format($totalHarga, 0, ',', '.'));
    }

    // Riwayat seluruh transaksi (Admin & Kasir)
    public function history()
    {
        $transactions = Transaction::with(['customer', 'pet', 'staff', 'details.service'])
            ->latest()
            ->get();
        return view('transactions.history', compact('transactions'));
    }

    // Detail per transaksi
    public function show(Transaction $transaction)
    {
        $transaction->load(['customer', 'pet', 'staff', 'details.service']);
        return view('transactions.show', compact('transaction'));
    }
}
