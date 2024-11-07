<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => true
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
