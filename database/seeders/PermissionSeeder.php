<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'add.grade',
            'edit.grade',
            'delete.grade',
            'add.subject',
            'edit.subject',
            'delete.subject',
            'add.student',
            'edit.student',
            'delete.student',
            'add.resources',
            'edit.resources',
            'delete.resources',
            'edit.attendance',

        ];

        foreach ($permissions as $key => $value) {
            Permission::create(['name' => $value]);
        }

    }
}
