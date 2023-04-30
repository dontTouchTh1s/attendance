<?php

namespace Database\Factories;

use App\Enums\PenaltyConditionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PenaltyConditions>
 */
class PenaltyConditionsFactory extends Factory
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
            'delay' => fake()->numberBetween(10, 60),
            'penalty' => fake()->numberBetween(10, 60)
        ];
    }
}
