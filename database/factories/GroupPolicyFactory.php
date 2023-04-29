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
        $groupPoliciesNames = ['کارمندان', 'نگهبانی', 'نظافت', 'حساب داری', 'مدیران ارشد'];
        return [
            'name' => fake()->randomElement($groupPoliciesNames),
            'max_leave_month' => fake()->numberBetween(7, 15),
            'max_leave_year' => fake()->numberBetween(84, 180),
        ];
    }
}
