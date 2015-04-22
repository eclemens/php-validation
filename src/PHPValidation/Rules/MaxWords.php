<?php

namespace PHPValidation\Rules;

/**
 * `maxWords`
 */
class MaxWords extends Base
{
    public $message = "Please enter {0} words or less.";

    /**
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || preg_match_all('/\b\w+\b/', strip_tags($value)) <= $options;
    }
}
