<?php

namespace PHPValidation\Rules;

/**
 * `ziprange`
 */
class Ziprange extends Base
{
    public $message = "Your ZIP-code must be in the range 902xx-xxxx to 905xx-xxxx.";

    /**
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || preg_match('/^90[2-5]\d{2}-\d{4}$/', $value);
    }
}
