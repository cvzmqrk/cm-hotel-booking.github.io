<?php

namespace Database\Factories;

use App\Models\MarkyRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarkyRoomFactory extends Factory
{
    protected $model = MarkyRoom::class;

    public function definition(): array
    {
        return [
            'marky_room_name' => 'Grand Marky Suite ' . $this->faker->unique()->numberBetween(101, 110),
            'marky_room_description' => 'A luxury executive space equipped with modern booking amenities.',
            'marky_room_price' => $this->faker->randomFloat(2, 150, 500),
        ];
    }
}