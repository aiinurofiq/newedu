<?php

namespace App\Policies;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuizPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the quiz can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list quizzes');
    }

    /**
     * Determine whether the quiz can view the model.
     */
    public function view(User $user, Quiz $model): bool
    {
        return $user->hasPermissionTo('view quizzes');
    }

    /**
     * Determine whether the quiz can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create quizzes');
    }

    /**
     * Determine whether the quiz can update the model.
     */
    public function update(User $user, Quiz $model): bool
    {
        return $user->hasPermissionTo('update quizzes');
    }

    /**
     * Determine whether the quiz can delete the model.
     */
    public function delete(User $user, Quiz $model): bool
    {
        return $user->hasPermissionTo('delete quizzes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete quizzes');
    }

    /**
     * Determine whether the quiz can restore the model.
     */
    public function restore(User $user, Quiz $model): bool
    {
        return false;
    }

    /**
     * Determine whether the quiz can permanently delete the model.
     */
    public function forceDelete(User $user, Quiz $model): bool
    {
        return false;
    }
}
