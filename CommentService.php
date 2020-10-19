<?php

namespace ArtisanCloud\Commentable;

use App\Models\Tenants\Workzone;
use ArtisanCloud\Commentable\Models\Comment;
use ArtisanCloud\SaaSFramework\Services\ArtisanCloudService;

/**
 * Class CommentService
 * @package App\Services\CommentService
 */
class CommentService extends ArtisanCloudService
{
    //
    //
    public function __construct()
    {
        parent::__construct();
        $this->m_model = new Comment();
    }

    /**
     * make a model
     *
     * @param array $arrayData
     *
     * @return mixed
     */
    public function makeBy(array $arrayData)
    {
        $this->m_model = $this->m_model->create(
            [
                'created_by' => $arrayData['user_uuid'],
                'content' => $arrayData['content'],
                'type' => $arrayData['type'],
                'is_public' => $arrayData['is_public'],
                'commentable_id' => $arrayData['commentable_id'],
                'commentable_type' => $arrayData['commentable_type'],
                'reply_comment_id' => $arrayData['reply_comment_id'] ?? 0,
            ]
        );
//        dd($this->m_model);
        return $this->m_model;
    }

    /**
     * create list by
     *
     * @param Workzone $workzone
     *
     * @return mixed
     */
    public function getListBy(Workzone $workzone)
    {
        $releases = $workzone->epics()->get();
//        dd($releases);
        return $releases;
    }
}
