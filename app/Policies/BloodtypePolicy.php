<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Bloodtype;
use Illuminate\Auth\Access\HandlesAuthorization;

class BloodtypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the bloodtype can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list bloodtypes');
    }

    /**
     * Determine whether the bloodtype can view the model.
     */
    public function view(User $user, Bloodtype $model): bool
    {
        return $user->hasPermissionTo('view bloodtypes');
    }

    /**
     * Determine whether the bloodtype can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create bloodtypes');
    }

    /**
     * Determine whether the bloodtype can update the model.
     */
    public function update(User $user, Bloodtype $model): bool
    {
        return $user->hasPermissionTo('update bloodtypes');
    }

    /**
     * Determine whether the bloodtype can delete the model.
     */
    public function delete(User $user, Bloodtype $model): bool
    {
        return $user->hasPermissionTo('delete bloodtypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete bloodtypes');
    }

    /**
     * Determine whether the bloodtype can restore the model.
     */
    public function restore(User $user, Bloodtype $model): bool
    {
        return false;
    }

    /**
     * Determine whether the bloodtype can permanently delete the model.
     */
    public function forceDelete(User $user, Bloodtype $model): bool
    {
        return false;
    }
}
