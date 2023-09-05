<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Explanation;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExplanationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the explanation can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list explanations');
    }

    /**
     * Determine whether the explanation can view the model.
     */
    public function view(User $user, Explanation $model): bool
    {
        return $user->hasPermissionTo('view explanations');
    }

    /**
     * Determine whether the explanation can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create explanations');
    }

    /**
     * Determine whether the explanation can update the model.
     */
    public function update(User $user, Explanation $model): bool
    {
        return $user->hasPermissionTo('update explanations');
    }

    /**
     * Determine whether the explanation can delete the model.
     */
    public function delete(User $user, Explanation $model): bool
    {
        return $user->hasPermissionTo('delete explanations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete explanations');
    }

    /**
     * Determine whether the explanation can restore the model.
     */
    public function restore(User $user, Explanation $model): bool
    {
        return false;
    }

    /**
     * Determine whether the explanation can permanently delete the model.
     */
    public function forceDelete(User $user, Explanation $model): bool
    {
        return false;
    }
}
