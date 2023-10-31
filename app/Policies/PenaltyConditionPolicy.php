<?php

namespace App\Policies;

use App\Enums\UserRoles;
use App\Models\PenaltyCondition;
use App\Models\User;

class PenaltyConditionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PenaltyCondition $condition): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roll == UserRoles::SuperAdmin->value or
            $user->roll == UserRoles::ManagerAdministrativeAffairs->value or
            $user->roll == UserRoles::ExpertAdministrativeAffairs->value;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PenaltyCondition $condition): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PenaltyCondition $condition): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PenaltyCondition $condition): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PenaltyCondition $condition): bool
    {
        //
    }
}
