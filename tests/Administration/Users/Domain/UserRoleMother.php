<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Users\Domain;

use AnimalSociety\Administration\Users\Domain\UserRole;
use AnimalSociety\Tests\Shared\Domain\RoleMother;

final class UserRoleMother
{
    public static function create(?string $value = null): UserRole
    {
        return new UserRole($value ?? RoleMother::create());
    }
}
