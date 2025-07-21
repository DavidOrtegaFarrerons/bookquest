<?php

namespace App\User\Domain\Model;

interface UserRepository
{
    public function nextIdentity() : UserId;
    public function save(User $user)  : void;
    public function byId(UserId $id) : ?User;
    public function userOfEmail(Email $email) : ?User;
}
