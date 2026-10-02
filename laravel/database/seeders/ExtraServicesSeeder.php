<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExtraServicesSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('services')->insert([
            ['nama_layanan' => 'Mandi Kutu & Jamur', 'harga' => 120000, 'created_at' => $now, 'updated_at' => $now],
            ['nama_layanan' => 'Pet Hotel / Penitipan (Per Malam)', 'harga' => 80000, 'created_at' => $now, 'updated_at' => $now],
            ['nama_layanan' => 'Potong Kuku & Bersih Telinga', 'harga' => 35000, 'created_at' => $now, 'updated_at' => $now],
            ['nama_layanan' => 'Vaksinasi Tahunan (Kucing/Anjing)', 'harga' => 250000, 'created_at' => $now, 'updated_at' => $now],
            ['nama_layanan' => 'Pemeriksaan Kesehatan (Checkup)', 'harga' => 100000, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
