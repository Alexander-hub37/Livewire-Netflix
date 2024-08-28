<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Alexander',
            'email' => 'alexander@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ])->assignRole('Admin');

        User::factory()->count(99)->create()->each(function ($user) {
            $user->assignRole('User');
        });
    }
}
