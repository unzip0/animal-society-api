<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsRaces\Application\create;

use AnimalSociety\Shared\Domain\Bus\Command\CommandHandler;

final readonly class CreateAnimalRaceCommandHandler implements CommandHandler
{
    public function __construct(
        private AnimalRaceCreator $creator
    ) {}

    public function __invoke(CreateAnimalRaceCommand $command): void
    {
        $this->creator->__invoke(
            id: $command->id(),
            name: $command->name(),
            speciesId: $command->speciesId(),
        );
    }
}
