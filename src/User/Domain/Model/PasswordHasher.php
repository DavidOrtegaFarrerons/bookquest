<?php

namespace App\User\Domain\Model;

interface PasswordHasher
{
    public function hash(string $plainPassword) : string;
}
