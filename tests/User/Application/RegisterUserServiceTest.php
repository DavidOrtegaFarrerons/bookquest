<?php

namespace App\Tests\User\Application;

use App\User\Application\Register\RegisterUserRequest;
use App\User\Application\Register\RegisterUserService;
use App\User\Domain\Model\Email;
use App\User\Domain\Model\PasswordHasher;
use App\User\Domain\Model\User;
use App\User\Domain\Model\UserAlreadyExistsException;
use App\User\Domain\Model\UserId;
use App\User\Domain\Model\UserRepository;
use PHPUnit\Framework\TestCase;

class RegisterUserServiceTest extends TestCase
{
    public function testUserSignsUpSuccessfully(): void
    {
        $mockRepo = $this->createMock(UserRepository::class);

        $mockRepo->method('userOfEmail')
            ->willReturn(null); // no user exists with this email

        $mockRepo->method('nextIdentity')
            ->willReturn(UserId::create('test-id'));

        $mockRepo->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(User::class));

        $mockPasswordHasher = $this->createMock(PasswordHasher::class);

        $service = new RegisterUserService($mockRepo, $mockPasswordHasher);

        $request = new RegisterUserRequest(
            'david@example.com',
            'David',
            'Doe',
            'secure-password'
        );

        $response = $service->execute($request);

        $this->assertSame('david@example.com', $response->email->value());
        $this->assertSame('test-id', (string) $response->id->id());
    }

    public function testThrowsExceptionWhenEmailAlreadyRegistered()
    {
        $this->expectException(UserAlreadyExistsException::class);
        $mockRepository = $this->createMock(UserRepository::class);

        $mockRepository->method('userOfEmail')->willReturn(new User(
            UserId::create(),
            new Email("david@gmail.com"),
            'john',
            'doe',
            'secure-password'
        ));

        $mockPasswordHasher = $this->createMock(PasswordHasher::class);

        $service = new RegisterUserService($mockRepository, $mockPasswordHasher);

        $service->execute(new RegisterUserRequest(
            'david@gmail.com',
            'john',
                'doe',
                'secure-password'
            )
        );
    }

}
