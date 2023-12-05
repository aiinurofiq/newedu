<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Marital;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaritalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the marital can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list maritals');
    }

    /**
     * Determine whether the marital can view the model.
     */
    public function view(User $user, Marital $model): bool
    {
        return $user->hasPermissionTo('view maritals');
    }

    /**
     * Determine whether the marital can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create maritals');
    }

    /**
     * Determine whether the marital can update the model.
     */
    public function update(User $user, Marital $model): bool
    {
        return $user->hasPermissionTo('update maritals');
    }

    /**
     * Determine whether the marital can delete the model.
     */
    public function delete(User $user, Marital $model): bool
    {
        return $user->hasPermissionTo('delete maritals');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete maritals');
    }

    /**
     * Determine whether the marital can restore the model.
     */
    public function restore(User $user, Marital $model): bool
    {
        return false;
    }

    /**
     * Determine whether the marital can permanently delete the model.
     */
    public function forceDelete(User $user, Marital $model): bool
    {
        return false;
    }
}
