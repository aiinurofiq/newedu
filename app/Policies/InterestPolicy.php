<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Interest;
use Illuminate\Auth\Access\HandlesAuthorization;

class InterestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the interest can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list interests');
    }

    /**
     * Determine whether the interest can view the model.
     */
    public function view(User $user, Interest $model): bool
    {
        return $user->hasPermissionTo('view interests');
    }

    /**
     * Determine whether the interest can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create interests');
    }

    /**
     * Determine whether the interest can update the model.
     */
    public function update(User $user, Interest $model): bool
    {
        return $user->hasPermissionTo('update interests');
    }

    /**
     * Determine whether the interest can delete the model.
     */
    public function delete(User $user, Interest $model): bool
    {
        return $user->hasPermissionTo('delete interests');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete interests');
    }

    /**
     * Determine whether the interest can restore the model.
     */
    public function restore(User $user, Interest $model): bool
    {
        return false;
    }

    /**
     * Determine whether the interest can permanently delete the model.
     */
    public function forceDelete(User $user, Interest $model): bool
    {
        return false;
    }
}
