<?php
$content = file_get_contents('app/Http/Controllers/TransactionController.php');
$content = preg_replace(
    '/public function history\(\)\s*\{[^\}]*\$transactions = Transaction::with\([^\)]+\)\s*->latest\(\)->paginate\(10\);[^\}]*return view\([^\)]+\);[^\}]*\}/s',
    "public function history() {
        \$query = Transaction::with(['customer', 'staff', 'details.pet', 'details.service']);
        if (\$search = request('search')) {
            \$query->whereHas('customer', function(\$q) use (\$search) {
                \$q->where('nama', 'like', '%'.\$search.'%');
            });
        }
        if (\$date = request('date')) {
            \$query->whereDate('tanggal', \$date);
        }
        \$transactions = \$query->latest()->paginate(10)->withQueryString();
        return view('transactions.history', compact('transactions'));
    }",
    $content
);
file_put_contents('app/Http/Controllers/TransactionController.php', $content);
