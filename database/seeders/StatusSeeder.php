<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'pending', 'table_name' => 'bills', 'color_code' => ''],
            ['name' => 'paying', 'table_name' => 'bills', 'color_code' => ''],
            ['name' => 'paid', 'table_name' => 'bills', 'color_code' => ''],
            ['name' => 'overdue', 'table_name' => 'bills', 'color_code' => ''],
            ['name' => 'cancelled', 'table_name' => 'bills', 'color_code' => ''],
        ];

        foreach ($statuses as $status) {
            Status::updateOrCreate(['name' => $status['name']], $status);
        }
    }
}
