<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'John',
            'last_name' => 'Vendor',
            'email' => 'vendor@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'image' => 'https://ui-avatars.com/api/?background=random&name=John+Vendor&size=128',
            'instagram' => '_john',
            'user_instagram_id' => 1278273012012,
        ]);

        $vtype = VendorType::where('name', 'Free')->first();
        $role = Role::where('name', 'Vendor')->first();
        $user->role()->attach($role->id);

        // Saving Vendor
        Vendor::create([
            'vendor_station' => 'First Mall',
            'user_id' => $user->id,
            'vendor_type_id' => $vtype->id
        ]);
    }
}
