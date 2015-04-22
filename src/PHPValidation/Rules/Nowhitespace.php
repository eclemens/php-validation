<?php

namespace PHPValidation\Rules;

/**
 * `nowhitespace`
 */
class Nowhitespace extends Base
{
    public $message = "No white space please.";

    /**
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || preg_match('/^\S+$/i', $value);
    }
}
