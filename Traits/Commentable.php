<?php

namespace ArtisanCloud\Commentable\Traits;


use ArtisanCloud\Commentable\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Commentable
{

    /**
     * Get all of the post's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
