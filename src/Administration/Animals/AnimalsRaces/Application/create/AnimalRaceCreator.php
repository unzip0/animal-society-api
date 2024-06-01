<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsRaces\Application\create;

use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRace;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceId;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceName;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceRepository;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\Exceptions\AnimalRaceAlreadyExistsException;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesId;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesRepository;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\Exceptions\AnimalSpeciesNotFoundException;

final readonly class AnimalRaceCreator
{
    public function __construct(
        private AnimalRaceRepository $repository,
        private AnimalSpeciesRepository $speciesRepository,
    ) {}

    public function __invoke(
        string $id,
        string $name,
        string $speciesId,
    ): void {
        $animalRace = AnimalRace::create(
            animalRaceId: new AnimalRaceId($id),
            animalRaceName: new AnimalRaceName($name),
            animalSpeciesId: new AnimalSpeciesId($speciesId),
        );

        $this->checkAnimalRaceConstraints($animalRace);

        $this->repository->create($animalRace);
    }

    private function checkAnimalRaceConstraints(AnimalRace $animalRace): void
    {
        $animalSpecies = $this->speciesRepository->findById(
            $animalRace->animalSpeciesId()
        );

        if ($animalSpecies === null) {
            throw AnimalSpeciesNotFoundException::create();
        }

        $existingAnimalRace = $this->repository->findOneBy(
            [
                'name' => $animalRace->animalRaceName()->value(),
                'species_id' => $animalRace->animalSpeciesId()->value(),
            ]
        );

        if ($existingAnimalRace instanceof AnimalRace) {
            throw AnimalRaceAlreadyExistsException::create();
        }
    }
}
