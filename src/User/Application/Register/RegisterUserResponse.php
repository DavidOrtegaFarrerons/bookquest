<?php

namespace App\User\Application\Register;

use App\User\Domain\Model\Email;
use App\User\Domain\Model\User;
use App\User\Domain\Model\UserId;

class RegisterUserResponse
{
    public UserId $id;
    public Email $email;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->id = $user->id();
        $this->email = $user->email();
    }
}
