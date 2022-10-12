<?php

namespace Modules\Website\User\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    public function toArray($request)
    {
        $method = request()->route()->getActionMethod();
        $result = [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
        ];
        if ($method == 'login' || $method == 'register') $result['access_token'] = $this->access_token;
        return $result;
    }
}
