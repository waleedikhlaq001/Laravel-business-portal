<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Influencer;
use App\Models\InfluencerDetails;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use App\Models\InfluencerCategory;
use App\Models\InfluencerType;

use Illuminate\Support\Str;

class InfluencerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Jane',
            'last_name' => 'Influencer',
            'email' => 'influencer@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'image' => 'https://ui-avatars.com/api/?background=random&name=Jane+Influencer&size=128',
            'instagram' => '_jane',
            'user_instagram_id' => 1278273012012,
        ]);
        $role = Role::where('name', 'Creative')->first();
        $user->role()->attach($role->id);
        $category = InfluencerCategory::where('name', 'Macro Influencers')->first();
        $type = InfluencerType::where('name', 'free')->first();
        $code = Str::random(20);
        $currency = Currency::where('name', 'Naira')->first();

        InfluencerDetails::create([
            'influencer_years_experience' => 10,
            'influencer_description' => 'Experienced marketer in all social media platforms, we provide the best content and deliver on time',
            'inflencer_services_provided' => 'music',
            'influencer_followers' => 'Nano Influencers',
            'influencer_previous_job' => 'Business',
            'influencer_turnaround_time' => 'Few days',
            'influencer_charges' => '300000',
            'influencer_skills' => 'Comedian',
            'influencer_clients' => 'Instagram',
            'currency_id' => $currency->id,
            'user_id' => $user->id,
        ]);
        Influencer::create([
            'user_id' => $user->id,
            'code' => $code,
            'influencer_type_id' => $type->id,
            'influencer_category_id' => $category->id
        ]);
    }
}
