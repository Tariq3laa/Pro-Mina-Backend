<?php

namespace Modules\Common\Http\Requests;

use App\Http\Requests\ResponseShape;

class ImportRequest extends ResponseShape
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'selectedFile' => 'required|mimes:csv,xlsx,xls',
        ];
    }
}
