<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Kkeamanan;
use Illuminate\Auth\Access\HandlesAuthorization;

class KkeamananPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the kkeamanan can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list kkeamanans');
    }

    /**
     * Determine whether the kkeamanan can view the model.
     */
    public function view(User $user, Kkeamanan $model): bool
    {
        return $user->hasPermissionTo('view kkeamanans');
    }

    /**
     * Determine whether the kkeamanan can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create kkeamanans');
    }

    /**
     * Determine whether the kkeamanan can update the model.
     */
    public function update(User $user, Kkeamanan $model): bool
    {
        return $user->hasPermissionTo('update kkeamanans');
    }

    /**
     * Determine whether the kkeamanan can delete the model.
     */
    public function delete(User $user, Kkeamanan $model): bool
    {
        return $user->hasPermissionTo('delete kkeamanans');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete kkeamanans');
    }

    /**
     * Determine whether the kkeamanan can restore the model.
     */
    public function restore(User $user, Kkeamanan $model): bool
    {
        return false;
    }

    /**
     * Determine whether the kkeamanan can permanently delete the model.
     */
    public function forceDelete(User $user, Kkeamanan $model): bool
    {
        return false;
    }
}
