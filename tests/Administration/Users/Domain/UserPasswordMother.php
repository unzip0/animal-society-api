<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Users\Domain;

use AnimalSociety\Administration\Users\Domain\UserPassword;
use AnimalSociety\Tests\Shared\Domain\WordMother;

final class UserPasswordMother
{
    /**
     * @todo generate valid random password
     */
    public static function create(?string $value = null): UserPassword
    {
        $value = bcrypt('#T0d0R4nd0mP4ssW0rd!#');
        return new UserPassword($value ?? WordMother::create());
    }
}
