<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Module;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModulePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the module can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list modules');
    }

    /**
     * Determine whether the module can view the model.
     */
    public function view(User $user, Module $model): bool
    {
        return $user->hasPermissionTo('view modules');
    }

    /**
     * Determine whether the module can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create modules');
    }

    /**
     * Determine whether the module can update the model.
     */
    public function update(User $user, Module $model): bool
    {
        return $user->hasPermissionTo('update modules');
    }

    /**
     * Determine whether the module can delete the model.
     */
    public function delete(User $user, Module $model): bool
    {
        return $user->hasPermissionTo('delete modules');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete modules');
    }

    /**
     * Determine whether the module can restore the model.
     */
    public function restore(User $user, Module $model): bool
    {
        return false;
    }

    /**
     * Determine whether the module can permanently delete the model.
     */
    public function forceDelete(User $user, Module $model): bool
    {
        return false;
    }
}
