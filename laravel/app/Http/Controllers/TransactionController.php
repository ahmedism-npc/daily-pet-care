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
        $staff = Staff::first(); // Simulasi staff yang sedang login/dinas
        
        return view('transactions.create', compact('customers', 'pets', 'services', 'staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'pet_id' => 'required|exists:pets,id',
            'service_id' => 'required|exists:services,id',
        ]);

        $service = Service::find($request->service_id);

        $trx = Transaction::create([
            'customer_id' => $request->customer_id,
            'pet_id' => $request->pet_id,
            'staff_id' => 1, // hardcode sementara untuk prototipe
            'tanggal' => date('Y-m-d'),
            'total_harga' => $service->harga
        ]);

        TransactionDetail::create([
            'transaction_id' => $trx->id,
            'service_id' => $service->id,
            'jumlah' => 1,
            'subtotal' => $service->harga
        ]);

        return redirect()->route('dashboard')->with('success', 'Transaksi Kasir berhasil disimpan!');
    }
}
