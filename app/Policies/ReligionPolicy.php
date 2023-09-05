<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Religion;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReligionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the religion can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list religions');
    }

    /**
     * Determine whether the religion can view the model.
     */
    public function view(User $user, Religion $model): bool
    {
        return $user->hasPermissionTo('view religions');
    }

    /**
     * Determine whether the religion can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create religions');
    }

    /**
     * Determine whether the religion can update the model.
     */
    public function update(User $user, Religion $model): bool
    {
        return $user->hasPermissionTo('update religions');
    }

    /**
     * Determine whether the religion can delete the model.
     */
    public function delete(User $user, Religion $model): bool
    {
        return $user->hasPermissionTo('delete religions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete religions');
    }

    /**
     * Determine whether the religion can restore the model.
     */
    public function restore(User $user, Religion $model): bool
    {
        return false;
    }

    /**
     * Determine whether the religion can permanently delete the model.
     */
    public function forceDelete(User $user, Religion $model): bool
    {
        return false;
    }
}
