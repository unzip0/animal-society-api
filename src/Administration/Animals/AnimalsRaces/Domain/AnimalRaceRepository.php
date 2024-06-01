<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsRaces\Domain;

use AnimalSociety\Shared\Domain\Mapper\Domain;

interface AnimalRaceRepository
{
    public function save(AnimalRace $animalSpecies): void;

    public function create(AnimalRace $animalSpecies): void;

    /**
     * @return Domain[]
     */
    public function findAll(): array;

    public function findById(AnimalRaceId $id): ?Domain;

    /**
     * @param array<string,mixed> $criteria
     */
    public function findOneBy(array $criteria): ?Domain;
}
