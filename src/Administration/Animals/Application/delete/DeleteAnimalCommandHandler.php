<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\Application\delete;

use AnimalSociety\Administration\Animals\Domain\AnimalId;
use AnimalSociety\Administration\Associations\Domain\AssociationId;
use AnimalSociety\Shared\Domain\Bus\Command\CommandHandler;

final readonly class DeleteAnimalCommandHandler implements CommandHandler
{
    public function __construct(
        private AnimalDeleter $deleter
    ) {}

    public function __invoke(DeleteAnimalCommand $command): void
    {
        $this->deleter->__invoke(
            animalId: new AnimalId($command->animalId()),
            associationId: new AssociationId($command->associationId()),
        );
    }
}
