<?php
declare(strict_types=1);

namespace ArtisanCloud\Commentable\Http\Requests;

use App\Models\Tenants\Comment;
use ArtisanCloud\Commentable\CommentService;
use ArtisanCloud\SaaSFramework\Exceptions\BaseException;
use ArtisanCloud\SaaSFramework\Http\Requests\RequestBasic;
use Illuminate\Validation\Rule;

class RequestCommentReadItem extends RequestBasic
{
    protected CommentService $commentService;

    function __construct(CommentService $commentService)
    {
        parent::__construct();

        $this->commentService = $commentService;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $comment = CommentService::GetBy(['id'=>$this->input('id')]);
//        dd($comment);
        if(is_null($comment)){
            throw new BaseException(API_ERR_CODE_COMMENT_NOT_EXIST);
        }

        $this->getInputSource()->set('comment', $comment);

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => [
                'required',
                'int'
            ]
        ];
    }

    public function messages()
    {
        return [
            'id.required' => __("{$this->m_module}.required"),
            'id.int' => __("{$this->m_module}.int"),
//            'id.exists' => __("{$this->m_module}.exists"),
        ];
    }

}
