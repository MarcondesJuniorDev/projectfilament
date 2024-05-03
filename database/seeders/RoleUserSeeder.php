<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all()->pluck('email')->toArray();
        $roles = Role::all()->pluck('slug')->toArray();

        foreach ($users as $index => $userEmail) {
            $user = User::where('email', $userEmail)->first();
            $role = Role::where('slug', $roles[$index])->first();
            $user->roles()->attach($role);
        }
    }
}
