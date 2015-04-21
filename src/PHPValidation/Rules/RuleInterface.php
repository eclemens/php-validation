<?php

namespace PHPValidation\Rules;

interface RuleInterface {
    public function validate($value, $options = null);

    public function message($options, $value);
}
