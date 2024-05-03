<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::all()->pluck('slug')->toArray();
        $permissions = Permission::all()->pluck('slug')->toArray();

        foreach ($roles as $roleName) {
            $role = Role::where('slug', $roleName)->first();

            foreach ($permissions as $permissionName) {
                $permission = Permission::where('slug', $permissionName)->first();
                $role->permissions()->attach($permission);
            }
        }
    }
}
