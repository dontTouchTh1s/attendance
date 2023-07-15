<?php

namespace Database\Factories;

use App\Models\LeaveRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $leaveRequest = factory(LeaveRequest::class)->count(1)->create();
        return [
            'employee_id' => fake()->randomNumber(),
            'description' => fake()->text,
            'status' => 'pending',
            'requestable_type' => LeaveRequest::class,
            'requestable_id' => $leaveRequest->id
        ];
    }
}
