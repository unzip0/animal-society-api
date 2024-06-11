<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\Application\delete;

use AnimalSociety\Administration\Animals\Domain\Animal;
use AnimalSociety\Administration\Animals\Domain\AnimalId;
use AnimalSociety\Administration\Animals\Domain\AnimalRepository;
use AnimalSociety\Administration\Animals\Domain\Exceptions\AnimalNotFoundException;
use AnimalSociety\Administration\Associations\Domain\AssociationId;
use AnimalSociety\Shared\Domain\FileSystem\Storage;

final readonly class AnimalDeleter
{
    public function __construct(
        private AnimalRepository $repository,
        private Storage $storage,
    ) {}

    public function __invoke(
        AnimalId $animalId,
        AssociationId $associationId,
    ): void {
        $animal = $this->repository->findById($animalId);
        if ($animal === null) {
            throw AnimalNotFoundException::create();
        }

        /** @var Animal $animal */
        if ($associationId->value() !== $animal->animalAssociationId()->value()) {
            throw AnimalNotFoundException::create();
        }

        $this->storage->delete($animal->animalPhoto());

        $this->repository->delete($animal);
    }
}
