<?php

namespace Modules\Common\Transformers;

use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id ?? "",
            'title'         => $this->title ?? "",
            'path'          => $this->path ? url($this->path) : "",
            'created_at'    => $this->created_at->format('Y-m-d h:i A'),
        ];
    }
}
