<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view-any-user') || $user->hasRoles(['super-admin']);
    }

    public function view(User $user, User $model): bool
    {
        return $user->hasPermission('view-user') || $user->hasRoles(['super-admin']);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create-user') || $user->hasRoles(['super-admin']);
    }

    public function update(User $user, User $model): bool
    {
        return $user->hasPermission('update-user') || $user->hasRoles(['super-admin']);
    }

    public function delete(User $user, User $model): bool
    {
        return $user->hasPermission('delete-user') || $user->hasRoles(['super-admin']);
    }

    public function restore(User $user, User $model): bool
    {
        return $user->hasPermission('restore-user') || $user->hasRoles(['super-admin']);
    }

    public function forceDelete(User $user, User $model): bool
    {
        return $user->hasPermission('force-delete-user') || $user->hasRoles(['super-admin']);
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermission('delete-any-user') || $user->hasRoles(['super-admin']);
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermission('restore-any-user') || $user->hasRoles(['super-admin']);
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermission('force-delete-any-user') || $user->hasRoles(['super-admin']);
    }
}
