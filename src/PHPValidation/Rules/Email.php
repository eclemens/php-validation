<?php

namespace PHPValidation\Rules;

class Email extends Base
{
    protected $message = "Please enter a valid email address.";
    protected $validation = "Please enter a valid email address.";

    public function __contruct(\PHPValidation\Validation $validation) {
        $this->validation = $validation;
    }

    public function validate() {

    }
}
