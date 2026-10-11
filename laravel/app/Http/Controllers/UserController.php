<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($sort = $request->input('sort')) {
            if (in_array($sort, ['name', 'email', 'role', 'id'])) {
                $query->orderBy($sort, $request->input('order', 'asc'));
            }
        } else {
            $query->orderBy('role');
        }

        $users = $query->paginate(10)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,kasir,customer',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Jika role customer dibuat oleh Admin, otomatis buatkan Customer record agar akun tertaut
        if ($user->role === 'customer') {
            Customer::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'kontak' => '-',
                'alamat' => '-',
            ]);
        }

        return back()->with('success', 'Akun pengguna baru berhasil dibuat!');
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,kasir,customer',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'string|min:6';
        }

        $request->validate($rules);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update nama pelanggan jika terhubung
        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();
            if ($customer) {
                $customer->update(['nama' => $user->name]);
            } else {
                Customer::create([
                    'user_id' => $user->id,
                    'nama' => $user->name,
                    'kontak' => '-',
                    'alamat' => '-',
                ]);
            }
        }

        return back()->with('success', 'Data akun berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Akun berhasil dihapus.');
    }
}
