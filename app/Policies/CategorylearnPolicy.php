<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Categorylearn;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategorylearnPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the categorylearn can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list categorylearns');
    }

    /**
     * Determine whether the categorylearn can view the model.
     */
    public function view(User $user, Categorylearn $model): bool
    {
        return $user->hasPermissionTo('view categorylearns');
    }

    /**
     * Determine whether the categorylearn can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create categorylearns');
    }

    /**
     * Determine whether the categorylearn can update the model.
     */
    public function update(User $user, Categorylearn $model): bool
    {
        return $user->hasPermissionTo('update categorylearns');
    }

    /**
     * Determine whether the categorylearn can delete the model.
     */
    public function delete(User $user, Categorylearn $model): bool
    {
        return $user->hasPermissionTo('delete categorylearns');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete categorylearns');
    }

    /**
     * Determine whether the categorylearn can restore the model.
     */
    public function restore(User $user, Categorylearn $model): bool
    {
        return false;
    }

    /**
     * Determine whether the categorylearn can permanently delete the model.
     */
    public function forceDelete(User $user, Categorylearn $model): bool
    {
        return false;
    }
}
