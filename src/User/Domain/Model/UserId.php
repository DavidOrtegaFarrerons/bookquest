<?php

namespace App\User\Domain\Model;

use Ramsey\Uuid\Uuid;

class UserId
{
    private string $id;

    public function __construct(?string $id)
    {
        $this->id = null === $id ? Uuid::uuid4()->toString() : $id;
    }

    public static function create(?string $id = null): static
    {
        return new static($id);
    }

    public function id() : string
    {
        return $this->id;
    }

    public function equals(UserId $userId) : bool
    {
        return $this->id() === $userId->id();
    }

    public function __toString() : string
    {
        return $this->id();
    }
}
