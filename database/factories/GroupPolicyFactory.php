<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GroupPolicy>
 */
class GroupPolicyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startHour = ['07:00:00', '08:00:00'];
        $endHour = ['15:00:00', '14:00:00'];
        $groupPoliciesNames = ['کارمندان', 'نگهبانی', 'نظافت', 'حساب داری'];
        return [
            'name' => fake()->randomElement($groupPoliciesNames),
            'max_leave_month' => fake()->numberBetween(7, 15),
            'max_leave_year' => fake()->numberBetween(84, 180),
            'work_start_hour' => fake()->randomElement($startHour),
            'work_end_hour' => fake()->randomElement($endHour),
            'work_place_id' => 1
        ];
    }
}
