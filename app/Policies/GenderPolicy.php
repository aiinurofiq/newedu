<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Gender;
use Illuminate\Auth\Access\HandlesAuthorization;

class GenderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the gender can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list genders');
    }

    /**
     * Determine whether the gender can view the model.
     */
    public function view(User $user, Gender $model): bool
    {
        return $user->hasPermissionTo('view genders');
    }

    /**
     * Determine whether the gender can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create genders');
    }

    /**
     * Determine whether the gender can update the model.
     */
    public function update(User $user, Gender $model): bool
    {
        return $user->hasPermissionTo('update genders');
    }

    /**
     * Determine whether the gender can delete the model.
     */
    public function delete(User $user, Gender $model): bool
    {
        return $user->hasPermissionTo('delete genders');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete genders');
    }

    /**
     * Determine whether the gender can restore the model.
     */
    public function restore(User $user, Gender $model): bool
    {
        return false;
    }

    /**
     * Determine whether the gender can permanently delete the model.
     */
    public function forceDelete(User $user, Gender $model): bool
    {
        return false;
    }
}
