<?php

namespace App\Rule;

use App\MyClasses\CodeMelli;
use Illuminate\Contracts\Validation\Rule;

class PhoneNumberValidator implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(preg_match("/^09[0-9]{9}$/", $value)) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'شماره موبایل اشتباه است.';
    }
}

