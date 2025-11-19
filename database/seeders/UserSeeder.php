<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use App\Models\City;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdminUser();
        $this->createVendorUser();
    }

    public function createAdminUser()
    {
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $adminRole = Role::where('name', RoleName::ADMIN->value)->first();

        $user->roles()->sync([$adminRole->id]);
    }

    public function createVendorUser()
    {
        $vendor = User::create([
            'name' => 'Restaurant owner',
            'email' => 'vendor@admin.com',
            'password' => bcrypt('password'),
        ]);

        $vendorRole = Role::where('name', RoleName::VENDOR->value)->first();
        $vendor->roles()->sync([$vendorRole->id]);

        $vendor->restaurant()->create([
            'city_id' => City::where('name', 'Vilnius')->value('id'),
            'name' => 'Restaurant 001',
            'address' => 'Address SJV14',
        ]);
    }
}
