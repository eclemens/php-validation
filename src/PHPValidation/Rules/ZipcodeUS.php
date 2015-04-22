<?php

namespace PHPValidation\Rules;

/**
 * `zipcodeUS`
 */
class ZipcodeUS extends Base
{
    public $message = "The specified US ZIP Code is invalid.";

    /**
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || preg_match('/^\d{5}(-\d{4})?$/', $value);
    }
}
