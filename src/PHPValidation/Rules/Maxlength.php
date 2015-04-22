<?php

namespace PHPValidation\Rules;

/**
 * Makes the element require a given maxmimum length.
 *
 * `maxlength`
 */
class Maxlength extends Base
{
    public $message = "Please enter no more than %s characters.";

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
