<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', function () {
        $totalPets = DB::table('pets')->count();
        $trxCount = DB::table('transactions')->count();
        $totalIncome = DB::table('transactions')->sum('total_harga');

        $transactions = DB::table('transactions')
            ->join('customers', 'transactions.customer_id', '=', 'customers.id')
            ->join('pets', 'transactions.pet_id', '=', 'pets.id')
            ->select('transactions.*', 'customers.nama as customer_name', 'pets.nama_hewan as pet_name')
            ->orderBy('transactions.created_at', 'desc')
            ->get();

        return view('dashboard', compact('totalPets', 'trxCount', 'totalIncome', 'transactions'));
    })->name('dashboard');

    // Resources Route untuk fitur operasional
    Route::resource('services', ServiceController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('transactions', TransactionController::class);
});
