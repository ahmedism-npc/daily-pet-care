<?php

// UserController
$content = file_get_contents('app/Http/Controllers/UserController.php');
$content = preg_replace('/public function index\(\)[\s\S]*?return view\([^\)]+\);\s*\}/', <<<PHP
    public function index()
    {
        \$query = \App\Models\User::query();
        if (\$search = request('search')) {
            \$query->where('name', 'like', "%{\$search}%")->orWhere('email', 'like', "%{\$search}%");
        }
        if (\$sort = request('sort')) {
            \$query->orderBy(\$sort, request('order', 'asc'));
        } else {
            \$query->orderBy('role');
        }
        \$users = \$query->paginate(10)->withQueryString();
        return view('admin.users.index', compact('users'));
    }
PHP
, $content);
file_put_contents('app/Http/Controllers/UserController.php', $content);

// CustomerController
$content = file_get_contents('app/Http/Controllers/CustomerController.php');
$content = preg_replace('/public function index\(\)[\s\S]*?return view\([^\)]+\);\s*\}/', <<<PHP
    public function index()
    {
        \$query = \App\Models\Customer::query();
        if (\$search = request('search')) {
            \$query->where('nama', 'like', "%{\$search}%")->orWhere('email', 'like', "%{\$search}%");
        }
        if (\$sort = request('sort')) {
            \$query->orderBy(\$sort, request('order', 'asc'));
        } else {
            \$query->latest();
        }
        \$customers = \$query->paginate(10)->withQueryString();
        return view('customers.index', compact('customers'));
    }
PHP
, $content);
file_put_contents('app/Http/Controllers/CustomerController.php', $content);

// StaffController
$content = file_get_contents('app/Http/Controllers/StaffController.php');
$content = preg_replace('/public function index\(\)[\s\S]*?return view\([^\)]+\);\s*\}/', <<<PHP
    public function index()
    {
        \$query = \App\Models\Staff::query();
        if (\$search = request('search')) {
            \$query->where('nama_staff', 'like', "%{\$search}%");
        }
        if (\$sort = request('sort')) {
            \$query->orderBy(\$sort, request('order', 'asc'));
        } else {
            \$query->latest();
        }
        \$staff = \$query->paginate(10)->withQueryString();
        return view('admin.staff.index', compact('staff'));
    }
PHP
, $content);
file_put_contents('app/Http/Controllers/StaffController.php', $content);

// ServiceController
$content = file_get_contents('app/Http/Controllers/ServiceController.php');
$content = preg_replace('/public function index\(\)[\s\S]*?return view\([^\)]+\);\s*\}/', <<<PHP
    public function index()
    {
        \$query = \App\Models\Service::query();
        if (\$search = request('search')) {
            \$query->where('nama_layanan', 'like', "%{\$search}%");
        }
        if (\$sort = request('sort')) {
            \$query->orderBy(\$sort, request('order', 'asc'));
        } else {
            \$query->latest();
        }
        \$services = \$query->paginate(10)->withQueryString();
        return view('services.index', compact('services'));
    }
PHP
, $content);

// Add destroy method to ServiceController if not exists
if (strpos($content, 'function destroy') === false) {
    $destroyMethod = <<<PHP

    public function destroy(\App\Models\Service \$service)
    {
        \$service->delete();
        return back()->with('success', 'Data layanan berhasil dihapus!');
    }
}
PHP;
    $content = preg_replace('/\}\s*$/', $destroyMethod, $content);
}
file_put_contents('app/Http/Controllers/ServiceController.php', $content);
