<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Bumnclass;
use Illuminate\Auth\Access\HandlesAuthorization;

class BumnclassPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the bumnclass can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list bumnclasses');
    }

    /**
     * Determine whether the bumnclass can view the model.
     */
    public function view(User $user, Bumnclass $model): bool
    {
        return $user->hasPermissionTo('view bumnclasses');
    }

    /**
     * Determine whether the bumnclass can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create bumnclasses');
    }

    /**
     * Determine whether the bumnclass can update the model.
     */
    public function update(User $user, Bumnclass $model): bool
    {
        return $user->hasPermissionTo('update bumnclasses');
    }

    /**
     * Determine whether the bumnclass can delete the model.
     */
    public function delete(User $user, Bumnclass $model): bool
    {
        return $user->hasPermissionTo('delete bumnclasses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete bumnclasses');
    }

    /**
     * Determine whether the bumnclass can restore the model.
     */
    public function restore(User $user, Bumnclass $model): bool
    {
        return false;
    }

    /**
     * Determine whether the bumnclass can permanently delete the model.
     */
    public function forceDelete(User $user, Bumnclass $model): bool
    {
        return false;
    }
}
