<?php

namespace App\Policies;

use App\Models\SchoolGrade;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SchoolGradePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view-any-school-grade') || $user->hasRoles(['super-admin']);
    }

    public function view(User $user, SchoolGrade $schoolGrade): bool
    {
        return $user->hasPermission('view-school-grade') || $user->hasRoles(['super-admin']);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create-school-grade') || $user->hasRoles(['super-admin']);
    }

    public function update(User $user, SchoolGrade $schoolGrade): bool
    {
        return $user->hasPermission('update-school-grade') || $user->hasRoles(['super-admin']);
    }

    public function delete(User $user, SchoolGrade $schoolGrade): bool
    {
        return $user->hasPermission('delete-school-grade') || $user->hasRoles(['super-admin']);
    }

    public function restore(User $user, SchoolGrade $schoolGrade): bool
    {
        return $user->hasPermission('restore-school-grade') || $user->hasRoles(['super-admin']);
    }

    public function forceDelete(User $user, SchoolGrade $schoolGrade): bool
    {
        return $user->hasPermission('force-delete-school-grade') || $user->hasRoles(['super-admin']);
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermission('delete-any-school-grade') || $user->hasRoles(['super-admin']);
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermission('restore-any-school-grade') || $user->hasRoles(['super-admin']);
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermission('force-delete-any-school-grade') || $user->hasRoles(['super-admin']);
    }
}
