<?php

namespace Database\Seeders;

use App\Models\LeaveRequest;
use Illuminate\Database\Seeder;

class LeaveRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaveRequest::factory()->count(20)->hasRequest()->create();
    }
}
