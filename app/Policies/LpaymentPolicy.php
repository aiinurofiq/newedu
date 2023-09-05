<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Lpayment;
use Illuminate\Auth\Access\HandlesAuthorization;

class LpaymentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the lpayment can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list lpayments');
    }

    /**
     * Determine whether the lpayment can view the model.
     */
    public function view(User $user, Lpayment $model): bool
    {
        return $user->hasPermissionTo('view lpayments');
    }

    /**
     * Determine whether the lpayment can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create lpayments');
    }

    /**
     * Determine whether the lpayment can update the model.
     */
    public function update(User $user, Lpayment $model): bool
    {
        return $user->hasPermissionTo('update lpayments');
    }

    /**
     * Determine whether the lpayment can delete the model.
     */
    public function delete(User $user, Lpayment $model): bool
    {
        return $user->hasPermissionTo('delete lpayments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete lpayments');
    }

    /**
     * Determine whether the lpayment can restore the model.
     */
    public function restore(User $user, Lpayment $model): bool
    {
        return false;
    }

    /**
     * Determine whether the lpayment can permanently delete the model.
     */
    public function forceDelete(User $user, Lpayment $model): bool
    {
        return false;
    }
}
