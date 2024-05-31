<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\Animals;

use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesId;
use AnimalSociety\Administration\Animals\Domain\Animal as DomainAnimal;
use AnimalSociety\Administration\Animals\Domain\AnimalAge;
use AnimalSociety\Administration\Animals\Domain\AnimalAssociationId;
use AnimalSociety\Administration\Animals\Domain\AnimalId;
use AnimalSociety\Administration\Animals\Domain\AnimalName;
use AnimalSociety\Administration\Animals\Domain\AnimalRaceId;
use AnimalSociety\Shared\Domain\Mapper\Domain;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\ModelDomainMapper;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\Animals\Animal as ModelAnimal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class AnimalMapper extends ModelDomainMapper
{
    public function domainToModel(Domain $domain): ModelAnimal
    {
        $model = new ModelAnimal($domain->transform());

        return $model;
    }

    public function modelToDomain(Model $model): Domain
    {
        /** @var ModelAnimal $model */
        $id = new AnimalId($model->id());
        $associationId = new AnimalAssociationId($model->associationId());
        $name = new AnimalName($model->name());
        $speciesId = new AnimalSpeciesId($model->speciesId());
        $raceId = new AnimalRaceId($model->raceId());
        $age = new AnimalAge($model->age());
        $available = $model->isAvailable();

        $domain = new DomainAnimal(
            animalId: $id,
            animalAssociationId: $associationId,
            animalName: $name,
            animalSpeciesId: $speciesId,
            animalRaceId: $raceId,
            animalAge: $age,
            animalAvailable: $available,
        );

        return $domain;
    }

    public function collectionModelToCollectionDomain(Collection $collection): Collection
    {
        return $collection->map(fn (Model $model) => $this->modelToDomain($model));
    }
}
