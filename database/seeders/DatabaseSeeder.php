<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'mark@gmail.com'],
            [
                'name'     => 'Admin Mark',
                'password' => Hash::make('123456789'),
                'role'     => 'admin', // <-- change 'role' to whatever column name your project uses (e.g. is_admin => 1, type => 'admin')
            ]
        );
    }
}