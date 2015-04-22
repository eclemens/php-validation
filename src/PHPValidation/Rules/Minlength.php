<?php

namespace PHPValidation\Rules;

/**
 * Makes the element require a given minimum length.
 *
 * `minlength`
 */
class Minlength extends Base
{
    public $message = "Please enter at least %s characters.";

    /**
     * Makes the element require a given minimum length.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || $options <= strlen($value);
    }
}
