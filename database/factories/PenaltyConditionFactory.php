<?php

namespace Database\Factories;

use App\Enums\PenaltyConditionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PenaltyCondition>
 */
class PenaltyConditionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(PenaltyConditionType::values()),
            'duration' => fake()->numberBetween(10, 60),
            'penalty' => fake()->numberBetween(10, 60)
        ];
    }
}
