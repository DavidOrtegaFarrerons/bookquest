<?php

namespace App\User\Application\Register;

use App\User\Domain\Model\Email;
use App\User\Domain\Model\PasswordHasher;
use App\User\Domain\Model\User;
use App\User\Domain\Model\UserAlreadyExistsException;
use App\User\Domain\Model\UserRepository;

class RegisterUserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly PasswordHasher $passwordHasher,
    )
    {
    }

    public function execute(RegisterUserRequest $request) : RegisterUserResponse
    {

        $user = $this->userRepository->userOfEmail(new Email($request->email));
        if ($user !== null) {
            throw new UserAlreadyExistsException();
        }

        $hashedPassword = $this->passwordHasher->hash($request->password);

        $user = new User(
            $this->userRepository->nextIdentity(),
            new Email($request->email),
            $request->firstName,
            $request->lastName,
            $hashedPassword
        );

        $this->userRepository->save($user);

        return new RegisterUserResponse($user);
    }
}
