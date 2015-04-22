<?php

namespace PHPValidation\Rules;

/**
 * Makes the element require a given value range.
 *
 * http://jqueryvalidation.org/rangelength-method/
 *
 * `rangelength`
 */
class Rangelength extends Base
{
    public $message = "Please enter a value between {0} and {1} characters long.";

    /**
     * Makes the element require a given value range.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || $options[0] <= strlen($value) && strlen($value) <= $options[1];
    }
}
