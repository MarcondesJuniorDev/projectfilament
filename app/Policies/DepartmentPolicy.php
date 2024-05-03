<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DepartmentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view-any-department') || $user->hasRoles(['super-admin']);
    }

    public function view(User $user, Department $department): bool
    {
        return $user->hasPermission('view-department') || $user->hasRoles(['super-admin']);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create-department') || $user->hasRoles(['super-admin']);
    }

    public function update(User $user, Department $department): bool
    {
        return $user->hasPermission('update-department') || $user->hasRoles(['super-admin']);
    }

    public function delete(User $user, Department $department): bool
    {
        return $user->hasPermission('delete-department') || $user->hasRoles(['super-admin']);
    }

    public function restore(User $user, Department $department): bool
    {
        return $user->hasPermission('restore-department') || $user->hasRoles(['super-admin']);
    }

    public function forceDelete(User $user, Department $department): bool
    {
        return $user->hasPermission('force-delete-department') || $user->hasRoles(['super-admin']);
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermission('delete-any-department') || $user->hasRoles(['super-admin']);
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermission('restore-any-department') || $user->hasRoles(['super-admin']);
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermission('force-delete-any-department') || $user->hasRoles(['super-admin']);
    }
}
