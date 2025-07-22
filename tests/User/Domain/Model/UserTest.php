<?php

namespace App\Tests\User\Domain\Model;

use App\User\Domain\Model\Email;
use App\User\Domain\Model\User;
use App\User\Domain\Model\UserId;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testThrowsExceptionIfFirstNameIsShorterThanThreeCharacters()
    {
        $this->expectException(\InvalidArgumentException::class);
        new User(
            UserId::create(),
            new Email('david@gmail.com'),
            '',
            'Doe',
            'secure-password'
        );
    }

    public function testThrowsExceptionIfLastNameIsShorterThanThreeCharacters()
    {
        $this->expectException(\InvalidArgumentException::class);
        new User(
            UserId::create(),
            new Email('david@gmail.com'),
            'John',
            '',
            'secure-password'
        );
    }

    public function testCreatesUserWithValidData(): void
    {
        $user = new User(
            UserId::create('9e3f4c50-26b9-4cf2-9f2c-31c68e1839aa'),
            new Email('david@gmail.com'),
            'David',
            'Doe',
            'secure-password'
        );

        $this->assertEquals('David', $user->firstName());
        $this->assertEquals('Doe', $user->lastName());
    }

    public function testAcceptsFirstNameWithThreeCharacters(): void
    {
        $user = new User(
            UserId::create(),
            new Email('john@example.com'),
            'Jon',
            'Smith',
            'secure-password'
        );

        $this->assertEquals('Jon', $user->firstName());
    }
}
