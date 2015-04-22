<?php

namespace PHPValidation\Rules;

/**
 * Makes the element required.
 *
 * http://jqueryvalidation.org/required-method/
 *
 * `required`
 */
class Required extends Base
{
    public $message = "This field is required.";

    /**
     * Makes the element required.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        if (!$this->validation->depend($options, $value)) {
            return true;
        }

        return strlen(trim($value)) > 0;
    }
}
