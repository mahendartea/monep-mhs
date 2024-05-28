<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Monev;
use App\Models\User;

class MonevPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Monev');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Monev $monev): bool
    {
        return $user->checkPermissionTo('view Monev');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Monev');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Monev $monev): bool
    {
        return $user->checkPermissionTo('update Monev');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Monev $monev): bool
    {
        return $user->checkPermissionTo('delete Monev');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Monev $monev): bool
    {
        return $user->checkPermissionTo('restore Monev');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Monev $monev): bool
    {
        return $user->checkPermissionTo('force-delete Monev');
    }
}
