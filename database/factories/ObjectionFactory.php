<?php

namespace Database\Factories;

use App\Models\Objection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ObjectionFactory extends Factory
{
    protected $model = Objection::class;

    public function definition(): array
    {
        return [
            'description' => $this->faker->text(),
            'attendance_leave_id' => $this->faker->randomNumber(),
            'reviewed' => $this->faker->boolean(),
            'feedback' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
