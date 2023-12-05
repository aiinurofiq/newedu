<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Jurnal;
use Illuminate\Auth\Access\HandlesAuthorization;

class JurnalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the jurnal can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list jurnals');
    }

    /**
     * Determine whether the jurnal can view the model.
     */
    public function view(User $user, Jurnal $model): bool
    {
        return $user->hasPermissionTo('view jurnals');
    }

    /**
     * Determine whether the jurnal can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create jurnals');
    }

    /**
     * Determine whether the jurnal can update the model.
     */
    public function update(User $user, Jurnal $model): bool
    {
        return $user->hasPermissionTo('update jurnals');
    }

    /**
     * Determine whether the jurnal can delete the model.
     */
    public function delete(User $user, Jurnal $model): bool
    {
        return $user->hasPermissionTo('delete jurnals');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete jurnals');
    }

    /**
     * Determine whether the jurnal can restore the model.
     */
    public function restore(User $user, Jurnal $model): bool
    {
        return false;
    }

    /**
     * Determine whether the jurnal can permanently delete the model.
     */
    public function forceDelete(User $user, Jurnal $model): bool
    {
        return false;
    }
}
