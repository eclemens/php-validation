<?php

namespace PHPValidation\Rules;

/**
 * `minWords`
 */
class MinWords extends Base
{
    public $message = "Please enter at least %s words.";

    /**
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null)
    {
        return $this->validation->optional($value) || preg_match_all('/\b\w+\b/', strip_tags($value)) >= $options;
    }
}
