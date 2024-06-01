<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsSpecies\Infrastructure\Persistence;

use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpecies;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesId;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesRepository;
use AnimalSociety\Shared\Domain\Mapper\Domain;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\EloquentRepository;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\Animals\AnimalSpeciesMapper;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\ModelDomainMapper;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\Animals\AnimalSpecies as ModelAnimalSpecies;
use Illuminate\Database\Eloquent\Model;

final class EloquentAdministrationAnimalSpeciesRepository extends EloquentRepository implements AnimalSpeciesRepository
{
    public function create(AnimalSpecies $animalSpecies): void
    {
        $this->store($animalSpecies);
    }

    public function save(AnimalSpecies $animalSpecies): void
    {
        $this->persist($animalSpecies);
    }

    public function findById(AnimalSpeciesId $id): ?Domain
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
        return new ModelAnimalSpecies();
    }

    protected function modelDomainMapper(): ModelDomainMapper
    {
        return new AnimalSpeciesMapper();
    }
}
