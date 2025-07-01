<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Room;

class RoomFactory extends Factory {
    protected $model = Room::class;

    public function definition(): array {
        return [
            'number' => $this->faker->unique()->numerify('Room ###'),
            'type' => $this->faker->randomElement(['Single', 'Double', 'Suite']),
            'capacity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
