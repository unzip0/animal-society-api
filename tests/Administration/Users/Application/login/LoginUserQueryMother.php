<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Users\Application\login;

use AnimalSociety\Administration\Users\Application\login\LoginUserQuery;
use AnimalSociety\Tests\Administration\Users\Domain\UserEmailMother;
use AnimalSociety\Tests\Administration\Users\Domain\UserPasswordMother;

final class LoginUserQueryMother
{
    public static function create(
        ?string $email = null,
        ?string $password = null,
    ): LoginUserQuery {
        return new LoginUserQuery(
            $email ?? UserEmailMother::create()->value(),
            $password ?? UserPasswordMother::create()->value(),
        );
    }
}
