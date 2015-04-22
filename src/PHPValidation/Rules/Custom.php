<?php

namespace PHPValidation\Rules;

/**
 * User added rule.
 *
 * `custom`
 */
class Custom extends Base
{
    public $message = "Please enter a valid value.";
    public $method;

    /**
     * Makes the element require a date.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        if (isset($this->method) && is_callable($this->method)) {
            return (bool) call_user_func($this->method, $value, $options);
        }

        return false;
    }
}
