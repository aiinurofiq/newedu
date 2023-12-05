<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Fieldofposition;
use Illuminate\Auth\Access\HandlesAuthorization;

class FieldofpositionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the fieldofposition can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list fieldofpositions');
    }

    /**
     * Determine whether the fieldofposition can view the model.
     */
    public function view(User $user, Fieldofposition $model): bool
    {
        return $user->hasPermissionTo('view fieldofpositions');
    }

    /**
     * Determine whether the fieldofposition can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create fieldofpositions');
    }

    /**
     * Determine whether the fieldofposition can update the model.
     */
    public function update(User $user, Fieldofposition $model): bool
    {
        return $user->hasPermissionTo('update fieldofpositions');
    }

    /**
     * Determine whether the fieldofposition can delete the model.
     */
    public function delete(User $user, Fieldofposition $model): bool
    {
        return $user->hasPermissionTo('delete fieldofpositions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete fieldofpositions');
    }

    /**
     * Determine whether the fieldofposition can restore the model.
     */
    public function restore(User $user, Fieldofposition $model): bool
    {
        return false;
    }

    /**
     * Determine whether the fieldofposition can permanently delete the model.
     */
    public function forceDelete(User $user, Fieldofposition $model): bool
    {
        return false;
    }
}
