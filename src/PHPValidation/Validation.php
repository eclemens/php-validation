<?php
namespace PHPValidation;

class Validation
{
    protected $messages = [];

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
        if (!strlen(trim($name)) && !is_callable($method)) {
            return false;
        }

        $validator = new \PHPValidation\Rules\Custom($this);
        $validator->validator = $method;
        if (!is_null($message)) {
            $validator->message = $message;
        }

        $this->methods[$name]  = $validator;

        return true;
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
        if (!isset($this->methods[$rule])) {
            $name = str_replace('_', '', ucwords(str_replace('_', ' ', $rule)));
            $class     = '\\PHPValidation\\Rules\\' . $name;
            if (class_exists($class)) {
                $this->methods[$rule] = new $class($this);
            } else {
                throw new \Exception(sprintf("The rule \"%s\" doesn't exist", [$rule]), 1);
            }
        }

        if (isset($this->methods[$rule])) {
            return $this->methods[$rule]->validate($value, $options);
        }

        return false;
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
            $message = $this->messages[$rule];
        } elseif (isset($this->methods[$rule])) {
            $message = $this->methods[$rule]->message($options, $value);
        }

        if (is_callable($message)) {
            $message = $message($options, $value);
        }

        if (isset($message) && is_string($message)) {
            if (is_array($options)) {
                $message = @vsprintf($message, $options) ?: $message;
            } else {
                $message = @sprintf($message, $options) ?: $message;
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
    public function optional($value)
    {
        if (is_string($value)) {
            $value = preg_replace('/\r/', '', $value);
        }

        return !$this->check($value, 'required');
    }

    /**
     * Check if dependency is met.
     *
     * @param  mixed $options
     * @param  mixed $value
     *
     * @return boolean
     */
    public function depend($options, $value = null) {
        if (is_bool($options)) {
            return $options;
        } elseif (is_string($options)) {
            return isset($his->params[$options]);
        } elseif (is_callable($options)) {
            return (bool) $options($value);
        }

        return true;
    }

    public function param($name)
    {
        return @$this->params[$name];
    }
}
