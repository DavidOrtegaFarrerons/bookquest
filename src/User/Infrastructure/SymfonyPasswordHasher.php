<?php

namespace App\User\Infrastructure;

use App\User\Domain\Model\PasswordHasher;
use App\User\Infrastructure\Persistence\Doctrine\UserRecord;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SymfonyPasswordHasher implements PasswordHasher
{
    public function __construct(private readonly UserPasswordHasherInterface $symfonyHasher)
    {
    }

    public function hash(string $plainPassword): string
    {
        return $this->symfonyHasher->hashPassword(
            new UserRecord(), $plainPassword
        );
    }
}
