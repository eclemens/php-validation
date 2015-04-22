<?php

namespace PHPValidation\Rules;

/**
 * Makes the element require an ISO date.
 *
 * http://jqueryvalidation.org/dateISO-method/
 *
 * `dateISO`
 */
class DateISO extends Base
{
    public $message = "Please enter a valid date ( ISO ).";

    /**
     * Makes the element require an ISO date.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || preg_match('/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/', $value);
    }
}
