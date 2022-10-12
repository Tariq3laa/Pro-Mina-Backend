<?php

namespace Modules\Website\User\Http\Requests\Auth;

use Modules\Common\Rules\EnglishNameRule;
use Modules\Common\Http\Requests\ResponseShape;

class RegisterRequest extends ResponseShape
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'          => ['required','min:2', new EnglishNameRule(true)],
            'email'         => 'required|email:rfc,dns|unique:clients,email',
            'password'      => 'required|min:6|confirmed',
        ];
    }
}
