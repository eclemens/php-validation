<?php

namespace PHPValidation\Rules;

/**
 * Requires the element to be the same as another one.
 *
 * http://jqueryvalidation.org/equalTo-method/
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
    public function validate($value, $options = null, $field = null)
    {
        $param = $this->validation->param($options);
        return isset($param) && $value === $param;
    }
}
