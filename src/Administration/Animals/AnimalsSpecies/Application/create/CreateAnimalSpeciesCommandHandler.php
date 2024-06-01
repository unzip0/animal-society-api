<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsSpecies\Application\create;

use AnimalSociety\Shared\Domain\Bus\Command\CommandHandler;

final readonly class CreateAnimalSpeciesCommandHandler implements CommandHandler
{
    public function __construct(
        private AnimalSpeciesCreator $creator
    ) {}

    public function __invoke(CreateAnimalSpeciesCommand $command): void
    {
        $this->creator->__invoke(
            id: $command->id(),
            name: $command->name(),
        );
    }
}
