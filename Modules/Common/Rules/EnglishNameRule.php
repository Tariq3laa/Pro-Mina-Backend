<?php

namespace Modules\Common\Rules;

use Illuminate\Contracts\Validation\Rule;

class EnglishNameRule implements Rule
{
    private $msg = '';

    private $is_contain_number;

    public function __construct($is_contain_number = false)
    {
        $this->is_contain_number = $is_contain_number;
    }

    public function passes($attribute, $value)
    {
        if ($this->is_contain_number && !preg_match('/^[a-zA-Z0-9\s]*.$/', $value)) { // is used with product validation
            $this->msg = "The $attribute is invalid format";
            return false;
        } else if (!$this->is_contain_number && !preg_match('/^[a-zA-Z\s]*.$/', $value)) {
            $this->msg = "The $attribute is invalid format";
            return false;
        }
        return true;
    }

    public function message()
    {
        return $this->msg;
    }
}
