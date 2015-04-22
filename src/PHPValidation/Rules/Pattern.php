<?php

namespace PHPValidation\Rules;

/**
 * `pattern`
 */
class Pattern extends Base
{
    public $message = "Invalid format.";

    /**
     * Return true if the field value matches the given format RegExp
     *
     * @example $.validator.methods.pattern("AR1004",element,/^AR\d{4}$/)
     * @result true
     *
     * @example $.validator.methods.pattern("BR1004",element,/^AR\d{4}$/)
     * @result false
     *
     * @name $.validator.methods.pattern
     * @type Boolean
     * @cat Plugins/Validate/Methods
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        if ($this->validation->optional($value)) {
            return true;
        }

        if (is_string($options)) {
            $options = "/^(?:" . $options . ")$/";
        }

        return preg_match($options, $value);
    }
}
