<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsSpecies\Domain;

use AnimalSociety\Shared\Domain\Mapper\Domain;

interface AnimalSpeciesRepository
{
    public function save(AnimalSpecies $animalSpecies): void;

    public function create(AnimalSpecies $animalSpecies): void;

    /**
     * @return Domain[]
     */
    public function findAll(): array;

    public function findById(AnimalSpeciesId $id): ?Domain;

    /**
     * @param array<string,mixed> $criteria
     */
    public function findOneBy(array $criteria): ?Domain;
}
