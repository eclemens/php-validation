<?php

namespace PHPValidation\Rules;

/**
 * Makes the element require a valid url
 *
 * http://jqueryvalidation.org/url-method/
 *
 * `url`
 */
class Url extends Base
{
    public $message = "Please enter a valid URL.";

    /**
     * Makes the element require a valid url
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || filter_var($value, FILTER_VALIDATE_URL);
    }
}
