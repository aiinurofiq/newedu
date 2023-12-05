<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Learning;
use Illuminate\Auth\Access\HandlesAuthorization;

class LearningPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the learning can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list learnings');
    }

    /**
     * Determine whether the learning can view the model.
     */
    public function view(User $user, Learning $model): bool
    {
        return $user->hasPermissionTo('view learnings');
    }

    /**
     * Determine whether the learning can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create learnings');
    }

    /**
     * Determine whether the learning can update the model.
     */
    public function update(User $user, Learning $model): bool
    {
        return $user->hasPermissionTo('update learnings');
    }

    /**
     * Determine whether the learning can delete the model.
     */
    public function delete(User $user, Learning $model): bool
    {
        return $user->hasPermissionTo('delete learnings');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete learnings');
    }

    /**
     * Determine whether the learning can restore the model.
     */
    public function restore(User $user, Learning $model): bool
    {
        return false;
    }

    /**
     * Determine whether the learning can permanently delete the model.
     */
    public function forceDelete(User $user, Learning $model): bool
    {
        return false;
    }
}
