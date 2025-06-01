<?php

namespace Database\Seeders;

use App\Models\Bill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusIds = [1, 2, 3, 4, 5];
        $categoryIds = [6, 7, 8, 9, 10];

        $data = [
            ['name' => 'Tagihan Rumah Sakit', 'description' => 'Membayar tagihan rumah sakit untuk kakak, adik dan orang tua'],
            ['name' => 'Tagihan Listrik', 'description' => 'Pembayaran listrik bulan Juli untuk rumah kontrakan'],
            ['name' => 'Tagihan Internet', 'description' => 'Bayar langganan internet bulanan Indihome'],
            ['name' => 'Cicilan Motor', 'description' => 'Pembayaran cicilan motor bulan ke-5 dari 12 bulan'],
            ['name' => 'Pembayaran SPP Anak', 'description' => 'SPP sekolah anak untuk bulan Juli 2025'],
            ['name' => 'Langganan Streaming', 'description' => 'Langganan Netflix dan Spotify keluarga'],
            ['name' => 'Tagihan Air PAM', 'description' => 'Bayar tagihan air bulanan dari PDAM'],
            ['name' => 'Pembelian Obat', 'description' => 'Beli obat untuk orang tua di apotek Kimia Farma'],
            ['name' => 'Tagihan Belanja Online', 'description' => 'Bayar cicilan belanja dari marketplace bulan ini'],
            ['name' => 'Biaya Perbaikan Rumah', 'description' => 'Membayar tukang untuk perbaikan atap bocor'],
        ];

        foreach ($data as $item) {
            Bill::create([
                'wallet_id'   => 1,
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'status_id'   => $statusIds[array_rand($statusIds)],
                'name'        => $item['name'],
                'amount'      => rand(100000, 1500000),
                'duedate'     => '2025-07-' . str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT),
                'description' => $item['description'],
                'created_by'  => 1,
                'updated_by'  => 0,
            ]);
        }
    }
}
