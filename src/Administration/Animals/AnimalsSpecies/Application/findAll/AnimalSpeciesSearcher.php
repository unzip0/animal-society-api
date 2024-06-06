<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsSpecies\Application\findAll;

use AnimalSociety\Administration\Animals\AnimalsSpecies\Application\AnimalSpeciesResponse;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Application\AnimalsSpeciesResponse;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpecies;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesRepository;

use function Lambdish\Phunctional\map;

final readonly class AnimalSpeciesSearcher
{
    public function __construct(
        private AnimalSpeciesRepository $repository
    ) {}


    public function searchAll(): AnimalsSpeciesResponse
    {
        return new AnimalsSpeciesResponse(...map(
            $this->toResponse(),
            $this->repository->findAll()
        ));
    }

    private function toResponse(): callable
    {
        return static fn (AnimalSpecies $animalSpecies): AnimalSpeciesResponse => new AnimalSpeciesResponse(
            $animalSpecies->animalSpeciesId()->value(),
            $animalSpecies->animalSpeciesName()->value(),
        );
    }
}
