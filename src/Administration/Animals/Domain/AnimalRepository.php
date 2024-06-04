<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\Domain;

use AnimalSociety\Shared\Domain\Mapper\Domain;

interface AnimalRepository
{
    public function save(Animal $animal): void;

    public function create(Animal $animal): void;

    /**
     * @param array<string,mixed> $criteria
     * @return Domain[]
     */
    public function matchingByCriteria(array $criteria): array;

    public function findById(AnimalId $id): ?Domain;

    /**
     * @param array<string,mixed> $criteria
     */
    public function findOneBy(array $criteria): ?Domain;
}
