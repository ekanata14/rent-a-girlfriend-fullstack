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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'username' => 'Admin',
            'email' => 'admin@rent-a-girlfriend.com',
            'age' => 30,
            'height' => 175,
            'role' => 0,
            'gender' => 0,
            'email_verified_at' => now(),
            'mobile_phone' => '1234567890',
            'profile_picture' => null,
            'password' => bcrypt('password'),
        ]);
    }
}
