<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // Insert Customer
        $customerId = DB::table('customers')->insertGetId([
            'nama' => 'Andi Susanto',
            'kontak' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 10',
            'created_at' => Carbon::now(),
        ]);

        $customer2Id = DB::table('customers')->insertGetId([
            'nama' => 'Siti Aisyah',
            'kontak' => '089876543210',
            'alamat' => 'Jl. Mawar No. 5',
            'created_at' => Carbon::now(),
        ]);

        // Insert Pets
        $petId = DB::table('pets')->insertGetId([
            'customer_id' => $customerId,
            'nama_hewan' => 'Milo',
            'spesies' => 'Kucing Persia',
            'created_at' => Carbon::now(),
        ]);

        $pet2Id = DB::table('pets')->insertGetId([
            'customer_id' => $customer2Id,
            'nama_hewan' => 'Bruno',
            'spesies' => 'Anjing Golden',
            'created_at' => Carbon::now(),
        ]);

        // Insert Staff
        $staffId = DB::table('staff')->insertGetId([
            'nama_staff' => 'Budi',
            'peran' => 'Groomer',
            'created_at' => Carbon::now(),
        ]);

        // Insert Services
        $serviceId = DB::table('services')->insertGetId([
            'nama_layanan' => 'Basic Grooming',
            'harga' => 75000,
            'created_at' => Carbon::now(),
        ]);

        $service2Id = DB::table('services')->insertGetId([
            'nama_layanan' => 'Full Grooming',
            'harga' => 150000,
            'created_at' => Carbon::now(),
        ]);

        // Insert Transaction 1
        $trx1 = DB::table('transactions')->insertGetId([
            'customer_id' => $customerId,
            'pet_id' => $petId,
            'staff_id' => $staffId,
            'tanggal' => date('Y-m-d'),
            'total_harga' => 75000,
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('transaction_details')->insert([
            'transaction_id' => $trx1,
            'service_id' => $serviceId,
            'jumlah' => 1,
            'subtotal' => 75000,
            'created_at' => Carbon::now(),
        ]);

        // Insert Transaction 2
        $trx2 = DB::table('transactions')->insertGetId([
            'customer_id' => $customer2Id,
            'pet_id' => $pet2Id,
            'staff_id' => $staffId,
            'tanggal' => date('Y-m-d'),
            'total_harga' => 150000,
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('transaction_details')->insert([
            'transaction_id' => $trx2,
            'service_id' => $service2Id,
            'jumlah' => 1,
            'subtotal' => 150000,
            'created_at' => Carbon::now(),
        ]);
    }
}
