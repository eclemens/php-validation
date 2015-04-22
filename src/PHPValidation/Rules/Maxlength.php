<?php

namespace PHPValidation\Rules;

/**
 * Makes the element require a given maxmimum length.
 *
 * http://jqueryvalidation.org/maxlength-method/
 *
 * `maxlength`
 */
class Maxlength extends Base
{
    public $message = "Please enter no more than {0} characters.";

    /**
     * Makes the element require a given maxmimum length.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || strlen($value) <= $options;
    }
}
