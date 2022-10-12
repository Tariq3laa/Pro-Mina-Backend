<?php

namespace Modules\Common\Http\Requests;

use Modules\Common\Http\Requests\ResponseShape;

class UploadRequest extends ResponseShape
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'selectedFile' => 'required',
        ];
    }
}
