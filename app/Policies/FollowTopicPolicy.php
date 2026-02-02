<?php

namespace App\Policies;

use App\Models\FollowTopic;
use App\Models\User;

class FollowTopicPolicy
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
    public function delete(User $user, FollowTopic $followTopic): bool
    {
        return $user->id === $followTopic->user_id;
    }
}
