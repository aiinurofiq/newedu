<?php

namespace App\Policies;

use App\Models\Kid;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KidPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the kid can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list kids');
    }

    /**
     * Determine whether the kid can view the model.
     */
    public function view(User $user, Kid $model): bool
    {
        return $user->hasPermissionTo('view kids');
    }

    /**
     * Determine whether the kid can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create kids');
    }

    /**
     * Determine whether the kid can update the model.
     */
    public function update(User $user, Kid $model): bool
    {
        return $user->hasPermissionTo('update kids');
    }

    /**
     * Determine whether the kid can delete the model.
     */
    public function delete(User $user, Kid $model): bool
    {
        return $user->hasPermissionTo('delete kids');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete kids');
    }

    /**
     * Determine whether the kid can restore the model.
     */
    public function restore(User $user, Kid $model): bool
    {
        return false;
    }

    /**
     * Determine whether the kid can permanently delete the model.
     */
    public function forceDelete(User $user, Kid $model): bool
    {
        return false;
    }
}
