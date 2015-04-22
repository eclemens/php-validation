<?php

namespace PHPValidation\Rules;

/**
 * Makes the element require a valid email.
 *
 * http://jqueryvalidation.org/email-method/
 *
 * `email`
 */
class Email extends Base
{
    public $message = "Please enter a valid email address.";

    /**
     * Makes the element require a valid email
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
