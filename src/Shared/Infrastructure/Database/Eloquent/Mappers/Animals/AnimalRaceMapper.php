<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\Animals;

use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRace as DomainAnimalRace;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceId;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceName;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesId;
use AnimalSociety\Shared\Domain\Mapper\Domain;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\ModelDomainMapper;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\Animals\AnimalRace as ModelAnimalRace;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class AnimalRaceMapper extends ModelDomainMapper
{
    public function domainToModel(Domain $domain): ModelAnimalRace
    {
        $model = new ModelAnimalRace($domain->transform());

        return $model;
    }

    public function modelToDomain(Model $model): Domain
    {
        /** @var ModelAnimalRace $model */
        $id = new AnimalRaceId($model->id());
        $name = new AnimalRaceName($model->name());
        $speciesId = new AnimalSpeciesId($model->speciesId());

        $domain = new DomainAnimalRace(
            animalRaceId: $id,
            animalRaceName: $name,
            animalSpeciesId: $speciesId,
        );

        return $domain;
    }

    public function collectionModelToCollectionDomain(Collection $collection): Collection
    {
        return $collection->map(fn (Model $model) => $this->modelToDomain($model));
    }
}
