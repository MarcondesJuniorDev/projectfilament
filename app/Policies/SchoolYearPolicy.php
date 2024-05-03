<?php

namespace App\Policies;

use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SchoolYearPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view-any-school-year') || $user->hasRoles(['super-admin']);
    }

    public function view(User $user, SchoolYear $schoolYear): bool
    {
        return $user->hasPermission('view-school-year') || $user->hasRoles(['super-admin']);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create-school-year') || $user->hasRoles(['super-admin']);
    }

    public function update(User $user, SchoolYear $schoolYear): bool
    {
        return $user->hasPermission('update-school-year') || $user->hasRoles(['super-admin']);
    }

    public function delete(User $user, SchoolYear $schoolYear): bool
    {
        return $user->hasPermission('delete-school-year') || $user->hasRoles(['super-admin']);
    }

    public function restore(User $user, SchoolYear $schoolYear): bool
    {
        return $user->hasPermission('restore-school-year') || $user->hasRoles(['super-admin']);
    }

    public function forceDelete(User $user, SchoolYear $schoolYear): bool
    {
        return $user->hasPermission('force-delete-school-year') || $user->hasRoles(['super-admin']);
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermission('delete-any-school-year') || $user->hasRoles(['super-admin']);
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermission('restore-any-school-year') || $user->hasRoles(['super-admin']);
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermission('force-delete-any-school-year') || $user->hasRoles(['super-admin']);
    }
}
