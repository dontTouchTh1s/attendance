<?php

namespace App\Policies;

use App\Enums\UserRoles;
use App\Models\User;

class EmployeePolicy
{
    public function create(User $user): bool
    {
        return $user->roll == UserRoles::MAA->value;
    }

    public function viewAny(User $user): bool
    {
        return $user->roll == UserRoles::MAA->value or $user->roll == UserRoles::EAA->value;
    }
}
