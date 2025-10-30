<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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
        // Admin Permissions
        Role::create([
            'name' => 'superman',
            "guard_name" => 'web'
        ]);
        Role::create([
            'name' => 'admin',
            "guard_name" => 'web'
        ]);

        $admin = User::create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make(12345678),
        ]);
    }
}
