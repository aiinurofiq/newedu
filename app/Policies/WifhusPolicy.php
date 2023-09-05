<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wifhus;
use Illuminate\Auth\Access\HandlesAuthorization;

class WifhusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the wifhus can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list wifhuses');
    }

    /**
     * Determine whether the wifhus can view the model.
     */
    public function view(User $user, Wifhus $model): bool
    {
        return $user->hasPermissionTo('view wifhuses');
    }

    /**
     * Determine whether the wifhus can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create wifhuses');
    }

    /**
     * Determine whether the wifhus can update the model.
     */
    public function update(User $user, Wifhus $model): bool
    {
        return $user->hasPermissionTo('update wifhuses');
    }

    /**
     * Determine whether the wifhus can delete the model.
     */
    public function delete(User $user, Wifhus $model): bool
    {
        return $user->hasPermissionTo('delete wifhuses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete wifhuses');
    }

    /**
     * Determine whether the wifhus can restore the model.
     */
    public function restore(User $user, Wifhus $model): bool
    {
        return false;
    }

    /**
     * Determine whether the wifhus can permanently delete the model.
     */
    public function forceDelete(User $user, Wifhus $model): bool
    {
        return false;
    }
}
