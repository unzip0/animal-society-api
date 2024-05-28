<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Domain;

use AnimalSociety\Shared\Domain\Mapper\Domain;

interface AssociationRepository
{
    public function save(Association $association): void;

    public function create(Association $association): void;

    /**
     * @return Domain[]
     */
    public function findAll(): array;

    public function findById(AssociationId $id): ?Domain;

    /**
     * @param array<string,mixed> $criteria
     */
    public function findOneBy(array $criteria): ?Domain;
}
