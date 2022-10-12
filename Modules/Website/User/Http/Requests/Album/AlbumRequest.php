<?php

namespace Modules\Website\User\Http\Requests\Album;

use Modules\Common\Rules\EnglishNameRule;
use Modules\Common\Http\Requests\ResponseShape;

class AlbumRequest extends ResponseShape
{
    public function all($keys = null)
    {
        $data = parent::all($keys);
        $data['album'] =  $this->route('album');
        return $data;
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'PUT': 
            case 'POST': {
                    return [
                        'name'          => ['required','min:2', new EnglishNameRule(true)]
                    ];
                }
            case 'GET': 
            case 'DELETE': {
                    return [
                        'album'            => 'required|exists:albums,id'
                    ];
                }
            default:
                break;
        }
    }
}
