<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotJustAnotherVideoSharingPlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('not_just_another_video_platforms')->insert([
            'not_just_another_platform' => 'Not just another video sharing platform',
            'not_just_another_platform_description' => 'vicomma, pronounced vee-comma started out as a video sharing platform but we said, why not give our users a better video experience than the norm? We decided to combine the viewing sharing experience with e-commerce.',
            'vcomm_icon' => 'The vcom icon',
            'vcomm_icon_description' => 'Notice the icon called the vcom icon, it is the cart icon in the upper left hand corner of videos on the platform. This icon let’s your users know there is a product, merchandise, promotion, service, or deal attached to your video. Take a look at it and notice you can see it in videos on vicomma. So when users click on your video with this icon, they will see your video, with your products, merchandise, promotions, and deals immediately for them to notice, engage, and purchase.'
        ]);
    }
}
