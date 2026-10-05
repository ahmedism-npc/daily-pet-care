<?php
// Replace index methods via regex for UserController
$content = file_get_contents('app/Http/Controllers/UserController.php');
$content = preg_replace(
    '/public function index\(\)\s*\{[^\}]*\$users = User::latest\(\)->paginate\(10\);[^\}]*return view\([^\)]+\);[^\}]*\}/s',
    "public function index() {
        \$query = User::query();
        if (\$search = request('search')) {
            \$query->where('name', 'like', '%'.\$search.'%')->orWhere('email', 'like', '%'.\$search.'%');
        }
        if (\$sort = request('sort')) {
            \$query->orderBy(\$sort, request('order', 'asc'));
        } else {
            \$query->latest();
        }
        \$users = \$query->paginate(10)->withQueryString();
        return view('admin.users.index', compact('users'));
    }",
    $content
);
file_put_contents('app/Http/Controllers/UserController.php', $content);

// For CustomerController
$content = file_get_contents('app/Http/Controllers/CustomerController.php');
$content = preg_replace(
    '/public function index\(\)\s*\{[^\}]*\$customers = Customer::latest\(\)->paginate\(10\);[^\}]*return view\([^\)]+\);[^\}]*\}/s',
    "public function index() {
        \$query = Customer::query();
        if (\$search = request('search')) {
            \$query->where('nama', 'like', '%'.\$search.'%')->orWhere('email', 'like', '%'.\$search.'%');
        }
        if (\$sort = request('sort')) {
            \$query->orderBy(\$sort, request('order', 'asc'));
        } else {
            \$query->latest();
        }
        \$customers = \$query->paginate(10)->withQueryString();
        return view('customers.index', compact('customers'));
    }",
    $content
);
file_put_contents('app/Http/Controllers/CustomerController.php', $content);

// For StaffController
$content = file_get_contents('app/Http/Controllers/StaffController.php');
$content = preg_replace(
    '/public function index\(\)\s*\{[^\}]*\$staff = Staff::latest\(\)->paginate\(10\);[^\}]*return view\([^\)]+\);[^\}]*\}/s',
    "public function index() {
        \$query = Staff::query();
        if (\$search = request('search')) {
            \$query->where('nama_staff', 'like', '%'.\$search.'%');
        }
        if (\$sort = request('sort')) {
            \$query->orderBy(\$sort, request('order', 'asc'));
        } else {
            \$query->latest();
        }
        \$staff = \$query->paginate(10)->withQueryString();
        return view('admin.staff.index', compact('staff'));
    }",
    $content
);
file_put_contents('app/Http/Controllers/StaffController.php', $content);

// For ServiceController
$content = file_get_contents('app/Http/Controllers/ServiceController.php');
$content = preg_replace(
    '/public function index\(\)\s*\{[^\}]*\$services = Service::latest\(\)->paginate\(10\);[^\}]*return view\([^\)]+\);[^\}]*\}/s',
    "public function index() {
        \$query = Service::query();
        if (\$search = request('search')) {
            \$query->where('nama_layanan', 'like', '%'.\$search.'%');
        }
        if (\$sort = request('sort')) {
            \$query->orderBy(\$sort, request('order', 'asc'));
        } else {
            \$query->latest();
        }
        \$services = \$query->paginate(10)->withQueryString();
        return view('services.index', compact('services'));
    }",
    $content
);
file_put_contents('app/Http/Controllers/ServiceController.php', $content);
