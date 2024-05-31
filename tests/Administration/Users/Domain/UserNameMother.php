<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Users\Domain;

use AnimalSociety\Administration\Users\Domain\UserName;
use AnimalSociety\Tests\Shared\Domain\WordMother;

final class UserNameMother
{
    public static function create(?string $value = null): UserName
    {
        return new UserName($value ?? WordMother::create());
    }
}
