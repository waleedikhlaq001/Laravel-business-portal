<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HowVicommaWorksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('how_vicomma_works')->insert([
            'header' => 'So, how does vcomma work?',
            'description' => 'Users want to build a deeper relationship with you and your brands, so why not let them experience your brand with a simple video? They WILL watch. Not only that but now you can also sell and promote with product placement right next to your video so that what user see it your videos can be part of their lives too.',
            'step1_header' => 'Create a Vendor Station.',
            'step1_description' => 'Create a Vendor Station by Signing Up or choosing one of the options above, whether you are a vendor, creative, or just here to watch.',
            'step2_header' => 'Are you a Vendor, Creative,
Both?',
            'step2_description' => 'Choose which option suits you best for now; remember you can always upgrade to a different option. Whether you need to hire a creative to promote your stuff, or you’re looking to get hired as a creative; Your account will be free for now but you can always upgrade to a different one, anytime.',
            'step3_header' => 'Creatives',
            'step3_description' => 'Now here’s where you find vendors, merchants, and brands that need your services. Create your profile so that those looking for you can know who you are and what you have to offer. Find your match and vicomma helps to negotiate a proper offer. Create the content for your client(s), promote it, and get paid for every sale made through your channel.',
            'step4_header' => 'Vendors | Merchants | Brands',
            'step4_description' => 'So you need to get the word out about your products, merchandise, service, or brand? Well vicomma along with our pool of talented content creatives and influencers do just that. All you need to do is create your Vendor Station, take a few images of your products, services, or whatever you need content for and add it to your station. Find a creative that matches your needs and vicomma helps to negotiate a proper offer. Your creative will promote while you watch your sales increase. It’s that easy. Got more questions? Click here for answers to Frequently Asked Questions.'
        ]);
    }
}
