<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view-any-role') || $user->hasRoles(['super-admin']);
    }

    public function view(User $user, Role $role): bool
    {
        return $user->hasPermission('view-role') || $user->hasRoles(['super-admin']);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create-role') || $user->hasRoles(['super-admin']);
    }

    public function update(User $user, Role $role): bool
    {
        return $user->hasPermission('update-role') || $user->hasRoles(['super-admin']);
    }

    public function delete(User $user, Role $role): bool
    {
        return $user->hasPermission('delete-role') || $user->hasRoles(['super-admin']);
    }

    public function restore(User $user, Role $role): bool
    {
        return $user->hasPermission('restore-role') || $user->hasRoles(['super-admin']);
    }

    public function forceDelete(User $user, Role $role): bool
    {
        return $user->hasPermission('force-delete-role') || $user->hasRoles(['super-admin']);
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermission('delete-any-role') || $user->hasRoles(['super-admin']);
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermission('restore-any-role') || $user->hasRoles(['super-admin']);
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermission('force-delete-any-role') || $user->hasRoles(['super-admin']);
    }
}
