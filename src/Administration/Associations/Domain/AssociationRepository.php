<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Domain;

use AnimalSociety\Shared\Domain\Criteria\Criteria;

interface AssociationRepository
{
    public function save(Association $association): void;

    /**
     * @return Association[]
     */
    public function findAll(): array;

    public function find(AssociationId $id): ?Association;

    /**
     * @return Association[]
     */
    public function matching(Criteria $criteria): array;
}
