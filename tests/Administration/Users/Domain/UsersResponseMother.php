<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Users\Domain;

use AnimalSociety\Administration\Users\Application\UserResponse;
use AnimalSociety\Administration\Users\Application\UsersResponse;
use AnimalSociety\Administration\Users\Domain\User;

final class UsersResponseMother
{
    public static function create(?User $user): UsersResponse
    {
        if ($user === null) {
            return new UsersResponse();
        }

        return new UsersResponse(
            new UserResponse(
                $user->id()->__toString(),
                $user->name()->value(),
                $user->firstLastName()->value(),
                $user->secondLastName()->value(),
                $user->email()->value(),
                $user->role()->value(),
                $user->isActive()
            )
        );
    }
}
