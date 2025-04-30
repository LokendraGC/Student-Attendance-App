<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(["name" => "admin"]);

        $user = User::firstOrCreate(
            ['email' => 'gclokendra10@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123')
            ]
        );

        $user->assignRole($adminRole);
        $adminRole->givePermissionTo( Permission::all() );

    }

    // php artisan make:AdminSeeder
    // php artisan db:seed --class=AdminSeeder
}
