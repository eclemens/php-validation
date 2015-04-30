# php-validation
PHP Validation class inspired by the jQuery Validation Plugin (http://jqueryvalidation.org/)

Description
------------

I created this library to use along with *jQuery Validation Plugin*.

It allows to use the same (or similar) rules used for *jQuery Validation Plugin* implementation in the client side to validate the request in the server side.

Installation
------------

Install using [composer](http://getcomposer.org/). Exists as
[eclemens/php-validation](https://packagist.org/packages/eclemens/php-validation)
in the [packagist](https://packagist.org/) repository.

Add the package to the require section in your composer.json file:

```json
{
    "require" : {
        "eclemens/php-validation": "dev-master"
    }
}
```

Usage
-----

### Basic standalone usage

**PHP**
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
    'repassword' => ['equalTo' => 'password']
]);

// Data
$data = [
    'username'   => 'johndoe',
    'email'      => 'johndoe@example.org',
    'password'   => 'pass1234',
    'repassword' => 'pass1234'
];

// Validate:
if ($validator->valid($data)) {
    // It's a valid data!
}

```

### Usage along with *jQuery Validation Plugin*

**HTML**
```html
<form>
    <input type="text" name="username">
    <input type="email" name="email">
    <input type="password" name="password">
    <input type="repassword" name="repassword">
    <input type="submit" name="submit">
</form>
```

**JavaScript**
```javascript
$("form").validate({
    "rules": {
        "username":   {"required": true, "rangelength": [3, 64]},
        "email":      {"required": true, "email": true},
        "password":   {"required": true},
        "repassword": {"equalTo": "[name=password]"}
    }
});
```

**PHP**
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

// Validate:
if ($validator->valid($_REQUEST)) {
    // It's a valid data!
}

```

TODO
-------
* Missing additional rules
* i18n
