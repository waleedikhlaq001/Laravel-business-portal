<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WhyJoinVicommaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('why_join_vicommas')->insert([
            'why_join_vicomma_header' => 'So why join vicomma?',
            'why_join_vicomma_description' => 'vicomma is the next level of experiencing video and e-commerce with a twist.

We facilitate the sales of products and merchandise or promote your brand through videos all on one platform. So unlike other social media platforms where you need to direct users to a 3rd party platform, on vicomma just create a Vendor Station, connect, add products, merchandise, or services for users to see and transact immediately, all on ONE platform.'
        ]);
    }
}
