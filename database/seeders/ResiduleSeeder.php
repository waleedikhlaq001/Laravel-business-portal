<?php

namespace Database\Seeders;

use App\Models\ResidulePayment;
use Illuminate\Database\Seeder;

class ResiduleSeeder extends Seeder
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
                'name' => 'cosmetics',
                'percentage' => '5',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'clothes',
                'percentage' => '2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Electronics',
                'percentage' => '10',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        ResidulePayment::insert($data);
    }
}
