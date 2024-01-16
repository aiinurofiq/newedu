<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Keterangan;
use Illuminate\Auth\Access\HandlesAuthorization;

class KeteranganPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the keterangan can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list keterangans');
    }

    /**
     * Determine whether the keterangan can view the model.
     */
    public function view(User $user, Keterangan $model): bool
    {
        return $user->hasPermissionTo('view keterangans');
    }

    /**
     * Determine whether the keterangan can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create keterangans');
    }

    /**
     * Determine whether the keterangan can update the model.
     */
    public function update(User $user, Keterangan $model): bool
    {
        return $user->hasPermissionTo('update keterangans');
    }

    /**
     * Determine whether the keterangan can delete the model.
     */
    public function delete(User $user, Keterangan $model): bool
    {
        return $user->hasPermissionTo('delete keterangans');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete keterangans');
    }

    /**
     * Determine whether the keterangan can restore the model.
     */
    public function restore(User $user, Keterangan $model): bool
    {
        return false;
    }

    /**
     * Determine whether the keterangan can permanently delete the model.
     */
    public function forceDelete(User $user, Keterangan $model): bool
    {
        return false;
    }
}
