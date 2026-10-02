<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\Transaction;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // C. Dashboard Customer
        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();
            if (!$customer) {
                return view('dashboard_customer_empty');
            }
            $totalPets = Pet::where('customer_id', $customer->id)->count();
            $trxCount = Transaction::where('customer_id', $customer->id)->count();
            $totalExpense = Transaction::where('customer_id', $customer->id)->sum('total_harga');
            $lastVisit = Transaction::where('customer_id', $customer->id)->latest()->first();
            $services = Service::all();
            $transactions = Transaction::with(['pet', 'details.service'])
                ->where('customer_id', $customer->id)
                ->latest()->get();
            return view('dashboard_customer', compact('totalPets', 'trxCount', 'totalExpense', 'transactions', 'customer', 'lastVisit', 'services'));
        }

        // A & B. Dashboard Admin & Kasir
        $totalPets = DB::table('pets')->count();
        $totalCustomers = DB::table('customers')->count();
        $trxCount = DB::table('transactions')->count();
        $totalIncome = DB::table('transactions')->sum('total_harga');
        $trxToday = DB::table('transactions')->whereDate('tanggal', date('Y-m-d'))->count();
        $incomeToday = DB::table('transactions')->whereDate('tanggal', date('Y-m-d'))->sum('total_harga');
        $staffCount = DB::table('staff')->count();

        $transactions = Transaction::with(['customer', 'pet'])
            ->latest()
            ->limit(10)
            ->get();

        $topServices = DB::table('transaction_details')
            ->join('services', 'transaction_details.service_id', '=', 'services.id')
            ->select('services.nama_layanan', DB::raw('SUM(transaction_details.jumlah) as total_used'))
            ->groupBy('services.nama_layanan')
            ->orderByDesc('total_used')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalPets', 'totalCustomers', 'trxCount', 'totalIncome',
            'trxToday', 'incomeToday', 'staffCount',
            'transactions', 'topServices'
        ));
    }
}
