<?php

namespace PHPValidation\Rules;

/**
 * Makes the element require a given value range.
 *
 * `rangelength`
 */
class Rangelength extends Base
{
    public $message = "Please enter a value between %s and %s characters long.";

    /**
     * Makes the element require a given value range.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null)
    {
        return $this->validation->optional($value) || $options[0] <= strlen($value) && strlen($value) <= $options[1];
    }
}
