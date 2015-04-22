<?php

namespace PHPValidation\Rules;

/**
 * `lettersonly`
 */
class Lettersonly extends Base
{
    public $message = "Letters only please.";

    /**
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || preg_match('/^[a-z]+$/i', $value);
    }
}
