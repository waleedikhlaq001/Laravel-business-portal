<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Administrator',
            'last_name' => 'Vicomma',
            'email' => 'mistermaxflix@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Admin@vicomma$123'),
            'image' => 'https://ui-avatars.com/api/?background=random&name=Administrator+Vicomma&size=128',
        ]);
        $role = Role::where('name', 'Admin')->first();
        $user->role()->attach($role->id);
    }
}
