<?php

namespace PHPValidation\Rules;

/**
 * Makes the element require a given minimum.
 *
 * http://jqueryvalidation.org/min-method/
 *
 * `min`
 */
class Min extends Base
{
    public $message = "Please enter a value greater than or equal to {0}.";

    /**
     * Makes the element require a given minimum.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || $options <= $value;
    }
}
