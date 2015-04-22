<?php

namespace PHPValidation\Rules;

/**
 * Makes the element require a given minimum length.
 *
 * http://jqueryvalidation.org/minlength-method/
 *
 * `minlength`
 */
class Minlength extends Base
{
    public $message = "Please enter at least {0} characters.";

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
