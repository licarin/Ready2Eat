<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('1234'),
                'role' => 'admin',
            ],
            [
                'name' => 'Kiw',
                'email' => 'kiw@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'admin',
            ]
        ];

        foreach ($admins as $admin) {
            \App\Models\Admin::create($admin);
        }
    }
}
