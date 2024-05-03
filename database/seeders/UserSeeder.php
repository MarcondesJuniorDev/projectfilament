<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Super', 'email' => 'super@super.com', 'password' => bcrypt('M4rc0nd35')],
            ['name' => 'Admin', 'email' => 'admin@admin.com', 'password' => bcrypt('M4rc0nd35')],
            ['name' => 'Author', 'email' => 'author@author.com', 'password' => bcrypt('M4rc0nd35')],
            ['name' => 'User', 'email' => 'user@user.com', 'password' => bcrypt('M4rc0nd35')],
            ['name' => 'Tester', 'email' => 'teste@teste.com', 'password' => bcrypt('M4rc0nd35')],
        ];
        foreach ($users as $userData) {
            $user = User::create($userData);
        }
    }
}
