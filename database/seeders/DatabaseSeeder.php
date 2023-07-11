<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Employee;
use App\Models\GroupPolicy;
use App\Models\User;
use App\Models\WorkPlace;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);
        WorkPlace::factory()->count(1)->create();
        GroupPolicy::factory()->count(10)->hasPenaltyConditions(3)->has(Employee::factory(3)->has(User::factory(1)->create())->create())
            ->create();
    }
}
