<?php

namespace PHPValidation\Rules;

abstract class Base implements RuleInterface {
    protected $message;

    abstract public function getMessage();
}
