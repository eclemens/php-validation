<?php

namespace PHPValidation\Rules;

/**
 * `time`
 */
class Time extends Base
{
    public $message = "Please enter a valid time, between 00:00 and 23:59.";

    /**
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || preg_match('/^([01]\d|2[0-3])(:[0-5]\d){1,2}$/', $value);
    }
}
