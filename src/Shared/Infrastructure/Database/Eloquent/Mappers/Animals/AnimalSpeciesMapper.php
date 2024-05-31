<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\Animals;

use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpecies as DomainAnimalSpecies;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesId;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesName;
use AnimalSociety\Shared\Domain\Mapper\Domain;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\ModelDomainMapper;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\Animals\AnimalSpecies as ModelAnimalSpecies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class AnimalSpeciesMapper extends ModelDomainMapper
{
    public function domainToModel(Domain $domain): ModelAnimalSpecies
    {
        $model = new ModelAnimalSpecies($domain->transform());

        return $model;
    }

    public function modelToDomain(Model $model): Domain
    {
        /** @var ModelAnimalSpecies $model */
        $id = new AnimalSpeciesId($model->id());
        $name = new AnimalSpeciesName($model->name());

        $domain = new DomainAnimalSpecies(
            animalSpeciesId: $id,
            animalSpeciesName: $name,
        );

        return $domain;
    }

    public function collectionModelToCollectionDomain(Collection $collection): Collection
    {
        return $collection->map(fn (Model $model) => $this->modelToDomain($model));
    }
}
