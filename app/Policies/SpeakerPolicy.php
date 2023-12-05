<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Speaker;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpeakerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the speaker can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list speakers');
    }

    /**
     * Determine whether the speaker can view the model.
     */
    public function view(User $user, Speaker $model): bool
    {
        return $user->hasPermissionTo('view speakers');
    }

    /**
     * Determine whether the speaker can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create speakers');
    }

    /**
     * Determine whether the speaker can update the model.
     */
    public function update(User $user, Speaker $model): bool
    {
        return $user->hasPermissionTo('update speakers');
    }

    /**
     * Determine whether the speaker can delete the model.
     */
    public function delete(User $user, Speaker $model): bool
    {
        return $user->hasPermissionTo('delete speakers');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete speakers');
    }

    /**
     * Determine whether the speaker can restore the model.
     */
    public function restore(User $user, Speaker $model): bool
    {
        return false;
    }

    /**
     * Determine whether the speaker can permanently delete the model.
     */
    public function forceDelete(User $user, Speaker $model): bool
    {
        return false;
    }
}
