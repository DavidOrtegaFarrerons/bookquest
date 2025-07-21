<?php

namespace App\User\Infrastructure\Persistence\Doctrine;

use App\User\Domain\Model\Email;
use App\User\Domain\Model\User;
use App\User\Domain\Model\UserId;
use App\User\Domain\Model\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineUserRepository implements UserRepository
{


    public function __construct(private readonly EntityManagerInterface $em)
    {
    }

    public function save(User $user): void
    {
        $record = UserMapper::toRecord($user);
        $this->em->persist($record);
        $this->em->flush();
    }

    public function byId(UserId $id): ?User
    {
        $record = $this->em->find(UserRecord::class, (string) $id);
        return $record ? UserMapper::toDomain($record) : null;
    }

    public function nextIdentity(): UserId
    {
        return UserId::create();
    }

    public function userOfEmail(Email $email): ?User
    {
        $record = $this->em
            ->getRepository(UserRecord::class)
            ->findOneBy(['email' => $email->value()]);

        return $record ? UserMapper::toDomain($record) : null;
    }
}
