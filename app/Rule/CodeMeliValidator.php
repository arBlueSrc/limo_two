<?php

namespace App\Rule;

use App\MyClasses\CodeMelli;
use Illuminate\Contracts\Validation\Rule;

class CodeMeliValidator implements Rule
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
        $validator = new CodeMelli();
        return $validator->nationalCode($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'کدملی اشتباه است.';
    }
}
