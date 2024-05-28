<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Infrastructure\Persistence;

use AnimalSociety\Administration\Associations\Domain\Association;
use AnimalSociety\Administration\Associations\Domain\AssociationId;
use AnimalSociety\Administration\Associations\Domain\AssociationRepository;
use AnimalSociety\Shared\Domain\Mapper\Domain;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\EloquentRepository;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\AssociationMapper;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\ModelDomainMapper;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\Association as ModelsAssociation;
use Illuminate\Database\Eloquent\Model;

final class EloquentAdministrationAssociationRepository extends EloquentRepository implements AssociationRepository
{
    public function create(Association $association): void
    {
        $this->store($association);
    }

    public function save(Association $association): void
    {
        $this->persist($association);
    }

    public function findById(AssociationId $id): ?Domain
    {
        return $this->find($id->value());
    }

    /**
     * @param array<string,mixed> $criteria
     */
    public function findOneBy(array $criteria): ?Domain
    {
        return $this->findOneByCriteria($criteria);
    }

    /**
     * @return Domain[]
     */
    public function findAll(): array
    {
        return $this->findByCriteria([]);
    }

    protected function model(): Model
    {
        return new ModelsAssociation();
    }

    protected function modelDomainMapper(): ModelDomainMapper
    {
        return new AssociationMapper();
    }

    // /**
    //  * @return Association[]
    //  */
    // public function matching(Criteria $criteria): array
    // {
    //     return [];
    // }
}
