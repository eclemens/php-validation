<?php
use PHPValidation\Validation;

class ValidationTest extends \PHPUnit_Framework_TestCase
{

    use Codeception\Specify;

    public function setUp()
    {
        $this->validation = new Validation();
    }

    public function testValidation()
    {
        $this->specify('Test "Creditcard"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'creditcard' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '5555555555554444']));
            $this->assertFalse($this->validation->valid(['field' => '5555555555555555']));
        });

        $this->specify('Test "DateISO"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'dateISO' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '2012/12/31']));
            $this->assertFalse($this->validation->valid(['field' => '2012/31/12']));
        });

        $this->specify('Test "Date"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'date' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '2012/12/31']));
            $this->assertTrue($this->validation->valid(['field' => '12/31/2012']));
            $this->assertFalse($this->validation->valid(['field' => '2012/31/12']));
            $this->assertFalse($this->validation->valid(['field' => '2012/13/13']));
        });

        $this->specify('Test "Digits"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'digits' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '2015']));
            $this->assertFalse($this->validation->valid(['field' => '10.5']));
            $this->assertFalse($this->validation->valid(['field' => 'ten']));
        });

        $this->specify('Test "Email"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'email' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => 'john@example.org']));
            $this->assertFalse($this->validation->valid(['field' => 'john@example']));
        });

        $this->specify('Test "EqualTo"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'equalTo' => 'other'
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '', 'other' => '']));
            $this->assertTrue($this->validation->valid(['field' => '10', 'other' => '10']));
            $this->assertFalse($this->validation->valid(['field' => '10', 'other' => '11']));
        });

        $this->specify('Test "Maxlength"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'maxlength' => 5
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '12345']));
            $this->assertFalse($this->validation->valid(['field' => '123456']));
        });

        $this->specify('Test "Max"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'max' => 5
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '0']));
            $this->assertTrue($this->validation->valid(['field' => '5']));
            $this->assertFalse($this->validation->valid(['field' => '6']));
        });

        $this->specify('Test "Minlength"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'minlength' => 5
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => 'john doe']));
            $this->assertFalse($this->validation->valid(['field' => 'john']));
        });

        $this->specify('Test "Min"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'min' => 5
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '5']));
            $this->assertTrue($this->validation->valid(['field' => '6']));
            $this->assertFalse($this->validation->valid(['field' => '4']));
        });

        $this->specify('Test "Number"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'number' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '10.5']));
            $this->assertTrue($this->validation->valid(['field' => '+10.5']));
            $this->assertTrue($this->validation->valid(['field' => '-10.5']));
            $this->assertTrue($this->validation->valid(['field' => '10']));
            $this->assertTrue($this->validation->valid(['field' => '+10']));
            $this->assertTrue($this->validation->valid(['field' => '-10']));
            $this->assertFalse($this->validation->valid(['field' => 'ten']));
        });

        $this->specify('Test "Rangelength"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'rangelength' => [5, 8]
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertFalse($this->validation->valid(['field' => 'john']));
            $this->assertTrue($this->validation->valid(['field' => 'smith']));
            $this->assertTrue($this->validation->valid(['field' => 'john doe']));
            $this->assertFalse($this->validation->valid(['field' => 'smith doe']));
        });

        $this->specify('Test "Range"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'range' => [5, 8]
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertFalse($this->validation->valid(['field' => '4']));
            $this->assertTrue($this->validation->valid(['field' => '5']));
            $this->assertTrue($this->validation->valid(['field' => '6']));
            $this->assertTrue($this->validation->valid(['field' => '8']));
            $this->assertFalse($this->validation->valid(['field' => '9']));
        });

        $this->specify('Test "Callback"', function () {
            $validation = $this->validation;
            $this->validation->rules([
                'field' => [
                    'required' => true, 'callback' => function ($value) use ($validation) {
                        return $this->validation->optional($value) || (bool) $value;
                    }
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => true]));
            $this->assertFalse($this->validation->valid(['field' => false]));
        });

        //$this->specify('Test "Remote"', function() {
        //    $validation = $this->validation;
        //    $this->validation->rules([
        //        'field' => [
        //            'required' => true, 'remote' => ['url'=> 'http://localhost/valid.php', 'method' => 'post']
        //        ]
        //    ]);
        //
        //    $this->assertFalse($this->validation->valid(['field' => '']));
        //    $this->assertTrue($this->validation->valid(['field' => 1]));
        //    $this->assertFalse($this->validation->valid(['field' => 0]));
        //});

        $this->specify('Test "Required"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'required' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '0']));
            $this->assertTrue($this->validation->valid(['field' => '10']));
            $this->assertTrue($this->validation->valid(['field' => 0]));
            $this->assertTrue($this->validation->valid(['field' => true]));
            $this->assertFalse($this->validation->valid(['field' => false]));
            $this->assertFalse($this->validation->valid(['field' => '']));
        });

        $this->specify('Test "Url"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'url' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => 'http://google.com/']));
            $this->assertFalse($this->validation->valid(['field' => 'google.com']));
        });

        $this->specify('Test "Custom"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'zipcode' => true
                ]
            ]);

            $this->validation->addMethod(
                "zipcode",
                function ($value) {
                    return $value && preg_match('/^\d{5}(?:-\d{4})?$/', $value);
                },
                "Please provide a valid zipcode."
            );

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '55555']));
            $this->assertTrue($this->validation->valid(['field' => '55555-4444']));
            $this->assertFalse($this->validation->valid(['field' => '5555']));
            $this->assertFalse($this->validation->valid(['field' => '555554444']));
            $this->assertFalse($this->validation->valid(['field' => '55555-444']));
        });

        $this->specify('Test "Custom" without `required`', function () {
            $this->validation->rules([
                'field' => [
                    'required' => false, 'zipcode' => true
                ]
            ]);

            $validation = $this->validation;
            $this->validation->addMethod(
                "zipcode",
                function ($value) use ($validation) {
                    return $validation->optional($value) || preg_match('/^\d{5}(?:-\d{4})?$/', $value);
                },
                "Please provide a valid zipcode."
            );

            $this->assertTrue($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '55555']));
            $this->assertTrue($this->validation->valid(['field' => '55555-4444']));
            $this->assertFalse($this->validation->valid(['field' => '5555']));
            $this->assertFalse($this->validation->valid(['field' => '555554444']));
            $this->assertFalse($this->validation->valid(['field' => '55555-444']));
        });
    }
}
