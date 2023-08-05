<?php

namespace Database\Seeders;

use App\Models\GroupPolicy;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            WorkPlaceSeeder::class
        ]);

        GroupPolicy::factory()->count(10)->hasPenaltyConditions(3)
            ->hasEmployees()
            ->create();
    }

}
