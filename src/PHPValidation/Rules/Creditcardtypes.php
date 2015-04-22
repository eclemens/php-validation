<?php

namespace PHPValidation\Rules;

/**
 * `creditcardtypes`
 */
class Creditcardtypes extends Base
{
    public $message = "Please enter a valid credit card number.";

    /**
     * NOTICE: Modified version of Castle.Components.Validator.CreditCardValidator
     * Redistributed under the the Apache License 2.0 at http://www.apache.org/licenses/LICENSE-2.0
     * Valid Types: mastercard, visa, amex, dinersclub, enroute, discover, jcb, unknown, all (overrides all other settings)
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        if (preg_match('/[^0-9\-]+/', $value)) {
            return false;
        }

        $value = preg_replace('/\D/', '', $value);

        $validTypes = 0x0000;

        if (isset($options['mastercard']) || in_array('mastercard', $options)) {
            $validTypes |= 0x0001;
        }
        if (isset($options['visa']) || in_array('visa', $options)) {
            $validTypes |= 0x0002;
        }
        if (isset($options['amex']) || in_array('amex', $options)) {
            $validTypes |= 0x0004;
        }
        if (isset($options['dinersclub']) || in_array('dinersclub', $options)) {
            $validTypes |= 0x0008;
        }
        if (isset($options['enroute']) || in_array('enroute', $options)) {
            $validTypes |= 0x0010;
        }
        if (isset($options['discover']) || in_array('discover', $options)) {
            $validTypes |= 0x0020;
        }
        if (isset($options['jcb']) || in_array('jcb', $options)) {
            $validTypes |= 0x0040;
        }
        if (isset($options['unknown']) || in_array('unknown', $options)) {
            $validTypes |= 0x0080;
        }
        if (isset($options['all']) || in_array('all', $options)) {
            $validTypes = 0x0001 | 0x0002 | 0x0004 | 0x0008 | 0x0010 | 0x0020 | 0x0040 | 0x0080;
        }
        if ($validTypes & 0x0001 && preg_match('/^(5[12345])/', $value)) {
            //mastercard
            return strlen($value) === 16;
        }
        if ($validTypes & 0x0002 && preg_match('/^(4)/', $value)) {
            //visa
            return strlen($value) === 16;
        }
        if ($validTypes & 0x0004 && preg_match('/^(3[47])/', $value)) {
            //amex
            return strlen($value) === 15;
        }
        if ($validTypes & 0x0008 && preg_match('/^(3(0[012345]|[68]))/', $value)) {
            //dinersclub
            return strlen($value) === 14;
        }
        if ($validTypes & 0x0010 && preg_match('/^(2(014|149))/', $value)) {
            //enroute
            return strlen($value) === 15;
        }
        if ($validTypes & 0x0020 && preg_match('/^(6011)/', $value)) {
            //discover
            return strlen($value) === 16;
        }
        if ($validTypes & 0x0040 && preg_match('/^(3)/', $value)) {
            //jcb
            return strlen($value) === 16;
        }
        if ($validTypes & 0x0040 && preg_match('/^(2131|1800)/', $value)) {
            //jcb
            return strlen($value) === 15;
        }
        if ($validTypes & 0x0080) {
            //unknown
            return true;
        }

        return false;
    }
}
