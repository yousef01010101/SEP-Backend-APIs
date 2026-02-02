<?php

namespace App\Policies;

use App\Models\ReportPost;
use App\Models\User;

class ReportPostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isOwner();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ReportPost $reportPost): bool
    {
        return $user->isOwner();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return ! $user->isOwner(); // Only regular users can report a post
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ReportPost $reportPost): bool
    {
        return $user->isOwner();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ReportPost $reportPost): bool
    {
        return $user->isOwner();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ReportPost $reportPost): bool
    {
        return $user->isOwner();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ReportPost $reportPost): bool
    {
        return $user->isOwner();
    }

    /**
     * Determine whether the user can approve the report.
     */
    public function approve(User $user, ReportPost $reportPost): bool
    {
        return $user->isOwner();
    }
}
