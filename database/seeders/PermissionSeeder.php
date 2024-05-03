<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'Create User', 'slug' => 'create-user'],
            ['name' => 'View Any User', 'slug' => 'view-any-user'],
            ['name' => 'View User', 'slug' => 'view-user'],
            ['name' => 'Update User', 'slug' => 'update-user'],
            ['name' => 'Delete User', 'slug' => 'delete-user'],
            ['name' => 'Restore User', 'slug' => 'restore-user'],
            ['name' => 'Force Delete User', 'slug' => 'force-delete-user'],
            ['name' => 'Delete Any User', 'slug' => 'delete-any-user'],
            ['name' => 'Restore Any User', 'slug' => 'restore-any-user'],
            ['name' => 'Force Delete Any User', 'slug' => 'force-delete-any-user'],

            ['name' => 'Create Role', 'slug' => 'create-role'],
            ['name' => 'View Any Role', 'slug' => 'view-any-role'],
            ['name' => 'View Role', 'slug' => 'view-role'],
            ['name' => 'Update Role', 'slug' => 'update-role'],
            ['name' => 'Delete Role', 'slug' => 'delete-role'],
            ['name' => 'Restore Role', 'slug' => 'restore-role'],
            ['name' => 'Force Delete Role', 'slug' => 'force-delete-role'],
            ['name' => 'Delete Any Role', 'slug' => 'delete-any-role'],

            ['name' => 'Create Permission', 'slug' => 'create-permission'],
            ['name' => 'View Any Permission', 'slug' => 'view-any-permission'],
            ['name' => 'View Permission', 'slug' => 'view-permission'],
            ['name' => 'Update Permission', 'slug' => 'update-permission'],
            ['name' => 'Delete Permission', 'slug' => 'delete-permission'],
            ['name' => 'Restore Permission', 'slug' => 'restore-permission'],
            ['name' => 'Force Delete Permission', 'slug' => 'force-delete-permission'],
            ['name' => 'Delete Any Permission', 'slug' => 'delete-any-permission'],
            ['name' => 'Restore Any Permission', 'slug' => 'restore-any-permission'],
            ['name' => 'Force Delete Any Permission', 'slug' => 'force-delete-any-permission'],

            ['name' => 'Create Department', 'slug' => 'create-department'],
            ['name' => 'View Any Department', 'slug' => 'view-any-department'],
            ['name' => 'View Department', 'slug' => 'view-department'],
            ['name' => 'Update Department', 'slug' => 'update-department'],
            ['name' => 'Delete Department', 'slug' => 'delete-department'],
            ['name' => 'Restore Department', 'slug' => 'restore-department'],
            ['name' => 'Force Delete Department', 'slug' => 'force-delete-department'],
            ['name' => 'Delete Any Department', 'slug' => 'delete-any-department'],
            ['name' => 'Restore Any Department', 'slug' => 'restore-any-department'],
            ['name' => 'Force Delete Any Department', 'slug' => 'force-delete-any-department'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
