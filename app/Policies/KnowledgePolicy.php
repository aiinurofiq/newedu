<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Knowledge;
use Illuminate\Auth\Access\HandlesAuthorization;

class KnowledgePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the knowledge can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list knowledges');
    }

    /**
     * Determine whether the knowledge can view the model.
     */
    public function view(User $user, Knowledge $model): bool
    {
        return $user->hasPermissionTo('view knowledges');
    }

    /**
     * Determine whether the knowledge can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create knowledges');
    }

    /**
     * Determine whether the knowledge can update the model.
     */
    public function update(User $user, Knowledge $model): bool
    {
        return $user->hasPermissionTo('update knowledges');
    }

    /**
     * Determine whether the knowledge can delete the model.
     */
    public function delete(User $user, Knowledge $model): bool
    {
        return $user->hasPermissionTo('delete knowledges');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete knowledges');
    }

    /**
     * Determine whether the knowledge can restore the model.
     */
    public function restore(User $user, Knowledge $model): bool
    {
        return false;
    }

    /**
     * Determine whether the knowledge can permanently delete the model.
     */
    public function forceDelete(User $user, Knowledge $model): bool
    {
        return false;
    }
}
