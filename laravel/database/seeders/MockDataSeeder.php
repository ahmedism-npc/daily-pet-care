<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Transaction, TransactionDetail, Customer, Pet, Staff, Service};
use Carbon\Carbon;

class MockDataSeeder extends Seeder
{
    public function run(): void
    {
        $customers = Customer::all();
        $pets = Pet::all();
        $staff = Staff::all();
        $services = Service::all();

        if($customers->isEmpty() || $pets->isEmpty() || $staff->isEmpty() || $services->isEmpty()) return;

        // Simulasi data selama 3 bulan ke belakang
        $startDate = Carbon::now()->subMonths(3);
        $endDate = Carbon::now();

        while($startDate->lte($endDate)) {
            // Setiap hari ada 1-3 pelanggan yang datang
            $numTrx = rand(1, 3);
            for($i=0; $i<$numTrx; $i++) {
                $c = $customers->random();
                // Cari hewan milik customer, jika tidak ada fallback ke hewan random
                $p = $pets->where('customer_id', $c->id)->first() ?? $pets->random();
                $s = $staff->random();
                
                $numServices = rand(1, 2);
                $selectedServices = $services->random($numServices);
                
                $totalHarga = 0;
                $details = [];
                
                foreach($selectedServices as $svc) {
                    $qty = rand(1, 2);
                    $subtotal = $svc->harga * $qty;
                    $totalHarga += $subtotal;
                    
                    $details[] = [
                        'service_id' => $svc->id,
                        'jumlah' => $qty,
                        'subtotal' => $subtotal,
                        'created_at' => $startDate->copy()->addHours(rand(8, 16)), // Jam operasional acak
                        'updated_at' => $startDate->copy()->addHours(rand(8, 16)),
                    ];
                }

                $trx = Transaction::create([
                    'customer_id' => $c->id,
                    'pet_id' => $p->id,
                    'staff_id' => $s->id,
                    'tanggal' => $startDate->format('Y-m-d'),
                    'total_harga' => $totalHarga,
                    'created_at' => $startDate->copy()->addHours(rand(8, 16)),
                    'updated_at' => $startDate->copy()->addHours(rand(8, 16)),
                ]);

                foreach($details as $detail) {
                    $detail['transaction_id'] = $trx->id;
                    TransactionDetail::insert($detail); // Menggunakan insert agar timestamp terjaga
                }
            }
            $startDate->addDay();
        }
    }
}
