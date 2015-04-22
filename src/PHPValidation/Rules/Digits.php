<?php

namespace PHPValidation\Rules;

/**
 * Makes the element require digits only.
 *
 * http://jqueryvalidation.org/digits-method/
 *
 * `digits`
 */
class Digits extends Base
{
    public $message = "Please enter only digits.";

    /**
     * Makes the element require digits only.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || preg_match('/^\d+$/', $value);
    }
}
