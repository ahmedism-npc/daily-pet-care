<?php
namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $customer = Customer::where('user_id', $user->id)->first();
        return view('customer.profile', compact('user', 'customer'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'kontak' => 'required|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $user->update(['name' => $request->name]);

        $customer = Customer::where('user_id', $user->id)->first();
        if ($customer) {
            $customer->update([
                'nama' => $request->name,
                'kontak' => $request->kontak,
                'alamat' => $request->alamat,
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // Riwayat transaksi milik customer yang login
    public function myTransactions()
    {
        $customer = Customer::where('user_id', Auth::id())->first();
        if (!$customer) {
            return view('customer.my_transactions', ['transactions' => collect()]);
        }
        $transactions = Transaction::with(['pet', 'staff', 'details.service'])
            ->where('customer_id', $customer->id)
            ->latest()
            ->get();
        return view('customer.my_transactions', compact('transactions'));
    }
}
