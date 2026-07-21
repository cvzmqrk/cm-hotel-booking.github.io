<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MarkyRoom;

class MarkyDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // This is what actually creates the rooms in your database!
        MarkyRoom::factory()->count(5)->create();
    }
}