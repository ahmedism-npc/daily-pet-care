<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerPaginationSeeder extends Seeder
{
    public function run(): void
    {
        $newCustomers = [
            ['nama' => 'Ahmad Fauzi', 'kontak' => '081298765431', 'alamat' => 'Jl. Diponegoro No. 8'],
            ['nama' => 'Nadia Rahmawati', 'kontak' => '082187654321', 'alamat' => 'Jl. Cempaka Putih No. 19'],
            ['nama' => 'Rizky Pratama', 'kontak' => '083176543210', 'alamat' => 'Jl. Kenanga No. 24'],
            ['nama' => 'Putri Ayu', 'kontak' => '085265432109', 'alamat' => 'Jl. Dahlia No. 3'],
            ['nama' => 'Bayu Kusuma', 'kontak' => '087854321098', 'alamat' => 'Jl. Pahlawan No. 42'],
            ['nama' => 'Intan Permata', 'kontak' => '089643210987', 'alamat' => 'Jl. Kartini No. 16'],
            ['nama' => 'Hendra Saputra', 'kontak' => '081332109876', 'alamat' => 'Jl. Gajah Mada No. 88'],
        ];

        foreach ($newCustomers as $cust) {
            Customer::firstOrCreate(['nama' => $cust['nama']], $cust);
        }
    }
}
