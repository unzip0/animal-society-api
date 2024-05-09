<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Infrastructure\Persistence;

use AnimalSociety\Administration\Associations\Domain\Association;
use AnimalSociety\Administration\Associations\Domain\AssociationId;
use AnimalSociety\Administration\Associations\Domain\AssociationRepository;
use AnimalSociety\Shared\Domain\Criteria\Criteria;
use AnimalSociety\Shared\Infrastructure\Database\Doctrine\DoctrineCriteriaConverter;
use AnimalSociety\Shared\Infrastructure\Database\Doctrine\DoctrineRepository;

final class DoctrineAdministrationAssociationRepository extends DoctrineRepository implements AssociationRepository
{
    public function save(Association $association): void
    {
        $this->persist($association);
    }

    public function find(AssociationId $id): ?Association
    {
        return $this->repository(Association::class)->find($id);
    }

    /**
     * @param array<string,mixed> $criteria
     */
    public function findOneBy(array $criteria): ?Association
    {
        return $this->repository(Association::class)->findOneBy($criteria);
    }

    /**
     * @return Association[]
     */
    public function findAll(): array
    {
        return $this->repository(Association::class)->findAll();
    }

    /**
     * @return Association[]
     */
    public function matching(Criteria $criteria): array
    {
        $doctrineCriteria = DoctrineCriteriaConverter::convert($criteria);

        return $this->repository(Association::class)->matching($doctrineCriteria)->toArray();
    }
}
