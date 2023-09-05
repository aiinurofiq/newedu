<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Division;
use Illuminate\Auth\Access\HandlesAuthorization;

class DivisionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the division can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list divisions');
    }

    /**
     * Determine whether the division can view the model.
     */
    public function view(User $user, Division $model): bool
    {
        return $user->hasPermissionTo('view divisions');
    }

    /**
     * Determine whether the division can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create divisions');
    }

    /**
     * Determine whether the division can update the model.
     */
    public function update(User $user, Division $model): bool
    {
        return $user->hasPermissionTo('update divisions');
    }

    /**
     * Determine whether the division can delete the model.
     */
    public function delete(User $user, Division $model): bool
    {
        return $user->hasPermissionTo('delete divisions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete divisions');
    }

    /**
     * Determine whether the division can restore the model.
     */
    public function restore(User $user, Division $model): bool
    {
        return false;
    }

    /**
     * Determine whether the division can permanently delete the model.
     */
    public function forceDelete(User $user, Division $model): bool
    {
        return false;
    }
}
