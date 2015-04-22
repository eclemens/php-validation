<?php

namespace PHPValidation\Rules;

/**
 * `alphanumeric`
 */
class Alphanumeric extends Base
{
    public $message = "Letters, numbers, and underscores only please.";

    /**
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || preg_match('/^\w+$/i', $value);
    }
}
