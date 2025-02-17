<?php

namespace Database\Seeders;

use App\Models\Budget;
use Illuminate\Database\Seeder;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Micro Project',
                'min' => 4800,
                'max' => 14400,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Small Project',
                'min' => 14400,
                'max' => 120000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Medium Project',
                'min' => 120000,
                'max' => 360000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Large Project',
                'min' => 360000,
                'max' => 720000,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        Budget::insert($data);
    }
}
