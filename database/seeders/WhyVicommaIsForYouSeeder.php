<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WhyVicommaIsForYouSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('why_vicomma_is_for_yous')->insert([
            'hire_creative' => 'Hire a creative',
            'hire_creative_description' => 'So, on vicomma you can find influencers and creatives who will create a cool piece of content for you to sell or promote your product, merch, service, or brand; they can also promote it on their platform, if you ask nicely.',
            'earm_money' => 'Earn money creating',
            'earm_money_description' => 'We are in the age of creators so make it work for you if you haven’t already; find vendors and merchants that need you to push them forward; it will pay off',
            'watch_buy' => 'Watch & Buy',
            'watch_buy_description' => 'The greatest thing in life is freedom, with vicomma you can enjoy the freedom of ALL types of content and also get a piece of this content by buying what you see easily, log in and enjoy the view.'
        ]);
    }
}
