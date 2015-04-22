<?php

namespace PHPValidation\Rules;

/**
 * Makes the element require a decimal number.
 *
 * http://jqueryvalidation.org/number-method/
 *
 * `number`
 */
class Number extends Base
{
    public $message = "Please enter a valid number.";

    /**
     * Makes the element require a decimal number.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || is_numeric($value);
    }
}
