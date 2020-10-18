<?php

namespace ArtisanCloud\Commentable\Http\Resources;

use ArtisanCloud\SaaSFramework\Http\Resources\BasicResource;
use ArtisanCloud\SaaSFramework\Http\Resources\LandlordResource;


class CommentResource extends BasicResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $arrayTransformedKeys = transformArrayKeysToCamel($this->resource->getAttributes());
//        dd($arrayTransformedKeys);

        $arrayTransformedKeys["replies"] = new CommentResource($this->whenLoaded('replies'));

        return $arrayTransformedKeys;

    }
}
