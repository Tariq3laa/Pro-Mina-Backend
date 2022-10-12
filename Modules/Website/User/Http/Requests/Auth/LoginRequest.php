<?php

namespace Modules\Website\User\Http\Requests\Auth;

use Modules\Common\Http\Requests\ResponseShape;

class LoginRequest extends ResponseShape
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'         => 'required|email:rfc,dns|exists:clients,email',
            'password'      => 'required|min:6'
        ];
    }
}
