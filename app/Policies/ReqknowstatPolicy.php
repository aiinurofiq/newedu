<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reqknowstat;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReqknowstatPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the reqknowstat can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list reqknowstats');
    }

    /**
     * Determine whether the reqknowstat can view the model.
     */
    public function view(User $user, Reqknowstat $model): bool
    {
        return $user->hasPermissionTo('view reqknowstats');
    }

    /**
     * Determine whether the reqknowstat can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create reqknowstats');
    }

    /**
     * Determine whether the reqknowstat can update the model.
     */
    public function update(User $user, Reqknowstat $model): bool
    {
        return $user->hasPermissionTo('update reqknowstats');
    }

    /**
     * Determine whether the reqknowstat can delete the model.
     */
    public function delete(User $user, Reqknowstat $model): bool
    {
        return $user->hasPermissionTo('delete reqknowstats');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete reqknowstats');
    }

    /**
     * Determine whether the reqknowstat can restore the model.
     */
    public function restore(User $user, Reqknowstat $model): bool
    {
        return false;
    }

    /**
     * Determine whether the reqknowstat can permanently delete the model.
     */
    public function forceDelete(User $user, Reqknowstat $model): bool
    {
        return false;
    }
}
