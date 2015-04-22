<?php

namespace PHPValidation\Rules;

/**
 * `letterswithbasicpunc`
 */
class Letterswithbasicpunc extends Base
{
    public $message = "Letters or punctuation only please.";

    /**
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || preg_match('/^[a-z\-.,()\'"\s]+$/i', $value);
    }
}
