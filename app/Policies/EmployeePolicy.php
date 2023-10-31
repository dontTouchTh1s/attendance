<?php

namespace App\Policies;

use App\Enums\UserRoles;
use App\Models\User;

class EmployeePolicy
{
    public function createWithRole(User $user): bool
    {
        return $user->role == UserRoles::SuperAdmin->value;
    }

    public function create(User $user): bool
    {
        return $user->role == UserRoles::SuperAdmin->value or $user->role == UserRoles::ManagerAdministrativeAffairs->value;
    }

    public function viewAny(User $user): bool
    {
        return $user->role == UserRoles::SuperAdmin->value or $user->role == UserRoles::ManagerAdministrativeAffairs->value or $user->role == UserRoles::ExpertAdministrativeAffairs->value;
    }

}
