<?php

namespace App\Policies;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SubjectPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view-any-subject') || $user->hasRoles(['super-admin']);
    }

    public function view(User $user, Subject $subject): bool
    {
        return $user->hasPermission('view-subject') || $user->hasRoles(['super-admin']);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create-subject') || $user->hasRoles(['super-admin']);
    }

    public function update(User $user, Subject $subject): bool
    {
        return $user->hasPermission('update-subject') || $user->hasRoles(['super-admin']);
    }

    public function delete(User $user, Subject $subject): bool
    {
        return $user->hasPermission('delete-subject') || $user->hasRoles(['super-admin']);
    }

    public function restore(User $user, Subject $subject): bool
    {
        return $user->hasPermission('restore-subject') || $user->hasRoles(['super-admin']);
    }

    public function forceDelete(User $user, Subject $subject): bool
    {
        return $user->hasPermission('force-delete-subject') || $user->hasRoles(['super-admin']);
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermission('delete-any-subject') || $user->hasRoles(['super-admin']);
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermission('restore-any-subject') || $user->hasRoles(['super-admin']);
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermission('force-delete-any-subject') || $user->hasRoles(['super-admin']);
    }
}
