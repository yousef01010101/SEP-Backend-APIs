<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowTopic extends Model
{
    protected $fillable = ['user_id', 'topic_id'];
}
