<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Application\update;

use AnimalSociety\Administration\Users\Domain\UserFirstLastName;
use AnimalSociety\Administration\Users\Domain\UserId;
use AnimalSociety\Administration\Users\Domain\UserName;
use AnimalSociety\Administration\Users\Domain\UserSecondLastName;
use AnimalSociety\Shared\Domain\Bus\Command\CommandHandler;

final readonly class UpdateUserCommandHandler implements CommandHandler
{
    public function __construct(
        private UserUpdate $updater
    ) {}

    public function __invoke(UpdateUserCommand $command): void
    {
        $id = new UserId($command->id());
        $name = new UserName($command->name());
        $firstLastName = new UserFirstLastName($command->firstLastName());
        $secondLastName = new UserSecondLastName($command->secondLastName());

        $this->updater->__invoke(
            id: $id,
            name: $name,
            firstLastName: $firstLastName,
            secondLastName: $secondLastName,
        );
    }
}
