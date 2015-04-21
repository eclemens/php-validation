# php-validation
PHP Validation class inspired by the jQuery Validation Plugin

# Instalation

composer - add the package to the require section in your composer.json file:

```json
{
    "require" : {
        "eclemens/php-validation": "0.1.0"
    }
}
```

# Usage

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

// Create validator instance
$validator = new PHPValidation\Validation();

// Add rules
$validator->rules([
    'username'   => ['required' => true, 'rangelength' => [3, 64]],
    'email'      => ['required' => true, 'email' => true],
    'password'   => ['required' => true],
    'repassword' => ['equalTo' => 'password'],
]);

// Data
$data = [
    'username'   => 'johndoe',
    'email'      => 'johndoe@example.org',
    'password'   => 'pass1234',
    'repassword' => 'pass1234'
];

// Validate:
if ($validator->validate($data)) {
    // It's a valid data!
}
```
