<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\Application\update;

use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceRepository;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\Exceptions\AnimalRaceNotFoundException;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesRepository;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\Exceptions\AnimalSpeciesNotFoundException;
use AnimalSociety\Administration\Animals\Domain\Animal;
use AnimalSociety\Administration\Animals\Domain\AnimalRepository;
use AnimalSociety\Administration\Animals\Domain\Dto\AnimalUpdateDataTansfer;
use AnimalSociety\Administration\Animals\Domain\Exceptions\AnimalNotFoundException;
use AnimalSociety\Shared\Domain\FileSystem\Storage;

final readonly class AnimalUpdate
{
    public function __construct(
        private AnimalRepository $repository,
        private AnimalSpeciesRepository $animalSpeciesRepository,
        private AnimalRaceRepository $animalRaceRepository,
        private Storage $storage,
    ) {}

    public function __invoke(AnimalUpdateDataTansfer $animalUpdateDataTansfer): void
    {
        $animal = $this->getAnimal($animalUpdateDataTansfer);

        $animal->updateName($animalUpdateDataTansfer->name);
        $animal->updateSpecies($animalUpdateDataTansfer->speciesId);
        $animal->updateRace($animalUpdateDataTansfer->raceId);
        $animal->updateAge($animalUpdateDataTansfer->age);

        if ($animalUpdateDataTansfer->photo !== null) {
            $this->storage->update($animalUpdateDataTansfer->photo);
        }

        $this->repository->updateAnimal($animal);
    }

    private function getAnimal(AnimalUpdateDataTansfer $animalUpdateDataTansfer): Animal
    {
        $animal = $this->repository->findById($animalUpdateDataTansfer->id);
        if (!$animal instanceof Animal) {
            throw AnimalNotFoundException::create();
        }

        if ($animal->animalAssociationId()->value() !== $animalUpdateDataTansfer->associationId->value()) {
            throw AnimalNotFoundException::create();
        }

        $this->checkConstraints($animalUpdateDataTansfer);

        return $animal;
    }

    private function checkConstraints(
        AnimalUpdateDataTansfer $animalUpdateDataTansfer
    ): void {
        $species = $this->animalSpeciesRepository->findById(
            $animalUpdateDataTansfer->speciesId
        );
        if ($species === null) {
            throw AnimalSpeciesNotFoundException::create();
        }

        $race = $this->animalRaceRepository->findById(
            $animalUpdateDataTansfer->raceId
        );
        if ($race === null) {
            throw AnimalRaceNotFoundException::create();
        }
    }
}
