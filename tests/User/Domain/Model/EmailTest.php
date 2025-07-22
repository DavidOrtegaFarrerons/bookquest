<?php

namespace App\Tests\User\Domain\Model;

use App\User\Domain\Model\Email;
use App\User\Domain\Model\InvalidEmailException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testInvalidEmailShouldThrowException()
    {
        $this->expectException(InvalidEmailException::class);

        $invalidEmail = 'david.com';
        new Email($invalidEmail);
    }

    public function testValidEmail()
    {
        $validEmail = '  david@gmail.com ';
        $email = new Email($validEmail);

        $this->assertEquals('david@gmail.com', $email->value());
    }

    public function testEmailEquality()
    {
        $email = 'david@gmail.com';
        $email1 = new Email($email);
        $email2 = new Email($email);

        $this->assertTrue($email1->equals($email2));
    }
}
