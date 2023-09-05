<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Award;
use Illuminate\Auth\Access\HandlesAuthorization;

class AwardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the award can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list awards');
    }

    /**
     * Determine whether the award can view the model.
     */
    public function view(User $user, Award $model): bool
    {
        return $user->hasPermissionTo('view awards');
    }

    /**
     * Determine whether the award can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create awards');
    }

    /**
     * Determine whether the award can update the model.
     */
    public function update(User $user, Award $model): bool
    {
        return $user->hasPermissionTo('update awards');
    }

    /**
     * Determine whether the award can delete the model.
     */
    public function delete(User $user, Award $model): bool
    {
        return $user->hasPermissionTo('delete awards');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete awards');
    }

    /**
     * Determine whether the award can restore the model.
     */
    public function restore(User $user, Award $model): bool
    {
        return false;
    }

    /**
     * Determine whether the award can permanently delete the model.
     */
    public function forceDelete(User $user, Award $model): bool
    {
        return false;
    }
}
