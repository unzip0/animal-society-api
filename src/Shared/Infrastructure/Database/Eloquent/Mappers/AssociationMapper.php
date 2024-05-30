<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers;

use AnimalSociety\Administration\Associations\Domain\Association as DomainAssociation;
use AnimalSociety\Administration\Associations\Domain\AssociationCif;
use AnimalSociety\Administration\Associations\Domain\AssociationCityId;
use AnimalSociety\Administration\Associations\Domain\AssociationEmail;
use AnimalSociety\Administration\Associations\Domain\AssociationId;
use AnimalSociety\Administration\Associations\Domain\AssociationName;
use AnimalSociety\Shared\Domain\Mapper\Domain;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\Association as ModelAssociation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class AssociationMapper extends ModelDomainMapper
{
    public function domainToModel(Domain $domain): ModelAssociation
    {
        $model = new ModelAssociation($domain->transform());

        return $model;
    }

    public function modelToDomain(Model $model): Domain
    {
        /** @var ModelAssociation $model */
        $id = new AssociationId($model->id());
        $cif = new AssociationCif($model->cif());
        $name = new AssociationName($model->name());
        $cityId = new AssociationCityId($model->cityId());
        $email = new AssociationEmail($model->email());
        $active = $model->isActive();

        $domain = new DomainAssociation(
            associationId: $id,
            associationCif: $cif,
            associationName: $name,
            associationCityId: $cityId,
            associationEmail: $email,
            associationActive: $active,
        );

        return $domain;
    }

    public function collectionModelToCollectionDomain(Collection $collection): Collection
    {
        return $collection->map(fn (Model $model) => $this->modelToDomain($model));
    }
}
