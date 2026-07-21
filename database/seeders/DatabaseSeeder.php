<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // This tells Laravel to run your Marky rooms seeder during migrate:fresh
        $this->call(MarkyDatabaseSeeder::class);
    }
}