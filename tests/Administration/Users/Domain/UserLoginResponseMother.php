<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Users\Domain;

use AnimalSociety\Administration\Users\Application\UserLoginResponse;
use AnimalSociety\Administration\Users\Domain\User;

final class UserLoginResponseMother
{
    public static function create(
        User $user = null,
        string $token,
    ): UserLoginResponse {
        return new UserLoginResponse(
            $user,
            $token,
        );
    }
}
