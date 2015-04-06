<?php

class Validation
{
    const RULE_REQUIRED    = 'required';    // Makes the element required.
    const RULE_REMOTE      = 'remote';      // Requests a resource to check the element for validity.
    const RULE_MINLENGTH   = 'minlength';   // Makes the element require a given minimum length.
    const RULE_MAXLENGTH   = 'maxlength';   // Makes the element require a given maxmimum length.
    const RULE_RANGELENGTH = 'rangelength'; // Makes the element require a given value range.
    const RULE_MIN         = 'min';         // Makes the element require a given minimum.
    const RULE_MAX         = 'max';         // Makes the element require a given maximum.
    const RULE_RANGE       = 'range';       // Makes the element require a given value range.
    const RULE_EMAIL       = 'email';       // Makes the element require a valid email
    const RULE_URL         = 'url';         // Makes the element require a valid url
    const RULE_DATE        = 'date';        // Makes the element require a date.
    const RULE_DATE_ISO    = 'dateISO';     // Makes the element require an ISO date.
    const RULE_NUMBER      = 'number';      // Makes the element require a decimal number.
    const RULE_DIGITS      = 'digits';      // Makes the element require digits only.
    const RULE_CREDITCARD  = 'creditcard';  // Makes the element require a credit card number.
    const RULE_EQUAL_TO    = 'equalTo';     // Requires the element to be the same as another one.

    protected $messages = [
        self::RULE_REQUIRED    => "This field is required.",
        self::RULE_REMOTE      => "Please fix this field.",
        self::RULE_EMAIL       => "Please enter a valid email address.",
        self::RULE_URL         => "Please enter a valid URL.",
        self::RULE_DATE        => "Please enter a valid date.",
        self::RULE_DATE_ISO    => "Please enter a valid date ( ISO ).",
        self::RULE_NUMBER      => "Please enter a valid number.",
        self::RULE_DIGITS      => "Please enter only digits.",
        self::RULE_CREDITCARD  => "Please enter a valid credit card number.",
        self::RULE_EQUAL_TO    => "Please enter the same value again.",
        self::RULE_MAXLENGTH   => "Please enter no more than %s characters.",
        self::RULE_MINLENGTH   => "Please enter at least %s characters.",
        self::RULE_RANGELENGTH => "Please enter a value between %s and %s characters long.",
        self::RULE_RANGE       => "Please enter a value between %s and %s.",
        self::RULE_MAX         => "Please enter a value less than or equal to %s.",
        self::RULE_MIN         => "Please enter a value greater than or equal to %s."
    ];

    protected $methods = [];
    protected $rules   = [];
    protected $ignore  = [];

    protected $params  = [];
    protected $errors  = [];

    public function __construct() {}

    /**
     * Key/value pairs defining custom messages.
     *
     * Key is the name of a field, value the message to display for that element.
     *
     * Instead of a plain message, another map with specific messages for each rule
     * can be used.
     * Overrides the title attribute of an element or the default message for
     * the method (in that order).
     * Each message can be a String or a Callback.
     * The callback is called with the rule's parameters as the first argument
     * and the value as the second, and must return a String to display as the message.
     *
     * @param  array $messages
     */
    public function messages(array $messages)
    {
        $this->messages = array_merge($this->messages, $messages);
    }

