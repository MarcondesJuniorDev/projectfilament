<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view-any-permission');
    }

    public function view(User $user, Permission $permission): bool
    {
        return $user->hasPermission('view-permission');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create-permission');
    }

    public function update(User $user, Permission $permission): bool
    {
        return $user->hasPermission('update-permission');
    }

    public function delete(User $user, Permission $permission): bool
    {
        return $user->hasPermission('delete-permission');
    }

    public function restore(User $user, Permission $permission): bool
    {
        return $user->hasPermission('restore-permission');
    }

    public function forceDelete(User $user, Permission $permission): bool
    {
        return $user->hasPermission('force-delete-permission');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermission('delete-any-permission');
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermission('restore-any-permission');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermission('force-delete-any-permission');
    }
}
