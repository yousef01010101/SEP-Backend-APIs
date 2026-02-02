<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Post $post): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function store($user): bool
    {
        return $user instanceof User;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Post $post): bool
    {

        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Post $post): bool
    {
        if ($user->isOwner()) {
            return true;
        }

        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Post $post): bool
    {
        if ($user->isOwner()) {
            return true;
        }

        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Post $post): bool
    {
        if ($user->isOwner()) {
            return true;
        }

        return $user->id === $post->user_id;
    }
}
