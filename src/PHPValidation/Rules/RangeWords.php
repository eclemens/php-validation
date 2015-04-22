<?php

namespace PHPValidation\Rules;

/**
 * `rangeWords`
 */
class RangeWords extends Base
{
    public $message = "Please enter between {0} and {1} words.";

    /**
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        $valueStripped = strip_tags($value);
        $regex         = '/\b\w+\b/';
        return $this->validation->optional($value) || preg_match_all($regex, $valueStripped) >= $options[0] && preg_match_all($regex, $valueStripped) <= $options[1];
    }
}
