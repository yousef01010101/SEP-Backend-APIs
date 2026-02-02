<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'topic_id', 'title', 'content', 'image_id', 'video_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

   public function images()
   {
       return $this->hasMany(Image::class, 'post_id');
   }

   public function videos()
   {
       return $this->hasMany(Video::class, 'post_id');
   }
    public function reports()
    {
        return $this->hasMany(ReportPost::class, 'post_id');
    }
}
