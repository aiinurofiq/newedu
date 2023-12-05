<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Senda;
use Illuminate\Auth\Access\HandlesAuthorization;

class SendaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the senda can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list sendas');
    }

    /**
     * Determine whether the senda can view the model.
     */
    public function view(User $user, Senda $model): bool
    {
        return $user->hasPermissionTo('view sendas');
    }

    /**
     * Determine whether the senda can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create sendas');
    }

    /**
     * Determine whether the senda can update the model.
     */
    public function update(User $user, Senda $model): bool
    {
        return $user->hasPermissionTo('update sendas');
    }

    /**
     * Determine whether the senda can delete the model.
     */
    public function delete(User $user, Senda $model): bool
    {
        return $user->hasPermissionTo('delete sendas');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete sendas');
    }

    /**
     * Determine whether the senda can restore the model.
     */
    public function restore(User $user, Senda $model): bool
    {
        return false;
    }

    /**
     * Determine whether the senda can permanently delete the model.
     */
    public function forceDelete(User $user, Senda $model): bool
    {
        return false;
    }
}
