<?php
namespace App\Http\Controllers;
use App\Models\Pet;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    // Untuk Admin/Kasir: direktori semua hewan
    public function index()
    {
        $pets = Pet::with('customer')->latest()->get();
        return view('pets.index', compact('pets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'nama_hewan' => 'required|string|max:255',
            'spesies' => 'required|string|max:255',
        ]);

        Pet::create($request->only('customer_id', 'nama_hewan', 'spesies'));
        return back()->with('success', 'Data hewan baru berhasil ditambahkan!');
    }

    // Untuk Customer: hewan milik sendiri
    public function myPets()
    {
        $customer = Customer::where('user_id', Auth::id())->first();
        if (!$customer) {
            return view('customer.my_pets', ['pets' => collect(), 'customer' => null]);
        }
        $pets = Pet::where('customer_id', $customer->id)->get();
        return view('customer.my_pets', compact('pets', 'customer'));
    }

    public function storeMyPet(Request $request)
    {
        $request->validate([
            'nama_hewan' => 'required|string|max:255',
            'spesies' => 'required|string|max:255',
        ]);

        $customer = Customer::where('user_id', Auth::id())->firstOrFail();
        Pet::create([
            'customer_id' => $customer->id,
            'nama_hewan' => $request->nama_hewan,
            'spesies' => $request->spesies,
        ]);

        return back()->with('success', 'Hewan peliharaan baru berhasil didaftarkan!');
    }
}
