<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements hasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'content',
//        'image',
        'category_id',
        'user_id',
        'published_at',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->width(400)
            ->nonQueued();
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
    }

    public function readTime($wordsPerMinute = 100) {
        $wordCount = str_word_count(strip_tags($this->content));
        $minutes = ceil($wordCount / $wordsPerMinute);
        return max(1, $minutes);
    }

    public function isLikedBy(?User $user): bool
    {
        if(!$user) return false;

        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
