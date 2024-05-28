<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers;

use AnimalSociety\Administration\Users\Domain\User as DomainUser;
use AnimalSociety\Administration\Users\Domain\UserAssociationId;
use AnimalSociety\Administration\Users\Domain\UserEmail;
use AnimalSociety\Administration\Users\Domain\UserFirstLastName;
use AnimalSociety\Administration\Users\Domain\UserId;
use AnimalSociety\Administration\Users\Domain\UserName;
use AnimalSociety\Administration\Users\Domain\UserPassword;
use AnimalSociety\Administration\Users\Domain\UserRole;
use AnimalSociety\Administration\Users\Domain\UserSecondLastName;
use AnimalSociety\Shared\Domain\Mapper\Domain;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\User as ModelUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class UserMapper extends ModelDomainMapper
{
    public function domainToModel(Domain $domain): ModelUser
    {
        $model = new ModelUser($domain->transform());

        return $model;
    }

    public function modelToDomain(Model $model): Domain
    {
        /** @var ModelUser $model */
        $id = new UserId($model->id());
        $name = new UserName($model->name());
        $firstLastName = new UserFirstLastName($model->firstLastName());
        $secondLastName = new UserSecondLastName($model->secondLastName());
        $email = new UserEmail($model->email());
        $password = new UserPassword($model->password());
        $associationId = new UserAssociationId($model->associationId());
        $role = new UserRole($model->role());
        $active = $model->isActive();

        $domain = new DomainUser(
            id: $id->value(),
            name: $name->value(),
            firstLastName: $firstLastName->value(),
            secondLastName: $secondLastName->value(),
            email: $email->value(),
            password: $password->value(),
            associationId: $associationId->value(),
            role: $role->value(),
            active: $active,
        );

        return $domain;
    }

    public function collectionModelToCollectionDomain(Collection $collection): Collection
    {
        return $collection->map(fn (Model $model) => $this->modelToDomain($model));
    }
}
