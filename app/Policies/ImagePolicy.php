<?php

namespace App\Policies;

use App\Models\Image;
use App\Models\User;

class ImagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Image $image): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Created via Post, check PostPolicy in controller
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Image $image): bool
    {
        // Delegate to Post policy
        // If user can update the post, they can update its images
        return $user->can('update', $image->post);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Image $image): bool
    {
        // Delegate to Post policy
        // If user can delete the post (or is owner), they can delete its images
        return $user->can('delete', $image->post);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Image $image): bool
    {
        return $user->can('restore', $image->post);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Image $image): bool
    {
        return $user->can('forceDelete', $image->post);
    }
}
