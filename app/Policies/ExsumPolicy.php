<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Exsum;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExsumPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the exsum can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list exsums');
    }

    /**
     * Determine whether the exsum can view the model.
     */
    public function view(User $user, Exsum $model): bool
    {
        return $user->hasPermissionTo('view exsums');
    }

    /**
     * Determine whether the exsum can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create exsums');
    }

    /**
     * Determine whether the exsum can update the model.
     */
    public function update(User $user, Exsum $model): bool
    {
        return $user->hasPermissionTo('update exsums');
    }

    /**
     * Determine whether the exsum can delete the model.
     */
    public function delete(User $user, Exsum $model): bool
    {
        return $user->hasPermissionTo('delete exsums');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete exsums');
    }

    /**
     * Determine whether the exsum can restore the model.
     */
    public function restore(User $user, Exsum $model): bool
    {
        return false;
    }

    /**
     * Determine whether the exsum can permanently delete the model.
     */
    public function forceDelete(User $user, Exsum $model): bool
    {
        return false;
    }
}
