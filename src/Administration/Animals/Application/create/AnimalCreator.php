<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\Application\create;

use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhoto;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceId;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceRepository;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\Exceptions\AnimalRaceNotFoundException;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesId;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesRepository;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\Exceptions\AnimalSpeciesNotFoundException;
use AnimalSociety\Administration\Animals\Domain\Animal;
use AnimalSociety\Administration\Animals\Domain\AnimalAge;
use AnimalSociety\Administration\Animals\Domain\AnimalId;
use AnimalSociety\Administration\Animals\Domain\AnimalName;
use AnimalSociety\Administration\Animals\Domain\AnimalRepository;
use AnimalSociety\Administration\Associations\Domain\AssociationId;
use AnimalSociety\Administration\Associations\Domain\AssociationRepository;
use AnimalSociety\Administration\Associations\Domain\Exceptions\AssociationNotFoundException;
use AnimalSociety\Shared\Domain\FileSystem\Storage;

final readonly class AnimalCreator
{
    public function __construct(
        private AnimalRepository $repository,
        private AssociationRepository $associationRepository,
        private AnimalSpeciesRepository $animalSpeciesRepository,
        private AnimalRaceRepository $animalRaceRepository,
        private Storage $storage,
    ) {}

    public function __invoke(
        string $id,
        string $animalAssociationId,
        string $animalName,
        string $animalSpeciesId,
        string $animalRaceId,
        int $animalAge,
        AnimalPhoto $animalPhoto,
    ): void {
        $animal = Animal::create(
            animalId: new AnimalId($id),
            animalAssociationId: new AssociationId($animalAssociationId),
            animalName: new AnimalName($animalName),
            animalSpeciesId: new AnimalSpeciesId($animalSpeciesId),
            animalRaceId: new AnimalRaceId($animalRaceId),
            animalAge: new AnimalAge($animalAge),
            animalPhoto: $animalPhoto,
        );

        $this->checkAnimalConstraints($animal);

        $this->repository->create($animal);

        $this->storage->store($animalPhoto);
    }

    private function checkAnimalConstraints(Animal $animal): void
    {
        $association = $this->associationRepository->findById(
            $animal->animalAssociationId()
        );
        if ($association === null) {
            throw AssociationNotFoundException::create();
        }

        $species = $this->animalSpeciesRepository->findById(
            $animal->animalSpeciesId()
        );
        if ($species === null) {
            throw AnimalSpeciesNotFoundException::create();
        }

        $race = $this->animalRaceRepository->findById(
            $animal->animalRaceId()
        );
        if ($race === null) {
            throw AnimalRaceNotFoundException::create();
        }
    }
}
