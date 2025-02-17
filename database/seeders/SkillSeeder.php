<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = [
            [
                'skill' => 'Comedian'
            ],
            [
                'skill' => 'fashionista'
            ],
            [
                'skill' => 'Actor'
            ],
            [
                'skill' => 'Blogger'
            ]
        ];
        Skill::insert($skills);
    }
}
