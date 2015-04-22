<?php

namespace PHPValidation\Rules;

/**
 * `currency`
 */
class Currency extends Base
{
    public $message = "Please specify a valid currency.";

    /**
     * Validates currencies with any given symbols by @jameslouiz
     * Symbols can be optional or required. Symbols required by default
     *
     * Usage examples:
     *  currency: ["£", false] - Use false for soft currency validation
     *  currency: ["$", false]
     *  currency: ["RM", false] - also works with text based symbols such as "RM" - Malaysia Ringgit etc
     *
     *  <input class="currencyInput" name="currencyInput">
     *
     * Soft symbol checking
     *  currencyInput: {
     *     currency: ["$", false]
     *  }
     *
     * Strict symbol checking (default)
     *  currencyInput: {
     *     currency: "$"
     *     //OR
     *     currency: ["$", true]
     *  }
     *
     * Multiple Symbols
     *  currencyInput: {
     *     currency: "$,£,¢"
     *  }
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        $isParamString = is_string($options);
        $symbol        = $isParamString ? $options : $options[0];
        $soft          = $isParamString ? true : $options[1];
        $regex;

        $symbol = preg_replace('/,/', '', $symbol);
        $symbol = preg_quote($symbol);
        $symbol = $soft ? $symbol . "]" : $symbol . "]?";
        $regex  = "/^[" . $symbol . "([1-9]{1}[0-9]{0,2}(\,[0-9]{3})*(\.[0-9]{0,2})?|[1-9]{1}[0-9]{0,}(\.[0-9]{0,2})?|0(\.[0-9]{0,2})?|(\.[0-9]{1,2})?)$/";

        return $this->validation->optional($value) || preg_match($regex, $value);
    }
}
