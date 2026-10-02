<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Customer;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) return redirect()->route('dashboard');
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);
        $credentials['email'] = strip_tags($credentials['email']);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    // Menambahkan fitur Pendaftaran (Register) khusus Customer
    public function showRegisterForm()
    {
        if (Auth::check()) return redirect()->route('dashboard');
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed', // butuh input password_confirmation
            'kontak' => 'required|string|max:20',
            'alamat' => 'nullable|string'
        ]);

        // Buat Akun Login (Default Role: Customer)
        $user = User::create([
            'name' => $request->name,
            'email' => strip_tags($request->email),
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        // Otomatis menautkan (binding) profil akun ke tabel customers
        Customer::create([
            'user_id' => $user->id,
            'nama' => $user->name,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat,
        ]);

        // Langsung login otomatis
        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
