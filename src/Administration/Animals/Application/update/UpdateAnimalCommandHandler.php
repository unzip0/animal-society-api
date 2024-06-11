<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\Application\update;

use AnimalSociety\Administration\Animals\Domain\Dto\AnimalUpdateDataTansfer;
use AnimalSociety\Shared\Domain\Bus\Command\CommandHandler;

final readonly class UpdateAnimalCommandHandler implements CommandHandler
{
    public function __construct(
        private AnimalUpdate $updater
    ) {}

    public function __invoke(UpdateAnimalCommand $command): void
    {
        $this->updater->__invoke(
            AnimalUpdateDataTansfer::create(
                id: $command->id(),
                associationId: $command->associationId(),
                name: $command->name(),
                speciesId: $command->speciesId(),
                raceId: $command->raceId(),
                age: $command->age(),
                photoPath: $command->photoPath(),
                photoName: $command->photoName(),
                photoMimeType: $command->photoMimeType(),
                photoExtension: $command->photoExtension(),
            )
        );
    }
}
