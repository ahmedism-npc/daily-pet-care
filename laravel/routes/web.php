<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;

// ============================
// 1. Global Flow (Tanpa Login)
// ============================
Route::get('/', function () {
    $services = \App\Models\Service::all();
    return view('welcome', compact('services'));
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ============================
// 2. Authenticated Routes
// ============================
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // A. Role: Admin (Full Access / Manajerial & Sistem)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class)->only(['index', 'store', 'destroy']);
        Route::resource('staff', StaffController::class)->only(['index', 'store', 'destroy']);
        Route::resource('services', ServiceController::class);
    });

    // B. Role: Admin & Kasir (Operasional Front Office)
    Route::middleware(['role:admin,kasir'])->group(function () {
        Route::resource('customers', CustomerController::class);
        Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
        Route::post('/pets', [PetController::class, 'store'])->name('pets.store');
        Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
        Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
        Route::get('/transactions/history', [TransactionController::class, 'history'])->name('transactions.history');
        Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    });

    // C. Role: Customer (Self-Service Portal)
    Route::middleware(['role:customer'])->group(function () {
        Route::get('/my-pets', [PetController::class, 'myPets'])->name('my-pets.index');
        Route::post('/my-pets', [PetController::class, 'storeMyPet'])->name('my-pets.store');
        Route::get('/my-transactions', [ProfileController::class, 'myTransactions'])->name('my-transactions.index');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });
});
