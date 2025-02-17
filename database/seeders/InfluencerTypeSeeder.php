<?php

namespace Database\Seeders;

use App\Models\InfluencerType;
use Illuminate\Database\Seeder;

class InfluencerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'Free',
                'price' => 0.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pivotal',
                'price' => 2800.2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Moving Up',
                'price' => 4300.2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Premium',
                'price' => 6300.2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        InfluencerType::insert($types);
    }
}
