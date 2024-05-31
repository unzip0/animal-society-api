<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Users\Application\register;

use AnimalSociety\Administration\Users\Application\register\RegisterUserCommand;
use AnimalSociety\Administration\Users\Domain\UserAssociationId;
use AnimalSociety\Administration\Users\Domain\UserEmail;
use AnimalSociety\Administration\Users\Domain\UserFirstLastName;
use AnimalSociety\Administration\Users\Domain\UserId;
use AnimalSociety\Administration\Users\Domain\UserName;
use AnimalSociety\Administration\Users\Domain\UserPassword;
use AnimalSociety\Administration\Users\Domain\UserRole;
use AnimalSociety\Administration\Users\Domain\UserSecondLastName;
use AnimalSociety\Tests\Administration\Users\Domain\UserAssociationIdMother;
use AnimalSociety\Tests\Administration\Users\Domain\UserEmailMother;
use AnimalSociety\Tests\Administration\Users\Domain\UserFirstLastNameMother;
use AnimalSociety\Tests\Administration\Users\Domain\UserIdMother;
use AnimalSociety\Tests\Administration\Users\Domain\UserNameMother;
use AnimalSociety\Tests\Administration\Users\Domain\UserPasswordMother;
use AnimalSociety\Tests\Administration\Users\Domain\UserRoleMother;
use AnimalSociety\Tests\Administration\Users\Domain\UserSecondLastNameMother;

final class RegisterUserCommandMother
{
    public static function create(
        ?UserId $id = null,
        ?UserName $name = null,
        ?UserFirstLastName $firstLastName = null,
        ?UserSecondLastName $secondLastName = null,
        ?UserEmail $email = null,
        ?UserPassword $password = null,
        ?UserAssociationId $userAssociationId = null,
        ?UserRole $role = null,
    ): RegisterUserCommand {
        return new RegisterUserCommand(
            $id?->value() ?? UserIdMother::create()->value(),
            $name?->value() ?? UserNameMother::create()->value(),
            $firstLastName?->value() ?? UserFirstLastNameMother::create()->value(),
            $secondLastName?->value() ?? UserSecondLastNameMother::create()->value(),
            $email?->value() ?? UserEmailMother::create()->value(),
            $password?->value() ?? UserPasswordMother::create()->value(),
            $role?->value() ?? UserRoleMother::create()->value(),
            $userAssociationId?->value() ?? UserAssociationIdMother::create()->value(),
        );
    }
}
