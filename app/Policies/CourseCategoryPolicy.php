<?php

namespace App\Policies;

use App\Models\CourseCategory;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CourseCategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view-any-course-category') || $user->hasRoles(['super-admin']);
    }

    public function view(User $user, CourseCategory $courseCategory): bool
    {
        return $user->hasPermission('view-course-category') || $user->hasRoles(['super-admin']);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create-course-category') || $user->hasRoles(['super-admin']);
    }

    public function update(User $user, CourseCategory $courseCategory): bool
    {
        return $user->hasPermission('update-course-category') || $user->hasRoles(['super-admin']);
    }

    public function delete(User $user, CourseCategory $courseCategory): bool
    {
        return $user->hasPermission('delete-course-category') || $user->hasRoles(['super-admin']);
    }

    public function restore(User $user, CourseCategory $courseCategory): bool
    {
        return $user->hasPermission('restore-course-category') || $user->hasRoles(['super-admin']);
    }

    public function forceDelete(User $user, CourseCategory $courseCategory): bool
    {
        return $user->hasPermission('force-delete-course-category') || $user->hasRoles(['super-admin']);
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermission('delete-any-course-category') || $user->hasRoles(['super-admin']);
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermission('restore-any-course-category') || $user->hasRoles(['super-admin']);
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermission('force-delete-any-course-category') || $user->hasRoles(['super-admin']);
    }
}
