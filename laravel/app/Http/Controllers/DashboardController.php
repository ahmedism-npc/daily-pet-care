<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\{Customer, Pet, Transaction, Service};

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $customer = Customer::where('user_id', $user->id)->first();
            if (!$customer) return view('dashboard_customer_empty');
            
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

        // --- DASHBOARD ADMIN & KASIR ---
        
        $totalPets = DB::table('pets')->count();
        $totalCustomers = DB::table('customers')->count();
        $trxCount = DB::table('transactions')->count();
        $totalIncome = DB::table('transactions')->sum('total_harga');
        
        $trxToday = DB::table('transactions')->whereDate('tanggal', date('Y-m-d'))->count();
        $incomeToday = DB::table('transactions')->whereDate('tanggal', date('Y-m-d'))->sum('total_harga');
        $staffCount = DB::table('staff')->count();

        $transactions = Transaction::with(['customer', 'pet'])->latest()->limit(10)->get();

        // Parameter periode chart
        $period = $request->query('period', '3m');
        $startDate = Carbon::now();
        
        if($period == '1w') $startDate->subWeek();
        elseif($period == '1m') $startDate->subMonth();
        elseif($period == '3m') $startDate->subMonths(3);
        elseif($period == '6m') $startDate->subMonths(6);
        elseif($period == '1y') $startDate->subYear();
        else $startDate->subMonths(3); // default 3 bulan

        // Data Grafik Garis (Pendapatan per hari)
        $revenueDataRaw = DB::table('transactions')
            ->select(DB::raw('DATE(tanggal) as date'), DB::raw('SUM(total_harga) as total'))
            ->whereDate('tanggal', '>=', $startDate->format('Y-m-d'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
            
        $chartDates = $revenueDataRaw->pluck('date')->toJson();
        $chartTotals = $revenueDataRaw->pluck('total')->toJson();

        // Data Pie Chart (Layanan Paling Laris)
        $topServicesRaw = DB::table('transaction_details')
            ->join('services', 'transaction_details.service_id', '=', 'services.id')
            ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->whereDate('transactions.tanggal', '>=', $startDate->format('Y-m-d'))
            ->select('services.nama_layanan', DB::raw('SUM(transaction_details.jumlah) as total_used'))
            ->groupBy('services.nama_layanan')
            ->orderByDesc('total_used')
            ->limit(7)
            ->get();
            
        $pieLabels = $topServicesRaw->pluck('nama_layanan')->toJson();
        $pieData = $topServicesRaw->pluck('total_used')->toJson();

        return view('dashboard', compact(
            'totalPets', 'totalCustomers', 'trxCount', 'totalIncome',
            'trxToday', 'incomeToday', 'staffCount', 'transactions',
            'chartDates', 'chartTotals', 'pieLabels', 'pieData', 'period'
        ));
    }
}
