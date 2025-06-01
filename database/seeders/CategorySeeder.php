<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Makan dan Minum',
                'description' => 'Pengeluaran untuk makanan dan minuman harian',
                'table_name' => 'transactions',
                'created_by' => 1,
                'created_at' => Carbon::parse('2025-05-08 05:24:02'),
                'updated_at' => Carbon::parse('2025-05-08 05:34:44'),
                'deleted_at' => null
            ],
            [
                'name' => 'Transportasi',
                'description' => 'Biaya transportasi harian seperti bensin, ojek, dll',
                'table_name' => 'transactions',
                'created_by' => 1,
                'created_at' => Carbon::parse('2025-05-08 06:00:00'),
                'updated_at' => Carbon::parse('2025-05-08 06:00:00'),
                'deleted_at' => null
            ],
            [
                'name' => 'Tagihan',
                'description' => 'Listrik, air, internet, dll',
                'table_name' => 'bills',
                'created_by' => 1,
                'created_at' => Carbon::parse('2025-05-08 06:10:00'),
                'updated_at' => Carbon::parse('2025-05-08 06:12:00'),
                'deleted_at' => null
            ],
            [
                'name' => 'Hiburan',
                'description' => 'Pengeluaran untuk hiburan seperti bioskop, game, dll',
                'table_name' => 'transactions',
                'created_by' => 1,
                'created_at' => Carbon::parse('2025-05-08 06:20:00'),
                'updated_at' => Carbon::parse('2025-05-08 06:21:00'),
                'deleted_at' => Carbon::parse('2025-05-08 06:21:00')
            ],
            [
                'name' => 'Kesehatan',
                'description' => 'Pengeluaran untuk obat, konsultasi dokter, dll',
                'table_name' => 'transactions',
                'created_by' => 1,
                'created_at' => Carbon::parse('2025-05-08 06:30:00'),
                'updated_at' => Carbon::parse('2025-05-08 06:30:00'),
                'deleted_at' => null
            ],
        ]);
    }
}
