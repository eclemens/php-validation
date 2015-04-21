<?php

namespace PHPValidation\Rules;

/**
 * Makes the element require a given minimum.
 *
 * `min`
 */
class Min extends Base
{
    public $message = "Please enter a value greater than or equal to %s.";

    /**
     * Makes the element require a given minimum.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null)
    {
        return $this->validation->optional($value) || $options <= $value;
    }
}