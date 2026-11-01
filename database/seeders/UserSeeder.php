<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user Super Admin
        $superAdmin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'password' => Hash::make('Kurosaki0105$'),
            'email_verified_at' => now(),
        ]);

        // Berikan role 'Super Admin' ke user tersebut
        $superAdmin->assignRole('Super Admin');
    }
}
