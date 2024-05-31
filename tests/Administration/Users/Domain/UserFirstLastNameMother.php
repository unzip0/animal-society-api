<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Users\Domain;

use AnimalSociety\Administration\Users\Domain\UserFirstLastName;
use AnimalSociety\Tests\Shared\Domain\WordMother;

final class UserFirstLastNameMother
{
    public static function create(?string $value = null): UserFirstLastName
    {
        return new UserFirstLastName($value ?? WordMother::create());
    }
}
