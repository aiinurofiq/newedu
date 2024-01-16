<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Jenisarsip;
use Illuminate\Auth\Access\HandlesAuthorization;

class JenisarsipPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the jenisarsip can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list jenisarsips');
    }

    /**
     * Determine whether the jenisarsip can view the model.
     */
    public function view(User $user, Jenisarsip $model): bool
    {
        return $user->hasPermissionTo('view jenisarsips');
    }

    /**
     * Determine whether the jenisarsip can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create jenisarsips');
    }

    /**
     * Determine whether the jenisarsip can update the model.
     */
    public function update(User $user, Jenisarsip $model): bool
    {
        return $user->hasPermissionTo('update jenisarsips');
    }

    /**
     * Determine whether the jenisarsip can delete the model.
     */
    public function delete(User $user, Jenisarsip $model): bool
    {
        return $user->hasPermissionTo('delete jenisarsips');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete jenisarsips');
    }

    /**
     * Determine whether the jenisarsip can restore the model.
     */
    public function restore(User $user, Jenisarsip $model): bool
    {
        return false;
    }

    /**
     * Determine whether the jenisarsip can permanently delete the model.
     */
    public function forceDelete(User $user, Jenisarsip $model): bool
    {
        return false;
    }
}
