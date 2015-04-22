<?php

namespace PHPValidation\Rules;

/**
 * `time12h`
 */
class Time12h extends Base
{
    public $message = "Please enter a valid time in 12-hour am/pm format.";

    /**
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || preg_match('/^((0?[1-9]|1[012])(:[0-5]\d){1,2}(\ ?[AP]M))$/i', $value);
    }
}
