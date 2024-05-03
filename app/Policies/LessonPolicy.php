<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LessonPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view-any-lesson') || $user->hasRoles(['super-admin']);
    }

    public function view(User $user, Lesson $lesson): bool
    {
        return $user->hasPermission('view-lesson') || $user->hasRoles(['super-admin']);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create-lesson') || $user->hasRoles(['super-admin']);
    }

    public function update(User $user, Lesson $lesson): bool
    {
        return $user->hasPermission('update-lesson') || $user->hasRoles(['super-admin']);
    }

    public function delete(User $user, Lesson $lesson): bool
    {
        return $user->hasPermission('delete-lesson') || $user->hasRoles(['super-admin']);
    }

    public function restore(User $user, Lesson $lesson): bool
    {
        return $user->hasPermission('restore-lesson') || $user->hasRoles(['super-admin']);
    }

    public function forceDelete(User $user, Lesson $lesson): bool
    {
        return $user->hasPermission('force-delete-lesson') || $user->hasRoles(['super-admin']);
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermission('delete-any-lesson') || $user->hasRoles(['super-admin']);
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermission('restore-any-lesson') || $user->hasRoles(['super-admin']);
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermission('force-delete-any-lesson') || $user->hasRoles(['super-admin']);
    }
}
