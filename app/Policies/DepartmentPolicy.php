<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DepartmentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view-any-department');
    }

    public function view(User $user, Department $department): bool
    {
        return $user->hasPermission('view-department');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create-department');
    }

    public function update(User $user, Department $department): bool
    {
        return $user->hasPermission('update-department');
    }

    public function delete(User $user, Department $department): bool
    {
        return $user->hasPermission('delete-department');
    }

    public function restore(User $user, Department $department): bool
    {
        return $user->hasPermission('restore-department');
    }

    public function forceDelete(User $user, Department $department): bool
    {
        return $user->hasPermission('force-delete-department');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermission('delete-any-department');
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermission('restore-any-department');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermission('force-delete-any-department');
    }
}
