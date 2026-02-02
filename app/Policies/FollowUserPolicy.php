<?php

namespace App\Policies;

use App\Models\FollowUser;
use App\Models\User;

class FollowUserPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FollowUser $followUser): bool
    {
        return $user->id === $followUser->follower_id;
    }
}
