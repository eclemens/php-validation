<?php
use PHPValidation\Validation;

class ValidationAdditionalTest extends \PHPUnit_Framework_TestCase
{

    use Codeception\Specify;

    public function setUp()
    {
        $this->validation = new Validation();
    }

    public function testValidation()
    {
        $this->specify('Test "MaxWords"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'maxWords' => 3
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => 'a b c']));
            $this->assertFalse($this->validation->valid(['field' => 'a b c d']));
        });

        $this->specify('Test "MinWords"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'minWords' => 2
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => 'a b']));
            $this->assertFalse($this->validation->valid(['field' => 'a']));
        });

        $this->specify('Test "RangeWords"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'rangeWords' => [3, 5]
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => 'a b c d e']));
            $this->assertFalse($this->validation->valid(['field' => 'a b c d e f']));
            $this->assertFalse($this->validation->valid(['field' => 'a b']));
        });

        $this->specify('Test "Alphanumeric"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'alphanumeric' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => 'asdas321d32as1d32sa1d']));
            $this->assertFalse($this->validation->valid(['field' => 'asdas3&5']));
        });

        $this->specify('Test "Creditcardtypes"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'creditcardtypes' => ['amex', 'visa', 'mastercard']
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '5555555555554444']));
            $this->assertFalse($this->validation->valid(['field' => '555555555555444']));
        });

        $this->specify('Test "Currency"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'currency' => '$,£,¢'
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '$10.00']));
            $this->assertFalse($this->validation->valid(['field' => '&10.00']));
        });

        $this->specify('Test "Extension"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'extension' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => 'image.jpeg']));
            $this->assertFalse($this->validation->valid(['field' => 'image.gifv']));
        });

        $this->specify('Test "Integer"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'integer' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '-265']));
            $this->assertTrue($this->validation->valid(['field' => '265']));
            $this->assertFalse($this->validation->valid(['field' => '26.5']));
        });

        $this->specify('Test "Ipv4"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'ipv4' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '8.8.8.255']));
            $this->assertFalse($this->validation->valid(['field' => '8.8.8.256']));
        });

        $this->specify('Test "Ipv6"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'ipv6' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => 'FE80:0000:0000:0000:0202:B3FF:FE1E:8329']));
            $this->assertFalse($this->validation->valid(['field' => '8.8.8.8']));
        });

        $this->specify('Test "Lettersonly"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'lettersonly' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => 'ASdasDASdasDASDsadsad']));
            $this->assertFalse($this->validation->valid(['field' => 'AS6']));
        });

        $this->specify('Test "Letterswithbasicpunc"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'letterswithbasicpunc' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => 'ASDasd,.asdASD.a,sd.asd']));
            $this->assertFalse($this->validation->valid(['field' => 'ASD*asd,.']));
        });

        $this->specify('Test "Nowhitespace"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'nowhitespace' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => 'asdasdasdsadas']));
            $this->assertFalse($this->validation->valid(['field' => 'asdasda sdsadas']));
        });

        $this->specify('Test "Pattern"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'pattern' => '[0-9]0+[0-9]'
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '102']));
            $this->assertFalse($this->validation->valid(['field' => '112']));
        });

        $this->specify('Test "StateUS"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'stateUS' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => 'az']));
            $this->assertFalse($this->validation->valid(['field' => 'mx']));
        });

        $this->specify('Test "Strippedminlength"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'strippedminlength' => 1
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '<a>a</a>']));
            $this->assertFalse($this->validation->valid(['field' => '<a></a>']));
        });

        $this->specify('Test "Time"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'time' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '15:00']));
            $this->assertFalse($this->validation->valid(['field' => '25:00']));
        });

        $this->specify('Test "Time12h"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'time12h' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '12:33 pm']));
            $this->assertFalse($this->validation->valid(['field' => '13:33 pm']));
        });

        $this->specify('Test "ZipcodeUS"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'zipcodeUS' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '55555-5555']));
            $this->assertFalse($this->validation->valid(['field' => '55555-555']));
        });

        $this->specify('Test "Ziprange"', function () {
            $this->validation->rules([
                'field' => [
                    'required' => true, 'ziprange' => true
                ]
            ]);

            $this->assertFalse($this->validation->valid(['field' => '']));
            $this->assertTrue($this->validation->valid(['field' => '90266-4564']));
            $this->assertFalse($this->validation->valid(['field' => '90266-4564444']));
        });
    }
}
