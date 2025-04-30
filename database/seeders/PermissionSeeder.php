<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
            'grade.list',
            'delete.grade',
            'add.subject',
            'edit.subject',
            'subject.list',
            'delete.subject',
            'add.student',
            'edit.student',
            'student.list',
            'delete.student',
            'add.role',
            'edit.role',
            'role.list',
            'delete.role',
            'add.resources',
            'edit.resources',
            'resource.list',
            'delete.resources',
            'edit.attendance',
        ];

        foreach ($permissions as $key => $value) {
            Permission::create(['name' => $value]);
        }


    }
}
