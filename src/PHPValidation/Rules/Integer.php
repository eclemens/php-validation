<?php

namespace PHPValidation\Rules;

/**
 * `integer`
 */
class Integer extends Base
{
    public $message = "A positive or negative non-decimal number please.";

    /**
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || filter_var($value, FILTER_VALIDATE_INT);
    }
}
