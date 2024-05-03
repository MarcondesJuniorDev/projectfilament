<?php

namespace App\Policies;

use App\Models\LessonContent;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LessonContentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view-any-lesson-content') || $user->hasRoles(['super-admin']);
    }

    public function view(User $user, LessonContent $lessonContent): bool
    {
        return $user->hasPermission('view-lesson-content') || $user->hasRoles(['super-admin']);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create-lesson-content') || $user->hasRoles(['super-admin']);
    }

    public function update(User $user, LessonContent $lessonContent): bool
    {
        return $user->hasPermission('update-lesson-content') || $user->hasRoles(['super-admin']);
    }

    public function delete(User $user, LessonContent $lessonContent): bool
    {
        return $user->hasPermission('delete-lesson-content') || $user->hasRoles(['super-admin']);
    }

    public function restore(User $user, LessonContent $lessonContent): bool
    {
        return $user->hasPermission('restore-lesson-content') || $user->hasRoles(['super-admin']);
    }

    public function forceDelete(User $user, LessonContent $lessonContent): bool
    {
        return $user->hasPermission('force-delete-lesson-content') || $user->hasRoles(['super-admin']);
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermission('delete-any-lesson-content') || $user->hasRoles(['super-admin']);
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermission('restore-any-lesson-content') || $user->hasRoles(['super-admin']);
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermission('force-delete-any-lesson-content') || $user->hasRoles(['super-admin']);
    }
}
