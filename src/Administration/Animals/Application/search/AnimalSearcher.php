<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\Application\search;

use AnimalSociety\Administration\Animals\Application\AnimalResponse;
use AnimalSociety\Administration\Animals\Application\AnimalsResponse;
use AnimalSociety\Administration\Animals\Domain\Animal;
use AnimalSociety\Administration\Animals\Domain\AnimalRepository;

use function Lambdish\Phunctional\map;

final readonly class AnimalSearcher
{
    public function __construct(
        private AnimalRepository $repository
    ) {}

    /**
     * @param array<string, mixed> $criteria
     */
    public function search(array $criteria): AnimalsResponse
    {
        return new AnimalsResponse(...map(
            $this->toResponse(),
            $this->repository->matchingByCriteria($criteria)
        ));
    }

    private function toResponse(): callable
    {
        return static fn (Animal $animal): AnimalResponse => new AnimalResponse(
            $animal->animalId()->value(),
            $animal->animalName()->value(),
            $animal->animalSpeciesId()->value(),
            $animal->animalRaceId()->value(),
            $animal->animalAge()->value(),
            $animal->isAvailable()
        );
    }
}
