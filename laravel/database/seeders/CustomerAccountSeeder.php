<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{Customer, User};

class CustomerAccountSeeder extends Seeder
{
    public function run(): void
    {
        // Cari semua customer yang belum punya akun (user_id = null)
        $customers = Customer::whereNull('user_id')->get();

        // Hitung offset untuk nomor urut: customer2, customer3, dst.
        // customer1 = customer@petcare.com (sudah ada)
        $startIndex = 2;

        foreach ($customers as $idx => $customer) {
            $emailIndex = $startIndex + $idx;
            $email = "customer{$emailIndex}@petcare.com";

            // Skip jika email sudah ada
            if (User::where('email', $email)->exists()) continue;

            $user = User::create([
                'name' => $customer->nama,
                'email' => $email,
                'password' => Hash::make('password123'),
                'role' => 'customer',
            ]);

            // Tautkan customer ke user baru
            $customer->update(['user_id' => $user->id]);
        }
    }
}
