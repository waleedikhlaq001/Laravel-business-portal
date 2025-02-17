<?php

namespace Database\Seeders;

use App\Models\InfluencerCategory;
use Illuminate\Database\Seeder;

class InfluencerCategorySeeder extends Seeder
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
                'name' => 'Nano Influencers',
                'description' => 'Caters small to mid size business with a limited marketing budget',
                'min' => 1,
                'max' => 10000,
                'provided_for' => 'If you want to test a product launch or test your products and services with a new niche',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Micro Influencers',
                'description' => 'If you are ready to start generating more focused leads',
                'min' => 10000,
                'max' => 100000,
                'provided_for' => 'This is more specialized so that the audience we reach for you is primed to hear marketing messages within the niche you want to reach',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Macro Influencers',
                'description' => 'we are ty[ically more established bloggers,social celebrities, or podcasters. we typically have a large audience who we have developed over months or years of nurturing relationships while growing followers',
                'min' => 100000,
                'max' => 1000000,
                'provided_for' => "This is great for bringing awareness to your brand, products, and services. Use this to increase your own engagement rates and boost your exisiting brand's reach.,We can help you reach a larger audience and increase your brand's reputation.",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mega Influencers',
                'description' => "You'll have to have a healthy marketing budget to afford us. we are typically celebrities/internet stars.The audiences we attract for you are going to be very broad.",
                'min' => 1000000,
                'max' => 10000000,
                'provided_for' => "you're working on a brand awareness campaign and have a large budget, here we can get your products in front of as many eyes as possible which is great if your brand has appeal across segments.",
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        InfluencerCategory::insert($data);
    }
}
