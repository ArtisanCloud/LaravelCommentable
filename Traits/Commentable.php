<?php

namespace ArtisanCloud\Commentable\Traits;

use ArtisanCloud\Commentable\Models\Tag;
use ArtisanCloud\Commentable\Models\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use InvalidArgumentException;

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
