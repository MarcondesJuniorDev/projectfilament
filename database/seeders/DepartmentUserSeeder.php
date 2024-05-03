<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        Department::all()->each(function ($department) use ($users) {
            $department->users()->attach(
                $users->random(rand(5, 10))->pluck('id')->toArray()
            );
        });
    }
}
