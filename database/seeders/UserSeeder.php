<?php

namespace Database\Seeders;

use App\Enums\RoleName;
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
    }

    public function createAdminUser()
    {
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@exapmle.com',
            'password' => bcrypt('password'),
        ]);

        $adminRole = Role::where('name', RoleName::ADMIN->value)->first();

        $user->roles()->sync([$adminRole->id]);
    }
}
