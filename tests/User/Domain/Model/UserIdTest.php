<?php

namespace App\Tests\User\Domain\Model;

use App\User\Domain\Model\UserId;
use PHPUnit\Framework\TestCase;

class UserIdTest extends TestCase
{
    public function testGeneratesValidUuidWhenNullProvided(): void
    {
        $userId = UserId::create();
        $this->assertMatchesRegularExpression(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i',
            (string) $userId
        );
    }

    public function testCreatesFromProvidedUuid(): void
    {
        $uuid = '9e3f4c50-26b9-4cf2-9f2c-31c68e1839aa';
        $userId = UserId::create($uuid);

        $this->assertEquals($uuid, (string) $userId);
    }

    public function testEqualityWithSameUuid(): void
    {
        $uuid = '11111111-1111-4111-8111-111111111111';

        $userId1 = UserId::create($uuid);
        $userId2 = UserId::create($uuid);

        $this->assertTrue($userId1->equals($userId2));
    }
}
