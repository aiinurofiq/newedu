<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Social;
use Illuminate\Auth\Access\HandlesAuthorization;

class SocialPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the social can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list socials');
    }

    /**
     * Determine whether the social can view the model.
     */
    public function view(User $user, Social $model): bool
    {
        return $user->hasPermissionTo('view socials');
    }

    /**
     * Determine whether the social can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create socials');
    }

    /**
     * Determine whether the social can update the model.
     */
    public function update(User $user, Social $model): bool
    {
        return $user->hasPermissionTo('update socials');
    }

    /**
     * Determine whether the social can delete the model.
     */
    public function delete(User $user, Social $model): bool
    {
        return $user->hasPermissionTo('delete socials');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete socials');
    }

    /**
     * Determine whether the social can restore the model.
     */
    public function restore(User $user, Social $model): bool
    {
        return false;
    }

    /**
     * Determine whether the social can permanently delete the model.
     */
    public function forceDelete(User $user, Social $model): bool
    {
        return false;
    }
}
