<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Bumnsector;
use Illuminate\Auth\Access\HandlesAuthorization;

class BumnsectorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the bumnsector can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list bumnsectors');
    }

    /**
     * Determine whether the bumnsector can view the model.
     */
    public function view(User $user, Bumnsector $model): bool
    {
        return $user->hasPermissionTo('view bumnsectors');
    }

    /**
     * Determine whether the bumnsector can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create bumnsectors');
    }

    /**
     * Determine whether the bumnsector can update the model.
     */
    public function update(User $user, Bumnsector $model): bool
    {
        return $user->hasPermissionTo('update bumnsectors');
    }

    /**
     * Determine whether the bumnsector can delete the model.
     */
    public function delete(User $user, Bumnsector $model): bool
    {
        return $user->hasPermissionTo('delete bumnsectors');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete bumnsectors');
    }

    /**
     * Determine whether the bumnsector can restore the model.
     */
    public function restore(User $user, Bumnsector $model): bool
    {
        return false;
    }

    /**
     * Determine whether the bumnsector can permanently delete the model.
     */
    public function forceDelete(User $user, Bumnsector $model): bool
    {
        return false;
    }
}
