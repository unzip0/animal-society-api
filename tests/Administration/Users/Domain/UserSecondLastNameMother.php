<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Users\Domain;

use AnimalSociety\Administration\Users\Domain\UserSecondLastName;
use AnimalSociety\Tests\Shared\Domain\WordMother;

final class UserSecondLastNameMother
{
    public static function create(?string $value = null): UserSecondLastName
    {
        return new UserSecondLastName($value ?? WordMother::create());
    }
}
