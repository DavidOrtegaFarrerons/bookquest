<?php

namespace App\User\Domain\Model;

class User
{
    private UserId $id;
    private Email $email;
    private string $firstName;
    private string $lastName;
    private string $password;

    /**
     * @param UserId $id
     * @param Email $email
     * @param string $firstName
     * @param string $lastName
     * @param string $password
     */
    public function __construct(UserId $id, Email $email, string $firstName, string $lastName, string $password)
    {
        $trimmedFirstName = trim($firstName);
        if ($trimmedFirstName === '' || strlen($trimmedFirstName) < 3) {
            throw new \InvalidArgumentException("First name must be longer than 2 characters");
        }

        $trimmedLastName = trim($lastName);
        if ($trimmedLastName === '' || strlen($trimmedLastName) < 3) {
            throw new \InvalidArgumentException("Last name must be longer than 2 characters");
        }


        $this->id = $id;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->password = $password;
    }


    public function id() : UserId
    {
        return $this->id;
    }

    public function email() : Email
    {
        return $this->email;
    }

    public function firstName() : string
    {
        return $this->firstName;
    }

    public function lastName() : string
    {
        return $this->lastName;
    }

    public function password() : string
    {
        return $this->password;
    }
}
