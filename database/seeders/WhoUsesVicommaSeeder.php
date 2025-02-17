<?php

namespace Database\Seeders;

use App\Models\Admin\WhoUsesVicomma;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WhoUsesVicommaSeeder extends Seeder
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
                'name' => 'Podcasters'
            ],
            [
                'name' => 'Visual Artists'
            ],
            [
                'name' => 'Musicians'
            ],
            [
                'name' => 'Fashion Designers'
            ],
            [
                'name' => 'Beauty Consultants'
            ],
            [
                'name' => 'Video Creators'
            ],
            [
                'name' => 'Foodies'
            ],
            [
                'name' => 'Comedians'
            ],
            [
                'name' => 'Gaming creators'
            ],
            [
                'name' => 'Hair Stylists'
            ]
        ];
        WhoUsesVicomma::insert($data);
    }
}
