<?php

namespace App\User\Application\Register;

class RegisterUserRequest
{
    public string $email;
    public string $firstName;
    public string $lastName;
    public string $password;

    /**
     * @param string $email
     * @param string $firstName
     * @param string $lastName
     * @param string $password
     */
    public function __construct(string $email, string $firstName, string $lastName, string $password)
    {
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->password = $password;
    }
}
