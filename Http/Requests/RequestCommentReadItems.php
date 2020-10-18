<?php
declare(strict_types=1);

namespace ArtisanCloud\Commentable\Http\Requests;

use ArtisanCloud\Commentable\Models\Tenants\Comment;
use ArtisanCloud\Commentable\CommentService;
use ArtisanCloud\SaaSFramework\Exceptions\BaseException;
use ArtisanCloud\SaaSFramework\Http\Requests\RequestBasic;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RequestCommentReadItems extends RequestBasic
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
        $strModelsNameSpace = 'App\\Models\\Tenants\\';
        $objectClass = $strModelsNameSpace . Str::ucfirst($this->input('commentableType'));
        $object = $objectClass::where('uuid', $this->input('commentableId'))->first();
//        dd($object);
        if (is_null($object)) {
            throw new BaseException(API_ERR_CODE_OBJECT_NOT_EXIST);
        }

        $this->getInputSource()->set('object', $object);

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
            'commentableId' => [
                'required',
                'uuid'
            ],
            'commentableType' => [
                'required',
                'string'
            ]
        ];
    }

    public function messages()
    {
        return [
            'commentableId.required' => __("{$this->m_module}.required"),
            'commentableId.uuid' => __("{$this->m_module}.uuid"),
            'commentableType.required' => __("{$this->m_module}.required"),
            'commentableType.string' => __("{$this->m_module}.string"),
//            'commentUuid.exists' => __("{$this->m_module}.exists"),
        ];
    }

}
