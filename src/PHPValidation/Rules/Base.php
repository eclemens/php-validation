<?php

namespace PHPValidation\Rules;

abstract class Base implements RuleInterface {
    public $message;
    protected $validation;

    public function __construct(\PHPValidation\Validation &$validation)
    {
        $this->validation = $validation;
    }
}
