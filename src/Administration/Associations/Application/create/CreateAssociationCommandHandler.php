<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Application\create;

use AnimalSociety\Shared\Domain\Bus\Command\CommandHandler;

final readonly class CreateAssociationCommandHandler implements CommandHandler
{
    public function __construct(
        private AssociationCreator $creator
    ) {}

    public function __invoke(CreateAssociationCommand $command): void
    {
        $this->creator->__invoke(
            id: $command->id(),
            cif: $command->cif(),
            name: $command->name(),
            cityId: $command->cityId(),
            email: $command->email(),
        );
    }
}
