<?php

namespace PHPValidation\Rules;

/**
 * Makes the element require a given value range.
 *
 * http://jqueryvalidation.org/range-method/
 *
 * `range`
 */
class Range extends Base
{
    public $message = "Please enter a value between {0} and {1}.";

    /**
     * Makes the element require a given value range.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        return $this->validation->optional($value) || $options[0] <= $value && $value <= $options[1];
    }
}
