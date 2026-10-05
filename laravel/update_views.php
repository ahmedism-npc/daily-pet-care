<?php
$files = [
    'resources/views/admin/users/index.blade.php' => [
        'placeholder' => 'Cari user...',
        'sort_options' => '<option value="name" {{ request("sort") == "name" ? "selected" : "" }}>Nama</option><option value="email" {{ request("sort") == "email" ? "selected" : "" }}>Email</option>'
    ],
    'resources/views/customers/index.blade.php' => [
        'placeholder' => 'Cari pelanggan...',
        'sort_options' => '<option value="nama" {{ request("sort") == "nama" ? "selected" : "" }}>Nama</option><option value="email" {{ request("sort") == "email" ? "selected" : "" }}>Email</option>'
    ],
    'resources/views/admin/staff/index.blade.php' => [
        'placeholder' => 'Cari staff...',
        'sort_options' => '<option value="nama_staff" {{ request("sort") == "nama_staff" ? "selected" : "" }}>Nama</option>'
    ],
    'resources/views/services/index.blade.php' => [
        'placeholder' => 'Cari layanan...',
        'sort_options' => '<option value="nama_layanan" {{ request("sort") == "nama_layanan" ? "selected" : "" }}>Nama</option><option value="harga" {{ request("sort") == "harga" ? "selected" : "" }}>Harga</option>'
    ],
];

foreach ($files as $file => $config) {
    if(!file_exists($file)) continue;
    $content = file_get_contents($file);
    $form = "
    <form method=\"GET\" class=\"d-flex gap-2 mb-3\">
        <input type=\"text\" name=\"search\" class=\"form-control\" placeholder=\"{$config['placeholder']}\" value=\"{{ request('search') }}\" style=\"max-width:300px;\">
        <select name=\"sort\" class=\"form-select\" style=\"width:150px;\">
            <option value=\"\">Urutkan...</option>
            {$config['sort_options']}
        </select>
        <button type=\"submit\" class=\"btn btn-primary-custom\">Filter</button>
        @if(request('search') || request('sort'))
            <a href=\"?\" class=\"btn btn-light\">Reset</a>
        @endif
    </form>
    <div class=\"card card-custom";

    $content = str_replace('<div class="card card-custom', $form, $content);
    file_put_contents($file, $content);
}

// For Transactions
$trxFile = 'resources/views/transactions/history.blade.php';
$content = file_get_contents($trxFile);
$form = "
<form method=\"GET\" class=\"d-flex gap-2 mb-3\">
    <input type=\"text\" name=\"search\" class=\"form-control\" placeholder=\"Cari nama pelanggan...\" value=\"{{ request('search') }}\" style=\"max-width:300px;\">
    <input type=\"date\" name=\"date\" class=\"form-control\" value=\"{{ request('date') }}\" style=\"width:160px;\">
    <button type=\"submit\" class=\"btn btn-primary-custom\">Filter</button>
    @if(request('search') || request('date'))
        <a href=\"?\" class=\"btn btn-light\">Reset</a>
    @endif
</form>
<div class=\"card card-custom";
$content = str_replace('<div class="card card-custom', $form, $content);
file_put_contents($trxFile, $content);

