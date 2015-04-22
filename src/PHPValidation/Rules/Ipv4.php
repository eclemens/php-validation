<?php

namespace PHPValidation\Rules;

/**
 * `ipv4`
 */
class Ipv4 extends Base
{
    public $message = "Please enter a valid IP v4 address.";

    /**
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }
}
