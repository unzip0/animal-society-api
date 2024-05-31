<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Users\Domain;

use AnimalSociety\Administration\Users\Domain\UserEmail;
use AnimalSociety\Tests\Shared\Domain\EmailMother;

final class UserEmailMother
{
    public static function create(?string $value = null): UserEmail
    {
        return new UserEmail($value ?? EmailMother::create());
    }
}
