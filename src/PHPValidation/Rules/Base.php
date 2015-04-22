<?php

namespace PHPValidation\Rules;

abstract class Base implements RuleInterface {
    protected $validation;

    public $message;

    public function __construct(\PHPValidation\Validation &$validation)
    {
        $this->validation = $validation;
    }

    public function message($options, $value, $field = null) {
        return $this->message;
    }
}
