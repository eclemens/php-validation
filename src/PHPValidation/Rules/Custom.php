<?php

namespace PHPValidation\Rules;

/**
 * User added validator.
 *
 * `custom`
 */
class Custom extends Base
{
    public $message   = "Please enter a valid value.";
    public $validator;

    /**
     * Makes the element require a date.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null)
    {
        if (isset($this->validator) && is_callable($this->validator)) {
            return (bool) call_user_func($this->validator, $value, $options);
        }

        return false;
    }
}
