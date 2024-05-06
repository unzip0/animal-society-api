<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Application\register;

use AnimalSociety\Administration\Users\Domain\UserAssociationId;
use AnimalSociety\Administration\Users\Domain\UserEmail;
use AnimalSociety\Administration\Users\Domain\UserFirstLastName;
use AnimalSociety\Administration\Users\Domain\UserId;
use AnimalSociety\Administration\Users\Domain\UserName;
use AnimalSociety\Administration\Users\Domain\UserPassword;
use AnimalSociety\Administration\Users\Domain\UserRole;
use AnimalSociety\Administration\Users\Domain\UserSecondLastName;
use AnimalSociety\Shared\Domain\Bus\Command\CommandHandler;

final readonly class RegisterUserCommandHandler implements CommandHandler
{
    public function __construct(
        private UserRegister $creator
    ) {}

    public function __invoke(RegisterUserCommand $command): void
    {
        $id = new UserId($command->id());
        $name = new UserName($command->name());
        $firstLastName = new UserFirstLastName($command->firstLastName());
        $secondLastName = new UserSecondLastName($command->secondLastName());
        $email = new UserEmail($command->email());
        $password = new UserPassword($command->password());
        $role = new UserRole($command->role());
        $associationId = new UserAssociationId($command->associationId());

        $this->creator->__invoke(
            id: $id->__toString(),
            name: $name->value(),
            firstLastName: $firstLastName->value(),
            secondLastName: $secondLastName->value(),
            email: $email->value(),
            password: $password->value(),
            role: $role->value(),
            associationId: $associationId->value(),
        );
    }
}
