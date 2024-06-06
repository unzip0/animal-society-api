<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsRaces\Application\findAll;

use AnimalSociety\Administration\Animals\AnimalsRaces\Application\AnimalRaceResponse;
use AnimalSociety\Administration\Animals\AnimalsRaces\Application\AnimalRacesResponse;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRace;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceRepository;

use function Lambdish\Phunctional\map;

final readonly class AnimalRaceSearcher
{
    public function __construct(
        private AnimalRaceRepository $repository
    ) {}


    public function searchAll(): AnimalRacesResponse
    {
        return new AnimalRacesResponse(...map(
            $this->toResponse(),
            $this->repository->findAll()
        ));
    }

    private function toResponse(): callable
    {
        return static fn (AnimalRace $animalRace): AnimalRaceResponse => new AnimalRaceResponse(
            $animalRace->animalRaceId()->value(),
            $animalRace->animalRaceName()->value(),
            $animalRace->animalSpeciesId()->value(),
        );
    }
}
