<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Json;
use Nette\Utils\JsonException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkPlace>
 */
class WorkPlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws JsonException
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company,
            'radius' => fake()->numberBetween(80, 110),
            'location' => Json::encode(['lat' => fake()->randomFloat(9, 22, 24),
                'lng' => fake()->randomFloat(9, 50, 52)]),
            'address' => fake()->address
        ];
    }
}
