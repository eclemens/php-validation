<?php

namespace PHPValidation\Rules;

interface RuleInterface {
    public function validate($value, $options = null, $field = null);

    public function message($options, $value, $field = null);
}
