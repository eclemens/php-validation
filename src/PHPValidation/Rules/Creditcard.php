<?php

namespace PHPValidation\Rules;

/**
 * Makes the element require a credit card number.
 *
 * http://jqueryvalidation.org/creditcard-method/
 * based on http://en.wikipedia.org/wiki/Luhn/
 *
 * `creditcard`
 */
class Creditcard extends Base
{
    public $message = "Please enter a valid credit card number.";

    /**
     * Makes the element require a credit card number.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        // accept only spaces, digits and dashes
        if (preg_match('/[^0-9 \-]+/', $value)) {
            return false;
        }

        $nCheck = 0;
        $bEven  = false;

        $value = preg_replace('/\D/', '', $value);

        // Basing min and max length on
        // http://developer.ean.com/general_info/Valid_Credit_Card_Types
        if (strlen($value) < 13 || strlen($value) > 19) {
            return false;
        }

        for ($n = strlen($value) - 1; $n >= 0; $n--) {
            $cDigit = $value{$n};
            $nDigit = intval($cDigit, 10);
            if ($bEven) {
                if (($nDigit *= 2) > 9) {
                    $nDigit -= 9;
                }
            }
            $nCheck += $nDigit;
            $bEven = !$bEven;
        }

        return ($nCheck % 10) === 0;
    }
}
