<?php

namespace Database\Seeders;

use App\Models\Admin\VicommaBenefit;
use Illuminate\Database\Seeder;

class VicommaBenefitsSeeder extends Seeder
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
                'benefit' => 'Chat in real-time to your audience'
            ],
            [
                'benefit' => 'Make live videos and post to your audience'
            ],
            [
                'benefit' => 'Open to all vendors'
            ],
            [
                'benefit' => ' Entire sales cycle is completed on one platform'
            ],
            [
                'benefit' => 'Chat in real-time to your audience'
            ],
            [
                'benefit' => 'No restrictions or unattainable qualifications to begin using the platform'
            ],
            [
                'benefit' => 'Connects to Twitter and Facebook so users know you have something to share with them right away'
            ],
            [
                'benefit' => 'Make Live videos and post immediately'
            ],
            [
                'benefit' => 'Connects to Twitter and Facebook so users know you have something to share with them right away'
            ],
            [
                'benefit' => 'Chat in real-time to your audience'
            ],
            [
                'benefit' => 'Join the community of users engaging in the new way of selling and promoting their brands virally'
            ]

        ];

        VicommaBenefit::insert($data);
    }
}
