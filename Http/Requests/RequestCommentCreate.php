<?php
declare(strict_types=1);

namespace ArtisanCloud\Commentable\Http\Requests;


use App\Models\Tenants\Comment;
use App\Services\ReleaseService\ReleaseService;
use ArtisanCloud\SaaSFramework\Exceptions\BaseException;
use ArtisanCloud\SaaSFramework\Http\Requests\RequestBasic;
use ArtisanCloud\SaaSFramework\Services\ArtisanCloudService;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RequestCommentCreate extends RequestBasic
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        $strModelsNameSpace = config('artisancloud.framework.model.namespace');
        $objectClass = $strModelsNameSpace . Str::ucfirst($this->input('commentableType'));
        $object = $objectClass::where('uuid', $this->input('commentableId'))->first();
//        dd($object);
        if (is_null($object)) {
            throw new BaseException(API_ERR_CODE_OBJECT_NOT_EXIST);
        }
        $this->getInputSource()->set('commentable_type', $objectClass);
        $this->getInputSource()->set('commentable', $object);

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
                'uuid',
            ],
            'commentableType' => [
                'required',
                'string',
            ],
            'replyCommentId' => [
                'nullable',
                'int',
            ],
            'content' => 'nullable|string|max:500',

        ];
    }

    public function messages()
    {
        return [
            'commentableId.string' => __("{$this->m_module}.string"),
            'commentableId.uuid' => __("{$this->m_module}.uuid"),
            'commentableType.required' => __("{$this->m_module}.required"),
            'commentableType.string' => __("{$this->m_module}.string"),
            'description.string' => __("{$this->m_module}.string"),
            'description.max' => __("{$this->m_module}.max"),

        ];
    }


}
