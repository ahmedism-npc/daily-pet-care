<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\{Service, Customer, Pet};

class DetailedMockSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Perincian Layanan Vaksinasi (Tanpa menghapus layanan lama agar transaksi lama tidak error foreign key)
        $vaccines = [
            ['nama_layanan' => 'Vaksinasi Rabies (Anjing & Kucing)', 'harga' => 150000],
            ['nama_layanan' => 'Vaksinasi Tricat/F3 Kucing (Panleukopenia, Rhinotracheitis, Calicivirus)', 'harga' => 200000],
            ['nama_layanan' => 'Vaksinasi Tetracat/F4 Kucing (+ Chlamydia)', 'harga' => 250000],
            ['nama_layanan' => 'Vaksinasi Parvo/Eurican 4 (Anjing)', 'harga' => 220000],
            ['nama_layanan' => 'Vaksinasi Kennel Cough (Bordetella)', 'harga' => 180000],
        ];

        foreach($vaccines as $v) {
            // Cek jika belum ada agar tidak ganda kalau di run ulang
            $exists = Service::where('nama_layanan', $v['nama_layanan'])->exists();
            if (!$exists) {
                Service::create($v);
            }
        }

        // Opsional: Rename layanan lama yang sudah ada transaksinya agar lebih spesifik
        Service::where('nama_layanan', 'like', '%Vaksinasi Tahunan%')
               ->update(['nama_layanan' => 'Vaksinasi Umum / Vaksin Booster']);

        // 2. Tambah Data Pelanggan & Hewan Lain (Walk-in, tanpa akun User)
        $dummyCustomers = [
            ['nama' => 'Budi Santoso', 'kontak' => '082211112222', 'alamat' => 'Jl. Sudirman 12'],
            ['nama' => 'Sari Indah', 'kontak' => '083322223333', 'alamat' => 'Jl. Thamrin 45'],
            ['nama' => 'Dewi Lestari', 'kontak' => '084433334444', 'alamat' => 'Jl. Gatot Subroto 99'],
            ['nama' => 'Rina Gunawan', 'kontak' => '085544445555', 'alamat' => 'Jl. Melati 7'],
            ['nama' => 'Fajar Pratama', 'kontak' => '086677778888', 'alamat' => 'Jl. Anggrek 11'],
        ];
        
        $petsArray = [
            ['nama_hewan' => 'Simba', 'spesies' => 'Kucing Kampung'],
            ['nama_hewan' => 'Max', 'spesies' => 'Anjing Beagle'],
            ['nama_hewan' => 'Luna', 'spesies' => 'Kucing Anggora'],
            ['nama_hewan' => 'Rocky', 'spesies' => 'Anjing Husky'],
            ['nama_hewan' => 'Mochi', 'spesies' => 'Kucing Persia'],
        ];

        foreach($dummyCustomers as $idx => $dc) {
            // Cek agar tidak duplikat jika seeder di run ulang
            if(!Customer::where('kontak', $dc['kontak'])->exists()) {
                $cust = Customer::create($dc); 
                
                Pet::create([
                    'customer_id' => $cust->id, 
                    'nama_hewan' => $petsArray[$idx]['nama_hewan'], 
                    'spesies' => $petsArray[$idx]['spesies']
                ]);
                
                if($idx == 0) {
                    Pet::create([
                        'customer_id' => $cust->id, 
                        'nama_hewan' => 'Leo', 
                        'spesies' => 'Kucing Domestik'
                    ]);
                }
            }
        }
    }
}
