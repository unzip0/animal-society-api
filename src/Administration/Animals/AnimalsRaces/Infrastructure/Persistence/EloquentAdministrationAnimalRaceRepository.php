<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsRaces\Infrastructure\Persistence;

use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRace;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceId;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceRepository;
use AnimalSociety\Shared\Domain\Mapper\Domain;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\EloquentRepository;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\Animals\AnimalRaceMapper;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\ModelDomainMapper;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\Animals\AnimalRace as ModelAnimalRace;
use Illuminate\Database\Eloquent\Model;

final class EloquentAdministrationAnimalRaceRepository extends EloquentRepository implements AnimalRaceRepository
{
    public function create(AnimalRace $animalRace): void
    {
        $this->store($animalRace);
    }

    public function save(AnimalRace $animalRace): void
    {
        $this->persist($animalRace);
    }

    public function findById(AnimalRaceId $id): ?Domain
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
        return new ModelAnimalRace();
    }

    protected function modelDomainMapper(): ModelDomainMapper
    {
        return new AnimalRaceMapper();
    }
}
