<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(["name"=> "edit attendance"]);
        Permission::create(["name"=> "add student"]);
        Permission::create(["name"=> "edit student"]);
        Permission::create(["name"=> "delete student"]);
        Permission::create(["name"=> "view student"]);

        Permission::create(["name"=> "add grade"]);
        Permission::create(["name"=> "edit grade"]);
        Permission::create(["name"=> "delete grade"]);
        Permission::create(["name"=> "view grade"]);

        Permission::create(["name"=> "add subject"]);
        Permission::create(["name"=> "edit subject"]);
        Permission::create(["name"=> "delete subject"]);
        Permission::create(["name"=> "view subject"]);

        $student  = Role::create(["name"=> "student"])->givePermissionTo(['view grade','view subject']);
        $teacher  = Role::create(["name"=> "teacher"])->givePermissionTo(['edit grade','edit subject','edit attendance']);
        $admin = Role::create(['name'=> 'admin'])->givePermissionTo(Permission::all());

    }
}
