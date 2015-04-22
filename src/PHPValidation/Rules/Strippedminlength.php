<?php

namespace PHPValidation\Rules;

/**
 * `strippedminlength`
 */
class Strippedminlength extends Base
{
    public $message = "Please enter at least {0} characters.";

    /**
     * TODO check if value starts with <, otherwise don't try stripping anything
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return strlen(trim(strip_tags($value))) >= $options;
    }
}
