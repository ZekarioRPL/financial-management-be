<?php

namespace Database\Seeders;

use App\Models\Budget;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $budgets = [
            [
                'wallet_id'   => 1,
                'category_id' => 6, // Makan dan Minum
                'status_id'   => 1,
                'name'        => 'Budget Harian Makan',
                'amount'      => 50000,
                'start_date'  => Carbon::now()->startOfMonth()->format('Y-m-d'),
                'end_date'    => Carbon::now()->endOfMonth()->format('Y-m-d'),
                'created_by'  => 1,
                'updated_by'  => 1,
            ],
            [
                'wallet_id'   => 1,
                'category_id' => 8, // Tagihan
                'status_id'   => 1,
                'name'        => 'Budget Tagihan Bulanan',
                'amount'      => 300000,
                'start_date'  => Carbon::now()->startOfMonth()->format('Y-m-d'),
                'end_date'    => Carbon::now()->endOfMonth()->format('Y-m-d'),
                'created_by'  => 1,
                'updated_by'  => 1,
            ],
            [
                'wallet_id'   => 1,
                'category_id' => 7, // Transportasi
                'status_id'   => 1,
                'name'        => 'Transportasi Harian',
                'amount'      => 100000,
                'start_date'  => Carbon::now()->startOfMonth()->format('Y-m-d'),
                'end_date'    => Carbon::now()->endOfMonth()->format('Y-m-d'),
                'created_by'  => 1,
                'updated_by'  => 1,
            ],
        ];

        foreach ($budgets as $budget) {
            Budget::create($budget);
        }
    }
}
