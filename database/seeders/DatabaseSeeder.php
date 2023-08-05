<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->make([
            'email' => 'maa@host.com',
            'roll' => UserRoles::MAA->value
        ])->create();

        User::factory()->make([
            'email' => 'eaa@host.com',
            'roll' => UserRoles::EAA->value
        ])->create();
    }
}
