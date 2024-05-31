<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Users\Domain;

use AnimalSociety\Administration\Users\Application\register\RegisterUserCommand;
use AnimalSociety\Administration\Users\Domain\User;
use AnimalSociety\Administration\Users\Domain\UserAssociationId;
use AnimalSociety\Administration\Users\Domain\UserEmail;
use AnimalSociety\Administration\Users\Domain\UserFirstLastName;
use AnimalSociety\Administration\Users\Domain\UserId;
use AnimalSociety\Administration\Users\Domain\UserName;
use AnimalSociety\Administration\Users\Domain\UserPassword;
use AnimalSociety\Administration\Users\Domain\UserRole;
use AnimalSociety\Administration\Users\Domain\UserSecondLastName;

final class UserMother
{
    public static function create(
        ?UserId $id = null,
        ?UserName $name = null,
        ?UserFirstLastName $firstLastName = null,
        ?UserSecondLastName $userSecondLastName = null,
        ?UserEmail $email = null,
        ?UserPassword $password = null,
        ?UserAssociationId $userAssociationId = null,
        ?UserRole $role = null,
        bool $active = true,
    ): User {
        return new User(
            $id ?? UserIdMother::create(),
            $name ?? UserNameMother::create(),
            $firstLastName ?? UserFirstLastNameMother::create(),
            $userSecondLastName ?? UserSecondLastNameMother::create(),
            $email ?? UserEmailMother::create(),
            $password ?? UserPasswordMother::create(),
            $userAssociationId ?? UserAssociationIdMother::create(),
            $role ?? UserRoleMother::create(),
            $active
        );
    }

    public static function fromRequest(RegisterUserCommand $request): User
    {
        return self::create(
            UserIdMother::create($request->id()),
            UserNameMother::create($request->name()),
            UserFirstLastNameMother::create($request->firstLastName()),
            UserSecondLastNameMother::create($request->secondLastName()),
            UserEmailMother::create($request->email()),
            UserPasswordMother::create($request->password()),
            UserAssociationIdMother::create($request->associationId()),
            UserRoleMother::create($request->role()),
            true,
        );
    }
}
