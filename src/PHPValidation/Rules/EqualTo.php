<?php

namespace PHPValidation\Rules;

/**
 * Requires the element to be the same as another one.
 *
 * `equalTo`
 */
class EqualTo extends Base
{
    public $message = "Please enter the same value again.";

    /**
     * Requires the element to be the same as another one.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null)
    {
        $param = $this->validation->param($options);
        return isset($param) && $value === $param;
    }
}
