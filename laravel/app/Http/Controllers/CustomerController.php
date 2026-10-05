<?php
namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'kontak' => 'required|string|max:20',
            'alamat' => 'nullable|string'
        ]);

        Customer::create($data);
        return back()->with('success', 'Pelanggan baru berhasil didaftarkan!');
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'nama' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'kontak' => 'required|string|max:20',
            'alamat' => 'nullable|string'
        ]);
        $customer->update($request->only(['nama', 'kontak', 'alamat']));
        return back()->with('success', 'Data pelanggan berhasil diperbarui!');
    }
}