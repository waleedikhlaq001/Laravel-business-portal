<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('landing_pages')->insert([
            'main_header' => 'A community built for Vendors and Creatives to meet and earn big.',
            'main_description' => 'vendors, merchants, creators, influencers, comedians, musicians
find each other and the world finds us all.'
        ]);
    }
}
