<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view-any-role');
    }

    public function view(User $user, Role $role): bool
    {
        return $user->hasPermission('view-role');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create-role');
    }

    public function update(User $user, Role $role): bool
    {
        return $user->hasPermission('update-role');
    }

    public function delete(User $user, Role $role): bool
    {
        return $user->hasPermission('delete-role');
    }

    public function restore(User $user, Role $role): bool
    {
        return $user->hasPermission('restore-role');
    }

    public function forceDelete(User $user, Role $role): bool
    {
        return $user->hasPermission('force-delete-role');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermission('delete-any-role');
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermission('restore-any-role');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermission('force-delete-any-role');
    }
}