    /**
     * Key/value pairs defining custom rules.
     *
     * Key is the name of a field, value is an object consisting of rule/parameter
     * pairs or a plain String. Can be combined with class/attribute/data rules.
     * Each rule can be specified as having a depends-property to apply the rule
     * only in certain conditions.
     *
     * @param  array  $rules
     */
    public function rules(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * Elements to ignore when validating, simply filtering them out.
     *
     * @param  array   $fields
     */
    public function ignore(array $fields)
    {
        $this->ignore = $fields;
    }

    /**
     * Add a custom validation method.
     * It must consist of a name, a lambda function and a default string message.
     *
     * @param string    $name
     * @param function  $method
     * @param string    $message
     */
    public function addMethod($name, $method, $message = null)
    {
        $this->methods[$name]  = $method;
        $this->messages[$name] = $message ?: @$this->messages[$name] ?: null;
    }

    /**
     * Returns the list of message errors found
     *
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * Validates an array of paramaters agains the defined rules
     *
     * @param  array $params
     *
     * @return boolean
     */
    public function valid(array $params)
    {
        $this->params = $params;
        $this->errors = [];

        // Cycle rule sets
        foreach ($this->rules as $name => $rules) {
            $value = isset($this->params[$name]) ? $this->params[$name] : null;

            // Normalize rule
            if (is_scalar($rules)) {
                if (is_string($rules)) {
                    $rules = [$rules => true];
                } else {
                    continue;
                }
            }

            // Cycle rules
            foreach ($rules as $rule => $options) {
                // Normalize rule
                if (is_numeric($rule) && is_string($options)) {
                    $rule    = $options;
                    $options = true;
                }

                // Skip if false
                if (is_bool($options) && !$options) {
                    continue;
                }

                // Validate
                if (!$this->check($value, $rule, $options)) {
                    // Build error message
                    $this->errors[$name] = $this->message($value, $rule, $options);
                    break;
                }
            }
        }

        return !(bool) $this->errors;
    }

    /**
     * Call to check the required validator
     *
     * @param  mixed   $value
     * @param  string  $rule
     * @param  mixed   $options
     *
     * @return boolean
     */
    public function check($value, $rule, $options = null)
    {
        $callback = 'rule' . ucfirst($rule);
        if (method_exists($this, $callback)) {
            return call_user_func([$this, $callback], $value, $options);
        } else {
            return $this->custom($value, $rule, $options);
        }
    }

    /**
     * Build the error message
     *
     * @param  mixed  $value
     * @param  string $rule
     * @param  mixed  $options
     *
     * @return string
     */
    protected function message($value, $rule, $options = null)
    {
        $message;

        if (isset($this->messages[$rule])) {
            if (is_string($this->messages[$rule])) {
                if (is_array($options)) {
                    $message = vsprintf($this->messages[$rule], $options);
                } else {
                    $message = sprintf($this->messages[$rule], $options);
                }

                if (!$message) {
                    $message = $this->messages[$rule];
                }
            } elseif (is_callable($this->messages[$rule])) {
                $message = $this->messages[$rule]($options, $value);
            }
        }

        return is_string($message) ? $message : '';
    }

    /*=============================
    =            Rules            =
    =============================*/

    /**
     * Check if optional field.
     *
     * @param  mixed $value
     *
     * @return boolean
     */
    protected function optional($value)
    {
        if (is_string($value)) {
            $value = preg_replace('/\r/', '', $value);
        }

        return !$this->ruleRequired($value);
    }

    /**
     * Check if dependency is met.
     *
     * @param  mixed $options
     * @param  mixed $value
     *
     * @return boolean
     */
    protected function depend($options, $value = null) {
        if (is_bool($options)) {
            return $options;
        } elseif (is_string($options)) {
            return isset($his->params[$options]);
        } elseif (is_callable($options)) {
            return (bool) $options($value);
        }

        return true;
    }

    protected function custom($value, $rule, $options = null)
    {
        if (isset($this->methods[$rule]) && is_callable($this->methods[$rule])) {
            return $this->optional($value) || $this->methods[$rule]($value, $options);
        }

        return false;
    }

    /**
     * Makes the element required.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    protected function ruleRequired($value, $options = null) {

        if (!$this->depend($options, $value)) {
            return true;
        }

        return strlen(trim($value)) > 0;
    }

    /**
     * Requests a resource to check the element for validity.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    protected function ruleRemote($value, $options = null)
    {
        if (is_callable($options)) {
            return $this->optional($value) || $options($value);
        }

        return false;
    }

    /**
     * Makes the element require a given minimum length.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    protected function ruleMinlength($value, $options = null)
    {
        return $this->optional($value) || $options <= strlen($value);
    }

    /**
     * Makes the element require a given maxmimum length.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    protected function ruleMaxlength($value, $options = null)
    {
        return $this->optional($value) || strlen($value) <= $options;
    }

    /**
     * Makes the element require a given value range.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    protected function ruleRangelength($value, $options = null)
    {
        return $this->optional($value) || $options[0] <= strlen($value) && strlen($value) <= $options[1];
    }

    /**
     * Makes the element require a given minimum.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    protected function ruleMin($value, $options = null)
    {
        return $this->optional($value) || $options <= $value;
    }

    /**
     * Makes the element require a given maximum.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    protected function ruleMax($value, $options = null)
    {
        return $this->optional($value) || $value <= $options;
    }

    /**
     * Makes the element require a given value range.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    protected function ruleRange($value, $options = null)
    {
        return $this->optional($value) || $options[0] <= $value && $value <= $options[1];
    }

    /**
     * Makes the element require a valid email
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    protected function ruleEmail($value, $options = null)
    {
        return $this->optional($value) || filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Makes the element require a valid url
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    protected function ruleUrl($value, $options = null)
    {
        return $this->optional($value) || filter_var($value, FILTER_VALIDATE_URL);
    }

    /**
     * Makes the element require a date.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    protected function ruleDate($value, $options = null)
    {
        $time = strtotime($value);
        return $this->optional($value) || is_numeric($time) && $time != -1;
    }

    /**
     * Makes the element require an ISO date.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    protected function ruleDateISO($value, $options = null)
    {
        return $this->optional($value) || preg_match('/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/', $value);
    }

    /**
     * Makes the element require a decimal number.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    protected function ruleNumber($value, $options = null)
    {
        return $this->optional($value) || is_numeric($value);
    }

    /**
     * Makes the element require digits only.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    protected function ruleDigits($value, $options = null)
    {
        return $this->optional($value) || preg_match('/^\d+$/', $value);
    }

    /**
     * Makes the element require a credit card number.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    protected function ruleCreditcard($value, $options = null)
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

    /**
     * Requires the element to be the same as another one.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    protected function ruleEqualTo($value, $options = null)
    {
        return isset($this->params[$options]) && $value === $this->params[$options];
    }

}
