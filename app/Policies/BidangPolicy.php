<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Bidang;
use App\Models\User;

class BidangPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Bidang');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Bidang $bidang): bool
    {
        return $user->checkPermissionTo('view Bidang');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Bidang');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Bidang $bidang): bool
    {
        return $user->checkPermissionTo('update Bidang');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Bidang $bidang): bool
    {
        return $user->checkPermissionTo('delete Bidang');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Bidang $bidang): bool
    {
        return $user->checkPermissionTo('restore Bidang');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Bidang $bidang): bool
    {
        return $user->checkPermissionTo('force-delete Bidang');
    }
}
