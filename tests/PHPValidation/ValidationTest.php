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
        $this->specify('Test email', function () {
            $this->validation->rules([
                'email' => [
                    'required' => true, 'email' => true
                ]
            ]);

            $this->assertTrue($this->validation->valid(['email' => 'john@example.org']));
        });
    }
}
