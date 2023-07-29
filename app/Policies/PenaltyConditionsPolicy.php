<?php

namespace App\Policies;

use App\Enums\UserRoles;
use App\Models\PenaltyCondition;
use App\Models\User;

class PenaltyConditionsPolicy
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
        return $user->roll === UserRoles::MAA or $user->roll === UserRoles::EAA;
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
