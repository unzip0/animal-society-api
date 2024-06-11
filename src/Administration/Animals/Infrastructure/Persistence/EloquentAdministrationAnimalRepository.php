<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\Infrastructure\Persistence;

use AnimalSociety\Administration\Animals\Domain\Animal;
use AnimalSociety\Administration\Animals\Domain\AnimalId;
use AnimalSociety\Administration\Animals\Domain\AnimalRepository;
use AnimalSociety\Shared\Domain\Mapper\Domain;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\EloquentRepository;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\Animals\AnimalMapper;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\ModelDomainMapper;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\Animals\Animal as ModelAnimal;
use Illuminate\Database\Eloquent\Model;

final class EloquentAdministrationAnimalRepository extends EloquentRepository implements AnimalRepository
{
    public function create(Animal $animal): void
    {
        $this->store($animal);
    }

    public function save(Animal $animal): void
    {
        $this->persist($animal);
    }

    public function delete(Animal $animal): void
    {
        $this->hardDelete($animal);
    }

    public function findById(AnimalId $id): ?Domain
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
     * @param array<string,mixed> $criteria
     * @return Domain[]
     */
    public function matchingByCriteria(array $criteria): array
    {
        return $this->findByCriteria($criteria);
    }

    public function updateAnimal(Animal $animal): void
    {
        $this->update($animal);
    }

    protected function model(): Model
    {
        return new ModelAnimal();
    }

    protected function modelDomainMapper(): ModelDomainMapper
    {
        return new AnimalMapper();
    }
}
