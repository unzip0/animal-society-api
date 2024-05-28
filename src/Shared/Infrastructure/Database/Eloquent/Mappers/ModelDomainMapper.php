<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers;

use AnimalSociety\Shared\Domain\Mapper\Domain;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class ModelDomainMapper
{
    abstract public function domainToModel(Domain $domain): Model;

    abstract public function modelToDomain(Model $model): Domain;

    abstract public function collectionModelToCollectionDomain(Collection $collection): Collection;
}
