<?php

namespace Modules\Website\User\Http\Requests\Album\Picture;

use Modules\Common\Rules\EnglishNameRule;
use Modules\Common\Http\Requests\ResponseShape;

class PictureRequest extends ResponseShape
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'                => ['required','min:2', new EnglishNameRule(true)],
            'selectedFile'         => 'required|max:25096|mimes:jpg,png,jpeg,gif',
        ];
    }
}
