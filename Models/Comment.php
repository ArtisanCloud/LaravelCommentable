<?php
declare(strict_types=1);

namespace ArtisanCloud\Commentable\Models;

use ArtisanCloud\SaaSFramework\Models\ArtisanCloudModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends ArtisanCloudModel
{
    protected $connection = 'pgsql';
    const TABLE_NAME = 'comments';
    protected $table = self::TABLE_NAME;

    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'type',
        'is_public',
        'commentable_id',
        'commentable_type',
        'created_by',
        'reply_comment_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
    ];

    const TYPE_NORMAL = 1;
    const TYPE_REPLY = 2;

    const ARRAY_TYPE = [
        self::TYPE_NORMAL,
        self::TYPE_REPLY,
    ];


    /**--------------------------------------------------------------- relation functions  -------------------------------------------------------------*/
    /**
     * Get the owning commentable model.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Get replies.
     *
     * @return HasMany
     *
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'reply_comment_id');
    }

}
