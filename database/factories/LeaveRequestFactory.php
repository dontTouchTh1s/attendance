<?php

namespace Database\Factories;

use App\Enums\LeaveRequestsType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveRequest>
 */
class LeaveRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fromDate = fake()->dateTimeBetween(now(), '2 month')->format('Y-m-d');
        $toDate = new Carbon($fromDate);
        $toDate->addDays(fake()->numberBetween(1, 4));
        return [
            'type' => fake()->randomElement(LeaveRequestsType::values()),
            'from_date' => $fromDate,
            'to_date' => $toDate
        ];
    }
}
