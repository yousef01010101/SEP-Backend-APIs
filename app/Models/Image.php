<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'post_id',
        'image_url',
    ];

    protected $appends = ['full_image_url'];

    public function getFullImageUrlAttribute()
    {
        return asset($this->image_url);
    }

    public function Post()
    {
        return $this->belongsTo(Post::class);
    }
}
