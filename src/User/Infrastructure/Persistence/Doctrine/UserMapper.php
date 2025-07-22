<?php

namespace App\User\Infrastructure\Persistence\Doctrine;

use App\User\Domain\Model\Email;
use App\User\Domain\Model\User;
use App\User\Domain\Model\UserId;

class UserMapper
{
    public static function toRecord(User $user) : UserRecord
    {
        $r              = new UserRecord();
        $r->id          = (string) $user->id();
        $r->email       = (string) $user->email();
        $r->password    = $user->password();
        $r->firstName   = $user->firstName();
        $r->lastName    = $user->lastName();

        return $r;
    }

    public static function toDomain(UserRecord $r) : User
    {
        return new User(
            UserId::create($r->id),
            new Email($r->email),
            $r->firstName,
            $r->lastName,
            $r->password,
        );
    }
}
