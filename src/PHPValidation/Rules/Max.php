<?php

namespace PHPValidation\Rules;

/**
 * Makes the element require a given maximum.
 *
 * `max`
 */
class Max extends Base
{
    public $message = "Please enter a value less than or equal to %s.";

    /**
     * Makes the element require a given maximum.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null)
    {
        return $this->validation->optional($value) || $value <= $options;
    }
}
