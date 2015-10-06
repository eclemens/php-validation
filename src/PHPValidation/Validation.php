<?php
namespace PHPValidation;

class Validation
{
    protected $messages = [];

    protected $methods = [];
    protected $rules   = [];

    protected $params = [];
    protected $errors = [];

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
        $this->messages = array_replace_recursive($this->messages, $messages);
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
     * Defining custom rule.
     *
     * Rules is an object consisting of rule/parameter
     * pairs or a plain String. Can be combined with class/attribute/data rules.
     * Each rule can be specified as having a depends-property to apply the rule
     * only in certain conditions.
     *
     * @param  string $name
     * @param  array  $rules
     */
    public function rule($name, $rules)
    {
        $this->rules[$name] = $rules;
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
        if (!strlen(trim($name)) || !is_callable($method)) {
            return false;
        }

        $rule         = new \PHPValidation\Rules\Custom($this);
        $rule->method = $method;
        if (!is_null($message)) {
            $rule->message = $message;
        }

        $this->methods[$name] = $rule;

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
        // Initialize
        $this->params = $params;
        $this->errors = [];

        // Cycle rule sets
        foreach ($this->rules as $field => $rules) {
            // Field value
            $value = isset($this->params[$field]) ? $this->params[$field] : null;

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
                if (!$this->check($value, $rule, $options, $field)) {
                    // Build error message
                    $this->errors[$field] = $this->error($value, $rule, $options, $field);
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
    public function check($value, $rule, $options = null, $field = null)
    {
        if (!isset($this->methods[$rule])) {
            $name  = str_replace('_', '', ucwords(str_replace('_', ' ', $rule)));
            $class = '\\PHPValidation\\Rules\\' . $name;
            if (class_exists($class)) {
                $this->methods[$rule] = new $class($this);
            } else {
                throw new \Exception(sprintf("The rule \"%s\" doesn't exist", [$rule]), 1);
            }
        }

        if (isset($this->methods[$rule])) {
            return $this->methods[$rule]->validate($value, $options, $field);
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
    protected function error($value, $rule, $options = null, $field = null)
    {
        $message = null;

        if (isset($field) && isset($this->messages[$field])) {
            if (is_array($this->messages[$field]) && isset($this->messages[$field][$rule])) {
                $message = $this->messages[$field][$rule];
            } else {
                $message = $this->messages[$field];
            }
        } elseif (isset($this->methods[$rule])) {
            $message = $this->methods[$rule]->message($options, $value, $field);
        }

        if (is_callable($message)) {
            $message = call_user_func($message, $options, $value, $field);
        }

        if (isset($message) && is_string($message)) {
            $message = $this->format($message, $options);
        }

        return is_scalar($message) ? $message : '';
    }

    /**
     * Replaces {n} placeholders with arguments.
     */
    protected function format($source, $params)
    {
        $argsv = func_get_args();
        $argsc = func_num_args();

        if ($argsc > 2 && !is_array($params)) {
            $params = array_slice($argsv, 1);
        }
        if (!is_array($params)) {
            $params = [$params];
        }
        foreach ($params as $i => $n) {
            $source = preg_replace("/\{" . preg_quote($i) . "\}/", $n, $source);
        }

        return $source;
    }

    public function param($name)
    {
        return @$this->params[$name];
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
    public function depend($options, $value = null)
    {
        if (is_bool($options)) {
            return $options;
        } elseif (is_string($options)) {
            return isset($his->params[$options]);
        } elseif (is_callable($options)) {
            return (bool) call_user_func($options, $value);
        }

        return true;
    }
}
