<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'Moderator',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'Vendor',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'Creative',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'General User',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
