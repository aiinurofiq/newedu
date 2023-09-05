<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LTransaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class LTransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the lTransaction can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list ltransactions');
    }

    /**
     * Determine whether the lTransaction can view the model.
     */
    public function view(User $user, LTransaction $model): bool
    {
        return $user->hasPermissionTo('view ltransactions');
    }

    /**
     * Determine whether the lTransaction can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create ltransactions');
    }

    /**
     * Determine whether the lTransaction can update the model.
     */
    public function update(User $user, LTransaction $model): bool
    {
        return $user->hasPermissionTo('update ltransactions');
    }

    /**
     * Determine whether the lTransaction can delete the model.
     */
    public function delete(User $user, LTransaction $model): bool
    {
        return $user->hasPermissionTo('delete ltransactions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete ltransactions');
    }

    /**
     * Determine whether the lTransaction can restore the model.
     */
    public function restore(User $user, LTransaction $model): bool
    {
        return false;
    }

    /**
     * Determine whether the lTransaction can permanently delete the model.
     */
    public function forceDelete(User $user, LTransaction $model): bool
    {
        return false;
    }
}
