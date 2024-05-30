<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Application\update;

use AnimalSociety\Shared\Domain\Bus\Command\CommandHandler;

final readonly class UpdateUserCommandHandler implements CommandHandler
{
    public function __construct(
        private UserUpdate $updater
    ) {}

    public function __invoke(UpdateUserCommand $command): void
    {
        $this->updater->__invoke(
            id: $command->id(),
            name: $command->name(),
            firstLastName: $command->firstLastName(),
            secondLastName: $command->secondLastName(),
        );
    }
}
