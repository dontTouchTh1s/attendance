<?php

namespace Database\Seeders;

use App\Models\WorkPlace;
use Illuminate\Database\Seeder;

class WorkPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkPlace::factory()->count(1)->create();
    }
}
