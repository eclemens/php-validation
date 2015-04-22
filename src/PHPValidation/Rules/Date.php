<?php

namespace PHPValidation\Rules;

/**
 * Makes the element require a date.
 *
 * http://jqueryvalidation.org/date-method/
 *
 * `date`
 */
class Date extends Base
{
    public $message = "Please enter a valid date.";

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
        $time = strtotime($value);
        return $this->validation->optional($value) || (is_numeric($time) && $time != -1);
    }
}
