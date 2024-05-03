<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view-any-permission') || $user->hasRoles(['super-admin']);
    }

    public function view(User $user, Permission $permission): bool
    {
        return $user->hasPermission('view-permission') || $user->hasRoles(['super-admin']);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create-permission') || $user->hasRoles(['super-admin']);
    }

    public function update(User $user, Permission $permission): bool
    {
        return $user->hasPermission('update-permission') || $user->hasRoles(['super-admin']);
    }

    public function delete(User $user, Permission $permission): bool
    {
        return $user->hasPermission('delete-permission') || $user->hasRoles(['super-admin']);
    }

    public function restore(User $user, Permission $permission): bool
    {
        return $user->hasPermission('restore-permission') || $user->hasRoles(['super-admin']);
    }

    public function forceDelete(User $user, Permission $permission): bool
    {
        return $user->hasPermission('force-delete-permission') || $user->hasRoles(['super-admin']);
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermission('delete-any-permission') || $user->hasRoles(['super-admin']);
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermission('restore-any-permission') || $user->hasRoles(['super-admin']);
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermission('force-delete-any-permission') || $user->hasRoles(['super-admin']);
    }
}
