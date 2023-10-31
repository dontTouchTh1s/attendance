<?php

namespace Database\Seeders;

use App\Enums\UserRoles;
use App\Models\GroupPolicy;
use App\Models\User;
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

        $adminGp = GroupPolicy::factory()
            ->create([
                'name' => 'مدیران'
            ]);

        User::factory()->hasEmployee([
            'first_name' => 'maa',
            'group_policy_id' => $adminGp
        ])
            ->create([
                'email' => 'maa@host.com',
                'role' => UserRoles::ManagerAdministrativeAffairs->value
            ]);

        User::factory()->hasEmployee([
            'first_name' => 'eaa',
            'group_policy_id' => $adminGp
        ])->create([
            'email' => 'eaa@host.com',
            'role' => UserRoles::ExpertAdministrativeAffairs->value
        ]);
    }

}
