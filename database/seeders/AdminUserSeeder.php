<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Kelurahan',
            'email' => 'admin@kelurahan.id',
            'password' => Hash::make('password123'), // modify after login!
            'nik' => '7371123456789012',
            'role' => 'admin',
            'is_verified' => true,
        ]);
    }
}
