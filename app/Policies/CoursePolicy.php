<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view-any-course') || $user->hasRoles(['super-admin']);
    }

    public function view(User $user, Course $course): bool
    {
        return $user->hasPermission('view-course') || $user->hasRoles(['super-admin']);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create-course') || $user->hasRoles(['super-admin']);
    }

    public function update(User $user, Course $course): bool
    {
        return $user->hasPermission('update-course') || $user->hasRoles(['super-admin']);
    }

    public function delete(User $user, Course $course): bool
    {
        return $user->hasPermission('delete-course') || $user->hasRoles(['super-admin']);
    }

    public function restore(User $user, Course $course): bool
    {
        return $user->hasPermission('restore-course') || $user->hasRoles(['super-admin']);
    }

    public function forceDelete(User $user, Course $course): bool
    {
        return $user->hasPermission('force-delete-course') || $user->hasRoles(['super-admin']);
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermission('delete-any-course') || $user->hasRoles(['super-admin']);
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermission('restore-any-course') || $user->hasRoles(['super-admin']);
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermission('force-delete-any-course') || $user->hasRoles(['super-admin']);
    }
}
