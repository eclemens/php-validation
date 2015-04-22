<?php

namespace PHPValidation\Rules;

/**
 * Requests a resource to check the element for validity.
 *
 * `callback`
 */
class Callback extends Base
{
    public $message = "Please fix this field.";

    /**
     * Requests a resource to check the element for validity.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        if (is_callable($options)) {
            return $this->validation->optional($value) || $options($value);
        }

        return false;
    }
}
