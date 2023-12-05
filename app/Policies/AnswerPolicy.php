<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Answer;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the answer can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list answers');
    }

    /**
     * Determine whether the answer can view the model.
     */
    public function view(User $user, Answer $model): bool
    {
        return $user->hasPermissionTo('view answers');
    }

    /**
     * Determine whether the answer can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create answers');
    }

    /**
     * Determine whether the answer can update the model.
     */
    public function update(User $user, Answer $model): bool
    {
        return $user->hasPermissionTo('update answers');
    }

    /**
     * Determine whether the answer can delete the model.
     */
    public function delete(User $user, Answer $model): bool
    {
        return $user->hasPermissionTo('delete answers');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete answers');
    }

    /**
     * Determine whether the answer can restore the model.
     */
    public function restore(User $user, Answer $model): bool
    {
        return false;
    }

    /**
     * Determine whether the answer can permanently delete the model.
     */
    public function forceDelete(User $user, Answer $model): bool
    {
        return false;
    }
}
