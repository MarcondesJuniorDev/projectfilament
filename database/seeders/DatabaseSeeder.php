<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Super',
            'email' => 'super@super.com',
            'password' => bcrypt('M4rc0nd35'),
        ]);

        User::factory(100)->create();
    }
}
