<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Valvision;
use Illuminate\Auth\Access\HandlesAuthorization;

class ValvisionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the valvision can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list valvisions');
    }

    /**
     * Determine whether the valvision can view the model.
     */
    public function view(User $user, Valvision $model): bool
    {
        return $user->hasPermissionTo('view valvisions');
    }

    /**
     * Determine whether the valvision can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create valvisions');
    }

    /**
     * Determine whether the valvision can update the model.
     */
    public function update(User $user, Valvision $model): bool
    {
        return $user->hasPermissionTo('update valvisions');
    }

    /**
     * Determine whether the valvision can delete the model.
     */
    public function delete(User $user, Valvision $model): bool
    {
        return $user->hasPermissionTo('delete valvisions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete valvisions');
    }

    /**
     * Determine whether the valvision can restore the model.
     */
    public function restore(User $user, Valvision $model): bool
    {
        return false;
    }

    /**
     * Determine whether the valvision can permanently delete the model.
     */
    public function forceDelete(User $user, Valvision $model): bool
    {
        return false;
    }
}
