<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('kontak', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        if ($sort = $request->input('sort')) {
            if (in_array($sort, ['nama', 'kontak', 'alamat', 'id'])) {
                $query->orderBy($sort, $request->input('order', 'asc'));
            }
        } else {
            $query->latest();
        }

        $customers = $query->paginate(10)->withQueryString();
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

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return back()->with('success', 'Data pelanggan berhasil dihapus!');
    }
}