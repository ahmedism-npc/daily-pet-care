<?php
namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->get();
        return view('customers.index', compact('customers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'kontak' => 'required|string|max:20',
            'alamat' => 'nullable|string'
        ]);

        Customer::create($data);
        return back()->with('success', 'Pelanggan baru berhasil didaftarkan!');
    }
}
