<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Users\Domain;

use AnimalSociety\Administration\Users\Domain\UserAssociationId;
use AnimalSociety\Tests\Shared\Domain\UuidMother;

final class UserAssociationIdMother
{
    public static function create(?string $value = null): UserAssociationId
    {
        return new UserAssociationId($value ?? UuidMother::create());
    }
}
