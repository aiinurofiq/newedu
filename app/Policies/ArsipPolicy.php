<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Arsip;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArsipPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the arsip can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list arsips');
    }

    /**
     * Determine whether the arsip can view the model.
     */
    public function view(User $user, Arsip $model): bool
    {
        return $user->hasPermissionTo('view arsips');
    }

    /**
     * Determine whether the arsip can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create arsips');
    }

    /**
     * Determine whether the arsip can update the model.
     */
    public function update(User $user, Arsip $model): bool
    {
        return $user->hasPermissionTo('update arsips');
    }

    /**
     * Determine whether the arsip can delete the model.
     */
    public function delete(User $user, Arsip $model): bool
    {
        return $user->hasPermissionTo('delete arsips');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete arsips');
    }

    /**
     * Determine whether the arsip can restore the model.
     */
    public function restore(User $user, Arsip $model): bool
    {
        return false;
    }

    /**
     * Determine whether the arsip can permanently delete the model.
     */
    public function forceDelete(User $user, Arsip $model): bool
    {
        return false;
    }
}
