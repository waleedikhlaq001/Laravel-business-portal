<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\Influencer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ResiduleSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(InfluencerTypeSeeder::class);
        $this->call(InfluencerCategorySeeder::class);
        $this->call(BudgetSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(VendorTypeSeeder::class);
        $this->call(ResiduleSeeder::class);
        $this->call(CurrenciesSeeder::class);
        $this->call(HowVicommaWorksSeeder::class);
        $this->call(LandingPageSeeder::class);
        $this->call(NotJustAnotherVideoSharingPlatformSeeder::class);
        $this->call(VicommaBenefitsSeeder::class);
        $this->call(WhoUsesVicommaSeeder::class);
        $this->call(WhyJoinVicommaSeeder::class);
        $this->call(WhyVicommaIsForYouSeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(InfluencerSeeder::class);
    }
}
