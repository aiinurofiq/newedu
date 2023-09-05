<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reqknowledge;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReqknowledgePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the reqknowledge can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list reqknowledges');
    }

    /**
     * Determine whether the reqknowledge can view the model.
     */
    public function view(User $user, Reqknowledge $model): bool
    {
        return $user->hasPermissionTo('view reqknowledges');
    }

    /**
     * Determine whether the reqknowledge can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create reqknowledges');
    }

    /**
     * Determine whether the reqknowledge can update the model.
     */
    public function update(User $user, Reqknowledge $model): bool
    {
        return $user->hasPermissionTo('update reqknowledges');
    }

    /**
     * Determine whether the reqknowledge can delete the model.
     */
    public function delete(User $user, Reqknowledge $model): bool
    {
        return $user->hasPermissionTo('delete reqknowledges');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete reqknowledges');
    }

    /**
     * Determine whether the reqknowledge can restore the model.
     */
    public function restore(User $user, Reqknowledge $model): bool
    {
        return false;
    }

    /**
     * Determine whether the reqknowledge can permanently delete the model.
     */
    public function forceDelete(User $user, Reqknowledge $model): bool
    {
        return false;
    }
}
