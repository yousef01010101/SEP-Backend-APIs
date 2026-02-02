<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'post_id',
        'video_url',
    ];

    protected $appends = ['full_video_url'];

    public function getFullVideoUrlAttribute()
    {
        return asset($this->video_url);
    }

    public function Post()
    {
        return $this->belongsTo(Post::class);
    }
}
