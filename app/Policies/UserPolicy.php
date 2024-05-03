<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view-any-user');
    }

    public function view(User $user, User $model): bool
    {
        return $user->hasPermission('view-user');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create-user');
    }

    public function update(User $user, User $model): bool
    {
        return $user->hasPermission('update-user');
    }

    public function delete(User $user, User $model): bool
    {
        return $user->hasPermission('delete-user');
    }

    public function restore(User $user, User $model): bool
    {
        return $user->hasPermission('restore-user');
    }

    public function forceDelete(User $user, User $model): bool
    {
        return $user->hasPermission('force-delete-user');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermission('delete-any-user');
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermission('restore-any-user');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermission('force-delete-any-user');
    }
}
